<template>
  <div>
    <div class="col-md-20 auto">
      <div class="bread">
        <at-breadcrumb separator=">">
          <at-breadcrumb-item href="#/">首页</at-breadcrumb-item>
          <at-breadcrumb-item>后台管理</at-breadcrumb-item>
        </at-breadcrumb>
      </div>
    </div>
    <div class="j_panel mt20 col-md-20 auto">
      <div class="row at-row no-gutter">
        <div class="col-md-5">
          <at-menu mode="vertical" active-name="1">
            <at-menu-item name="1">
              <router-link to="/JobAdmin/AddJob">
                <i class="icon icon-plus"></i>发布职位
              </router-link>
            </at-menu-item>
            <at-menu-item name="2">
              <router-link to="/JobAdmin/AdminList">
                <i class="icon icon-list"></i>职位列表
              </router-link>
            </at-menu-item>
            <at-menu-item name="3">
              <router-link to="/JobAdmin/ViewResume">
                <i class="icon icon-eye"></i>简历查看
              </router-link>
            </at-menu-item>
            <at-menu-item name="4">
              <router-link to="/JobAdmin/AdminType">
                <i class="icon icon-tag"></i>部门管理
              </router-link>
            </at-menu-item>
            <at-menu-item name="5">
              <router-link to="/JobAdmin/ChangePwd">
                <i class="icon icon-lock"></i>修改密码
              </router-link>
            </at-menu-item>
            <at-menu-item name="6">
              <div @click="logout()">
                <div class="logout_hr"></div>
                <i class="icon icon-log-out"></i>退出系统
              </div>
            </at-menu-item>
          </at-menu>
        </div>
        <div class="col-md-19" >
            <router-view />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import axios from "axios";

export default {
  name: "JobAdmin",
  methods: {
    // 退出系统
    logout: function() {
      var _this = this;
      axios
        .get("http://www.ycmbcd.com:6610/api/login.php", {
          params: {
            logout: "bye"
          }
        })
        .then(function(res) {
          if (res.data == "bye") {
            _this.$router.replace("/");
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    // 检测是否登录后台
    check_login: function() {
      var _this = this;
      // axios.get("/api/login.php", {
      axios
        .get("http://www.ycmbcd.com:6610/api/login.php", {
          params: {
            check_login: "check"
          }
        })
        .then(function(res) {
          console.log(res);
          if (res.data == "ing") {
          } else if (res.data == "ban") {
            const Toast = Vue.swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 5000
            });
            Toast.fire({
              type: "info",
              title: "您已超时，请重新登录。"
            });
            _this.$router.replace("/JobLogin");
          } else {
            alert("系统错误，请联系管理员。");
            _this.$router.replace("/");
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  },
  created: function() {
    this.check_login();
  }
};
</script>

<style>
.logout_hr {
  margin: 0 10px 10px 0;
  background: #dee9f2;
  height: 1px;
}
.mt20{
  margin-top:20px;
}
.at-menu{
  width: 180px !important;
}
</style>
