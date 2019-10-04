<template>
  <div>
    <div class="col-md-18 auto">
        <div class="bread">
        <at-breadcrumb separator=">">
            <at-breadcrumb-item href="#/">首页</at-breadcrumb-item>
            <at-breadcrumb-item>后台登录</at-breadcrumb-item>
        </at-breadcrumb>
        </div>
    </div>
    <div class="col-md-18 auto j_panel mt20">
    <div class="auto j_login">
        <div class="j_box">
            <div class="login_txt">您好，请登录 ..</div>
                <at-input type="password" v-model="login_pwd" placeholder="请输入内容" append-button @keyup.enter="login()">
                    <template slot="append">
                        <span @click="login()">登录</span>
                    </template>
                </at-input>
            </div>
        </div>
    </div>
  </div>
</template>

<style>
.j_login {
  width: 220px;
  height: 120px;
  margin-top:80px !important;
  margin-bottom:180px !important;
  background:#f3f3f3;
  border: 1px solid #ddd;
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
    created() {
        let _this = this;
        // 回车登录
        document.onkeypress = function(e) {
        var keycode = document.all ? event.keyCode : e.which;
            if (keycode == 13) {
                _this.login();
                return false;
            }
        };
    },
    methods: {
        login: function() {
            var _this = this;
            // axios.get("/api/login.php", {
            axios.get("http://www.ycmbcd.com:6610/api/login.php", {
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
                    _this.$router.replace('/JobAdmin/AddJob')
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