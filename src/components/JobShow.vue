<template>
  <div>
    <div class="col-md-20 auto">
      <div class="bread">
        <at-breadcrumb separator=">">
          <at-breadcrumb-item href="#/">首页</at-breadcrumb-item>
          <at-breadcrumb-item>{{this.this_job.job_name}}</at-breadcrumb-item>
        </at-breadcrumb>
      </div>
    </div>
    <div class="j_panel mt20 col-md-20 auto">
        <div class="show_box">
          <div class="f_left"> 
            <h1><span>「职位{{this.$route.query.job_id}}」</span>{{this.this_job.job_name}}</h1>
          </div>
          <div class="f_right">
            <div class="job_money weight">岗位薪资：<span class="c_red">{{this.this_job.job_money}}</span></div>
          </div>
          <div class="clear"></div>
          <router-link target="_blank" :to="{ name: 'JobSend', query: { job_id: this.$route.query.job_id, job_name: this.this_job.job_name, job_type: this.this_job.job_type}}">
              <at-button class="mt20 f_right" style="margin-top:30px;" size="large" type="success weight">投递简历</at-button>
          </router-link>
          <hr>
          <h4>&nbsp;&nbsp;&nbsp;&nbsp;部门：{{this.this_job.job_type}}
            &nbsp;&nbsp;/&nbsp;&nbsp;招聘人数：{{this.this_job.need_num}} 人
            &nbsp;&nbsp;/&nbsp;&nbsp;学历要求：{{this.this_job.job_edu}}</h4>
          <br>
          <h3>&nbsp;&nbsp;&nbsp;&nbsp;任职要求</h3>
          &nbsp;&nbsp;&nbsp;<textarea class="text_area" v-model="this.this_job.job_info" disabled></textarea>
          <div class="clear"></div>
        </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Vue from "vue";

export default {
  name: "jobShow",
  data() {
    return {
      this_job: []
    };
  },
  mounted: function() {
    this.job_show();
  },
  methods: {
    job_show: function() {
      var _this = this;
      axios
        .get("http://www.ycmbcd.com:6610/api/job.php", {
          params: {
            job_show: _this.$route.query.job_id
          }
        })
        .then(function(res) {
          _this.this_job = res.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>

<style>
.job_money{
  font-size: 26px;
}
.mt20{
  margin-top: 20px;
}
.text_area{
    width: 700px;
    margin-top: 10px;
    border: 1px solid #dedede;
    border-radius: 6px;
    padding: 10px 20px;
    height: 260px;
    resize: none;
}
.show_box{
    border: 1px solid #edf1f6;
    padding: 40px;
    background: #f9f9f9;
    border-radius: 6px;
}
</style>