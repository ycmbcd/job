<template>
  <div>
    <div class="bread">
      <at-breadcrumb separator=">">
        <at-breadcrumb-item>首页 ></at-breadcrumb-item>
      </at-breadcrumb>
    </div>
    <div class="j_panel col-md-20 auto">
      <table class="j_table">
        <tr class="j_th">
          <td width="10%" class="tagc">职位编号</td>
          <td>部门</td>
          <td>职位名</td>
          <td class="tagc">招聘人数</td>
          <td width="20%">发布时间</td>
        </tr>
        <tr v-for="(item,index) in all_jobs" :key="index">
          <td class="tagc">{{item.id}}</td>
          <td>{{item.job_type}}</td>
          <td>
            <router-link
              target="_blank"
              :to="{ name: 'JobShow', query: { job_id: item.id}}"
            >{{item.job_name}}</router-link>
          </td>
          <td class="tagc">{{item.need_num}}</td>
          <td>{{item.ct_time}}</td>
        </tr>
      </table>
      <!-- <div class="f_right mt20">
      <at-pagination :total="60"></at-pagination>
      </div>-->
      <div class="clear"></div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Vue from "vue";

export default {
  name: "JobList",
  data() {
    return {
      all_jobs: []
    };
  },
  mounted: function() {
    this.get_jobs();
  },
  methods: {
    // 获取所有职位
    get_jobs: function() {
      var _this = this;
      axios
        .get("http://job.cc/api/job.php", {
          params: {
            get_jobs: "get"
          }
        })
        .then(function(res) {
          _this.all_jobs = res.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>
<style>
.j_table {
  width: 100%;
  border-collapse: collapse;
  border: 1px solid #e9e9e9;
}
.j_th {
  font-weight: bold;
  background: #f6f6f6;
  height: 40px;
}
.j_table td {
  padding: 4px 10px;
  border: 1px solid #e9e9e9;
  height: 38px;
}
</style>
