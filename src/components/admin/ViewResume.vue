<template>
    <div>
        <table class="j_table">
            <tr class="j_th">
                <td class="tagc" width="6%">筛选</td>
                <td width="26%">投递人</td>
                <td width="40%">投递岗位</td>
                <td class="tagc">部门</td>
                <td class="tagc">操作</td>
            </tr>
            <tr v-for="(item, index) in all_resume" :key="index">
                <td class="tagc">
                    <at-checkbox-group v-model="check_box">
                        <at-checkbox :label="item.resume_name"></at-checkbox>
                    </at-checkbox-group>
                </td>
                <td>{{item.resume_name}}</td>
                <td>{{item.job_name}}</td>
                <td class="tagc">{{item.job_type}}</td>
                <td class="tagc">
                    <at-button class="weight" type="success" size="smaller" @click="preview(item.resume_name)">
                        预览
                    </at-button>
                </td>
            </tr>
        </table>
        <at-button class="mt10 weight" type="primary" :disabled="check_box == ''" @click="down_resume_person()">下载投递简历</at-button>&nbsp;&nbsp;
        <!-- <at-button class="mt10 weight" type="success" :disabled="check_box == ''" @click="down_resume_xlsx()">下载简历表格Excel</at-button> -->
    </div>
</template>

<script>
import axios from "axios";
import Vue from "vue";

export default {
  name: "ViewResume",
  data() {
    return {
      all_resume: [],
      check_box: []
    };
  },
  mounted: function() {
    this.ViewResume();
  },
  methods: {
    //   简历预览
    preview: function(resume_name){
        window.open("http://www.ycmbcd.com:6610/api/job.php?preview="+resume_name);
    },
      // 下载职位简历
    down_resume_person: function() {
      var _this = this;
      axios
        .get("http://www.ycmbcd.com:6610/api/job.php", {
          params: {
            down_resume_person: _this.check_box
          }
        })
        .then(function(res) {
          if(res.data == 'ok'){
            window.open('http://www.ycmbcd.com:6610/api/../down/person.zip');
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    ViewResume: function() {
      var _this = this;
      axios
        .get("http://www.ycmbcd.com:6610/api/job.php", {
          params: {
            view_resume: '1'
          }
        })
        .then(function(res) {
          _this.all_resume = res.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    // 下载简历表格
    down_resume_xlsx: function(){
      var _this = this;
      axios
        .get("http://www.ycmbcd.com:6610/api/job.php", {
          params: {
            down_resume_xlsx: _this.check_box
          }
        })
        .then(function(res) {
          console.log(res.data)
          if(res.data == 'ok'){
            window.open('http://www.ycmbcd.com:6610/api/../down/resume.xlsx');
          }
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
.j_table .icon {
  padding-right: 0px;
}
.at-checkbox{
  margin-left: 8px;
}
</style>
