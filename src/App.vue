<template>
  <div>
    <job-top></job-top>
    <div id="app">
      <div id="logo">招聘系统</div>
      <div id="job_view">
        <router-view />
      </div>
    </div>
  </div>
</template>

<script>
import JobTop from "@/components/JobTop";

export default {
  name: "App",
  components: {
    JobTop
  }
};
</script>

<style>
body{
  background: #edf1f6;
}
#app {
  margin: 40px;
}
#logo {
  color: #333;
  padding: 10px 20px;
  font-size: 30px;
}
#job_view {
  margin: 10px 40px;
}
.mt10{
  margin-top:10px;
}
.mt20{
  margin-top:20px;
}
.tagc {
  text-align: center;
}
.tagr {
  text-align: right;
}
.f_left{
  float: left;
}
.f_right{
  float: right;
}
.clear{
  clear: both;
}
.icon{
  padding-right: 8px;
}
.auto{
  margin: 0 auto;
}
.j_panel{
  background: #FFF;
  padding: 40px;
  border-radius: 6px;
}
.c_blue{
  color: #1b75ca;
}
.c_red{
  color: #cc2222;
}
.weight{
  font-weight: bold;
}
.hidden{
  display: none;
}
.line{
  height: 2px;
  background: #edf1f6;
  margin: 10px 0 20px 0;
}
body.swal2-toast-shown .swal2-container.swal2-top-end, body.swal2-toast-shown .swal2-container.swal2-top-right{
  top: 60px;
}
</style>