<template>
  <div>
    <table class="j_table">
      <tr class="j_th">
        <td class="tagc" width="6%">筛选</td>
        <td class="tagc" width="8%">职位 ID</td>
        <td width="8%">部门</td>
        <td width="24%">职位名称</td>
        <td width="19%">发布时间</td>
        <td class="tagc" width="8%">投递数</td>
        <td>职位操作</td>
      </tr>
      <tr v-for="(item,index) in all_jobs" :key="index">
        <td class="tagc">
          <at-checkbox-group v-model="check_box">
            <at-checkbox :label="item.id"></at-checkbox>
          </at-checkbox-group>
        </td>
        <td class="tagc">{{item.id}}</td>
        <td>{{item.job_type}}</td>
        <td>{{item.job_name}}</td>
        <td>{{item.ct_time}}</td>
        <td class="tagc">{{item.receive_num}}</td>
        <td class="tagc">
          <at-button class="weight" size="smaller" hollow type="success" @click="no_dep()">查看</at-button>&nbsp;&nbsp;
          <at-button class="weight" size="smaller" hollow type="primary" @click="no_dep()">修改</at-button>&nbsp;&nbsp;
          <at-button class="weight" size="smaller" hollow type="error" @click="del_modal(item.id, item.job_type, item.job_name)">删除</at-button>
        </td>
      </tr>
    </table>
    <at-button class="mt10" type="primary" :disabled="check_box == ''" @click="down_resume()">下载投递简历</at-button>

  </div>
</template>

<script>
import axios from "axios";
import Vue from "vue";

export default {
  name: "AdminList",
  data() {
    return {
      all_jobs: [],
      check_box: []
    };
  },
  mounted: function() {
    this.get_jobs();
  },
  methods: {
    // 暂未开发
    no_dep(){
      this.$Message('该功能暂未开发！');
    },
    // 删除job
    del_job(id){
      var _this = this;
      axios
        .get("http://job.cc/api/job.php", {
          params: {
            del_job: id
          }
        })
        .then(function(res) {
          if(res.data == 'ok'){
            _this.$Message("已「删除」完成。"); 
            _this.get_jobs();
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    // 删除模态框
    del_modal(id, type, txt) {
      var _this = this;
      this.$Modal
        .confirm({
          title: "警告",
          content: "您将删除【" + type + "】的「" + txt + "」岗位，您确定要这么做吗？"
        })
        .then(() => {
          _this.del_job(id);
        })
        .catch(() => {
          _this.$Message("已「取消」");
        });
    },
    // 下载职位简历
    down_resume: function() {
      var _this = this;
      axios
        .get("http://job.cc/api/job.php", {
          params: {
            down_resume: _this.check_box
          }
        })
        .then(function(res) {
          if(res.data == 'ok'){
            window.open('http://job.cc/api/../down/download.zip');
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
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
<style sccoped>
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
  font-size: 12px;
}
.j_table .icon {
  padding-right: 0px;
}
.at-modal {
  width: 300px !important;
}
.at-checkbox{
  margin-left: 8px;
}
</style>