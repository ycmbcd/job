<template>
  <div>
    <div class="col-md-6">
      <!-- 部门选择 -->
      <div class="col-md-17">
        <v-select v-model="job_type" :options="all_type" placeholder="请选择部门.."></v-select>
      </div>

      <!-- 职位名称 -->
      <at-input class="mt10" v-model="job_name" placeholder="请输入内容">
        <template slot="prepend">
          <span>职位名称</span>
        </template>
      </at-input>

      <!-- 招聘人数 -->
      <div class="col-md-15">
        <at-input class="mt10" v-model="need_num" placeholder type="number">
          <template slot="prepend">
            <span>招聘人数</span>
          </template>
        </at-input>
      </div>
    </div>
    <div class="col-md-18">
      <!-- 详情 -->
      <at-textarea minRows="8" class="mt10" v-model="job_info" placeholder="请输入职位详情..."></at-textarea>
      <at-button class="mt10 f_right" type="primary" @click="add_job()" :disabled="need_num == '' || job_type == '' || job_name == '' || job_info == ''">添加职位</at-button>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Vue from "vue";
export default {
  name: "AddJob",
  data() {
    return {
      all_type: [],
      job_type: "",
      job_name: "",
      need_num: 1,
      job_info: ""
    };
  },
  methods: {
    // 添加职位
    add_job: function(){
      var _this = this;
      axios
        .get("http://job.cc/job.php", {
          params: {
            add_job: "add",
            job_type: _this.job_type,
            job_name: _this.job_name,
            need_num: _this.need_num,
            job_info: _this.job_info
          }
        })
        .then(function(res) {
          if(res.data == 'ok'){
            _this.job_type = '',
            _this.job_name = '',
            _this.need_num = 1,
            _this.job_info = ''
            const Toast = Vue.swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 5000
            });
            Toast.fire({
              type: "success",
              title: "成功添加一个职位！"
            });
          }else if(res.data == 'has'){
            const Toast = Vue.swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 5000
            });
            Toast.fire({
              type: "info",
              title: "该部门已经存在该职位！"
            });
          }else{
            _this.$Message("系统错误");
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    // 获取部门
    get_type: function() {
      var _this = this;
      axios
        .get("http://job.cc/type.php", {
          params: {
            get_type: "get"
          }
        })
        .then(function(res) {
          res.data.forEach(element => {
            _this.all_type.push(element.job_type);
          });
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  },
  mounted: function() {
    this.get_type();
  }
};
</script>
<style>
.vs__dropdown-toggle {
  border: 1px solid #c5d9e7;
  font-size: 12px;
  color: #999;
}
.v-select {
  cursor: pointer;
}
</style>