<template>
  <div>
    <div class="j_login auto">
        <div class="j_box">
            <div class="login_txt">您好，请登录 ..</div>
                <at-input type="password" v-model="login_pwd" placeholder="请输入内容" append-button>
                    <template slot="append">
                        <span @click="login()">登录</span>
                    </template>
                </at-input>
            </div>
        </div>
  </div>
</template>

<style>
.j_login {
  width: 220px;
  height: 120px;
  background:#d5e1f1;
  border: 2px solid #fff;
  border-radius: 6px;
}
.login_txt {
  font-size: 20px;
  padding-bottom: 10px;
}
.j_box{
    margin: 10px;
}
</style>

<script>
import Vue from 'vue'
import axios from "axios";

export default {
    name: 'JobLogin',
    data(){
        return{
            login_pwd: ''
        }
    },
    methods: {
        login: function() {
            var _this = this;
            // axios.get("/api/login.php", {
            axios.get("http://job.cc/api/login.php", {
                params: {
                    login: _this.login_pwd
                }
            }).then(function (res){
                if(res.data == 'go'){
                    const Toast = Vue.swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000
                        })

                        Toast.fire({
                        type: 'success',
                        title: '管理员，欢迎使用！'
                    })
                    _this.$router.replace('/JobAdmin')
                }else if(res.data == 'ban'){
                    const Toast = Vue.swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                        })

                        Toast.fire({
                        type: 'error',
                        title: '密码错误，请重新尝试。'
                    })
                }else{
                    alert('系统错误，请联系管理员。')
                    _this.$router.replace('/');
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
}
</script>