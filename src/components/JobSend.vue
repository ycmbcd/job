<template>
  <div class="col-md-20 auto">
    <div class="bread">
      <at-breadcrumb separator=">">
        <at-breadcrumb-item href="#/">首页</at-breadcrumb-item>
        <at-breadcrumb-item>
          <router-link
            target="_blank"
            :to="{ name: 'JobShow', query: { job_id: this.$route.query.job_id}}"
          >{{this.$route.query.job_name}}</router-link>
        </at-breadcrumb-item>
        <at-breadcrumb-item>投递简历</at-breadcrumb-item>
      </at-breadcrumb>
    </div>
    <div class="j_panel mt20">
      <h1>
        您正在应聘
        <span class="c_blue">【{{this.$route.query.job_type}}】</span>的
        <span class="c_red">{{this.$route.query.job_name}}</span> 岗位
      </h1>
      <i class="hidden">{{this.$route.query.job_id}}</i>
      <div class="line"></div>
      <div class="row col-md-16 auto">
        <div class="col-md-12">
          <at-input class="mt10" v-model="u_name" placeholder="请输入内容">
            <template slot="prepend">
              <span>姓名</span>
            </template>
          </at-input>
          <at-input class="mt10" v-model="u_birthday" placeholder="请输入内容">
            <template slot="prepend">
              <span>生日</span>
            </template>
          </at-input>
          <at-input class="mt10" v-model="u_tel" placeholder="请输入内容">
            <template slot="prepend">
              <span>电话</span>
            </template>
          </at-input>
          <at-input class="mt10" v-model="u_email" placeholder="请输入内容">
            <template slot="prepend">
              <span>电子邮箱</span>
            </template>
          </at-input>
        </div>
        <div class="col-md-12">
          <v-select
            style="width:160px;"
            class="mt10"
            v-model="u_mate"
            :options="['男','女']"
            placeholder="请选择性别.."
          ></v-select>
          <at-input class="mt10" v-model="u_school" placeholder="请输入内容">
            <template slot="prepend">
              <span>毕业学校</span>
            </template>
          </at-input>
          <at-input class="mt10" v-model="u_major" placeholder="请输入内容">
            <template slot="prepend">
              <span>专业</span>
            </template>
          </at-input>
          <at-input class="mt10" v-model="u_education" placeholder="请输入内容">
            <template slot="prepend">
              <span>学位</span>
            </template>
          </at-input>
        </div>
        <div class="col-md-24">
          <at-textarea minRows="8" class="mt20" v-model="u_info" placeholder="请输入个人简历..."></at-textarea>
          <at-button
            class="mt10 f_right weight"
            type="success"
            @click="send_resume()"
            :disabled="u_mate == '' || u_name == '' || u_birthday == '' || u_tel == '' || u_email == '' || u_school == '' || u_major == '' || u_education == '' || u_info == ''"
          >投递该岗位</at-button>
        </div>
      </div>
      
        <at-modal v-model="modal_resume" title="简历预览">
            <div class="clear"></div>
            <div id="make_png">
                <div id="t_resume_box">
                    <div>投递岗位：【{{this.$route.query.job_type}}】 {{this.$route.query.job_name}}</div>
                    <br>
                    <h1 class="tagc">{{ u_name }}的简历</h1>
                    <br>
                    <table class="t_resume mt10">
                        <tr>
                            <td>姓名</td><td>{{ u_name }}</td>
                            <td>性别</td><td>{{ u_email }}</td>
                        </tr>
                        <tr>
                            <td>出生日期</td><td>{{ u_birthday }}</td>
                            <td>电话</td><td>{{ u_tel }}</td>
                        </tr>
                        <tr>
                            <td>电子邮箱</td><td>{{ u_email }}</td>
                            <td>毕业学校</td><td>{{ u_birthday }}</td>
                        </tr>
                        <tr>
                            <td>专业</td><td>{{ u_major }}</td>
                            <td>学位</td><td>{{ u_education }}</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <textarea class="text_area" v-model="u_info" disabled></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
                <br>
            </div>
        </at-modal>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Qs from 'qs';
import Vue from "vue";
import domtoimage from 'dom-to-image';


export default {
  name: "jobShow",
  data() {
    return {
      u_name: "",
      u_mate: "",
      u_birthday: "",
      u_tel: "",
      u_email: "",
      u_school: "",
      u_major: "",
      u_education: "",
      u_info: "",
      modal_resume: false,
      resume_png: ''
    };
  },
  methods: {
    // 生成简历
    make_resume: function() {
      var _this = this;
      _this.modal_resume = true;
      setTimeout(() => {
        var node = document.getElementById('make_png');
            domtoimage.toPng(node)
        .then(function (dataUrl) {
            var img = new Image();
            img.src = dataUrl;
            _this.resume_png = img.src;

            var data = {
                'resume_png': _this.resume_png,
                'job_id': _this.$route.query.job_id,
                'u_name': _this.u_name,
                'u_tel': _this.u_tel
            }
            
            axios
            .post("http://www.ycmbcd.com:6610/api/job.php", Qs.stringify(data)).then(function(res){
                console.log(res)
                // console.log(res.data)
            }).catch(function(error) {
                console.log(error);
            });
        })
        .catch(function (error) {
            console.error('系统错误!', error);
        });
      }, 1000);
    },
    // 发送简历到后台做记录
    send_resume: function() {
      var _this = this;
      axios
        .get("http://www.ycmbcd.com:6610/api/job.php", {
          params: {
            send_resume: "send",
            job_id: _this.$route.query.job_id,
            u_name: _this.u_name,
            u_mate: _this.u_mate,
            u_birthday: _this.u_birthday,
            u_tel: _this.u_tel,
            u_email: _this.u_email,
            u_school: _this.u_school,
            u_major: _this.u_major,
            u_education: _this.u_education,
            u_info: _this.u_info
          }
        })
        .then(function(res) {
          if (res.data == "ok") {
            const Toast = Vue.swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 5000
            });
            Toast.fire({
              type: "success",
              title: "正在生成您的简历。"
            });
            _this.make_resume();
          }
          console.log(res.data);
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>

<style>
.vs__dropdown-toggle {
  font-size: 13px;
  color: #999;
  border: 1px solid #c5d9e7 !important;
}
.at-modal{
    width: 800px !important;
    overflow: auto;
}
.at-modal__body{
    height: 500px;
}
#t_resume_box{
  box-shadow: 0px 0px 10px #999;
  padding: 60px;
  background: #FFF;
  margin: 20px;
  margin-top: 30px;
}
.t_resume {
  width: 100%;
  border-collapse: collapse;
  border: 1px solid #e9e9e9;
}
.j_th {
  font-weight: bold;
  background: #f6f6f6;
  height: 40px;
}
.t_resume td{
  padding: 4px 10px;
  border: 1px solid #e9e9e9;
  height: 38px;
}
.text_area{
    width: 600px;
    margin-top: 10px;
    border: 1px solid #dedede;
    border-radius: 6px;
    font-size: 18px;
    padding: 10px 20px;
    height: 500px;
    resize: none;
    background: rgba(9,9,9,.03);
}
.at-modal__footer{
    display: none;
}

</style>