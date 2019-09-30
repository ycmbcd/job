<template>
    <div>
        <table class="j_table">
            <tr class="j_th">
                <td class="tagc" width="6%"><i class="icon icon-check"></i></td>
                <td>投递人</td>
                <td>投递岗位</td>
                <td>部门</td>
                <td>操作</td>
            </tr>
            <tr v-for="(item, index) in all_resume" :key="index">
                <td class="tagc">
                    <at-checkbox-group v-model="check_box">
                        <at-checkbox :label="item.resume_name"></at-checkbox>
                    </at-checkbox-group>
                </td>
                <td>{{item.resume_name}}</td>
                <td>
                    <at-button class="weight" type="success" size="smaller" @click="preview(item.resume_name)">
                        预览
                    </at-button>
                </td>
            </tr>
        </table>
        <at-button class="mt10 weight" type="primary" :disabled="check_box == ''" @click="down_resume_person()">下载投递简历</at-button>&nbsp;&nbsp;
        <at-button class="mt10 weight" type="success" :disabled="check_box == ''" >下载简历表格Excel</at-button>
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
        window.open("http://job.cc/api/job.php?preview="+resume_name);
    },
      // 下载职位简历
    down_resume_person: function() {
      var _this = this;
      axios
        .get("http://job.cc/api/job.php", {
          params: {
            down_resume_person: _this.check_box
          }
        })
        .then(function(res) {
          if(res.data == 'ok'){
            window.open('http://job.cc/api/../down/person.zip');
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    ViewResume: function() {
      var _this = this;
      axios
        .get("http://job.cc/api/job.php", {
          params: {
            view_resume: '1'
          }
        })
        .then(function(res) {
            console.log(res)
          _this.all_resume = res.data;
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
</style>
