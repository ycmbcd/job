<template>
  <div>
    <table class="j_table">
      <tr class="j_th">
        <td class="tagc" width="6%"><i class="icon icon-check"></i></td>
        <td class="tagc" width="8%">职位 ID</td>
        <td>部门</td>
        <td>职位名称</td>
        <td width="20%">发布时间</td>
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
        <td>
          查看
          修改
          删除
        </td>
      </tr>
    </table>
    <at-button class="mt10" type="primary" :disabled="check_box == ''" @click="down_send()">下载投递简历</at-button>
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
    // 下载职位简历
    down_send: function() {
      var _this = this;
      console.log(_this.check_box);
    },
    // 获取所有职位
    get_jobs: function() {
      var _this = this;
      axios
        .get("http://job.cc/job.php", {
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
}
.j_table .icon {
  padding-right: 0px;
}
.at-modal {
  width: 300px !important;
}
</style>