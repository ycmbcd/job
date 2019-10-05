<template>
  <div>
    <div class="col-md-20 auto">
      <div class="bread">
        <at-breadcrumb separator=">">
          <at-breadcrumb-item>欢迎访问ABC招聘系统</at-breadcrumb-item>
        </at-breadcrumb>
      </div>
    </div>
    <div class="j_panel mt20 col-md-20 auto">
      <div class="f_left">
        <h1 style="color:#888;"><i class="icon icon-tag"></i>最新发布</h1>
      </div>
      <div class="f_right">
        <h1>
          <i @click="show_type = 1" class="icon pointer icon-grid c_blue"></i>
          <i @click="show_type = 2" class="icon pointer icon-list c_blue"></i>
        </h1>
      </div>
      <div class="clear"></div>
        <div v-show="show_type == 1" class="job_item" v-for="(item,index) in all_jobs" :key="index">
        <router-link
                target="_blank"
                :to="{ name: 'JobShow', query: { job_id: item.id}}"
              >
            <div class="f_left"><h1>{{item.id}}-{{item.job_name}}</h1></div>
            <div class="f_right"><div class="job_money">{{item.job_edu}} <span class="c_red">{{item.job_money}}</span></div></div>
            <div class="clear"></div>
            
            <h3><i class="icon icon-radio"></i>{{item.job_type}}&nbsp;&nbsp;/&nbsp;&nbsp;<i class="icon icon-clock"></i>{{item.ct_time}}&nbsp;&nbsp;/&nbsp;&nbsp;<i class="icon icon-users"></i>{{item.need_num}}人</h3>
            <p>{{item.job_info}}</p>
        </router-link>
        </div>
      <table class="j_table mt20" v-show="show_type == 2">
        <tr class="j_th">
          <td width="10%" class="tagc">职位编号</td>
          <td>部门</td>
          <td>职位名</td>
          <td class="tagc">薪资</td>
          <td class="tagc">学历要求</td>
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
          <td class="tagc c_red">{{item.job_money}}</td>
          <td class="tagc">{{item.job_edu}}</td>
          <td class="tagc">{{item.need_num}}</td>
          <td>{{item.ct_time}}</td>
        </tr>
      </table>

      <div class="f_right mt20">
        <at-pagination :total="page_total"></at-pagination>
      </div>
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
      all_jobs: [],
      show_type: 1,
      page_total: 0
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
        .get("http://www.ycmbcd.com:6610/api/job.php", {
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
.job_money{
  font-size: 26px;
  font-weight: bold;
  color: #888;
}
.pointer{
  cursor: pointer;
}
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
.icon:hover{
  color: #999;
}
.mt20{
  margin-top: 20px;
}
.job_item{
  box-shadow: 0 1px 4px 1px #dedede;
  margin: 30px 0px;
  border-radius: 4px;
  padding: 30px;
}
.job_item:hover{
  transition: background .3s;
  box-shadow: 0 1px 10px 1px #dedede;
  cursor: pointer;
  background: #f6f6f6;
}

.job_item h1{
  font-size: 26px;
}
.job_item h3{
  margin-top: 8px;
  font-size: 15px;
  color: rgb(133, 133, 133);
  font-weight: 400;
}
.job_item p{
  margin-top: 20px;
  font-size: 16px;
  color: #999;
}
</style>
