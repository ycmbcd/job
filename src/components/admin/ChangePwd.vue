<template>
    <div>
        <div class="col-md-5">
            <at-input v-model="o_pwd" type="password" placeholder="原密码"></at-input>
            <at-input class="mt10" v-model="n_pwd" type="password" placeholder="新密码"></at-input>
            <at-input class="mt10" v-model="r_pwd" type="password" placeholder="确认新密码"></at-input>
            <at-button class="mt20 f_right weight" size="small" type="error" @click="change_pwd()">修改密码</at-button>
            <div class="clear"></div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Vue from "vue";
export default {
    name: "ChangePwd",
    data() {
        return {
            o_pwd: "",
            n_pwd: "",
            r_pwd: ""
        };
    },
    methods: {
        // 退出系统
        logout: function() {
        var _this = this;
        axios.get("http://www.ycmbcd.com:6610/api/login.php", {
                params: {
                    logout: "bye"
                }
            })
            .then(function(res) {
                if (res.data == "bye") {
                    _this.$router.replace("/JobLogin");
                }
            })
            .catch(function(error) {
                console.log(error);
            });
        },
        // 修改密码
        change_pwd: function() {
            var _this = this;
            if(_this.n_pwd == _this.r_pwd && _this.n_pwd !== ''){
                axios.get("http://www.ycmbcd.com:6610/api/login.php", {
                    params: {
                        change_pwd: _this.n_pwd,
                        o_pwd: _this.o_pwd
                    }
                })
                .then(function(res) {
                    if (res.data == "ok") {
                        const Toast = Vue.swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000
                            });
                            Toast.fire({
                            type: "info",
                            title: "密码已修改，请重新登录。"
                        });
                        _this.logout();
                    } else {
                        _this.$Message("信息有误，密码修改失败。");
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
            }else{
                const Toast = Vue.swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000
                    });
                    Toast.fire({
                    type: "error",
                    title: "密码输入有误"
                });
            }
        }
    }
}
</script>


