<template>
  <div>
    <div class="col-md-5">
      <at-input v-model="new_type" placeholder="请输入部门名称" append-button>
        <template slot="append">
          <span @click="add_type()">添加</span>
        </template>
      </at-input>
    </div>
    <div class="col-md-8">
      <table class="j_table mt20">
        <tr class="j_th">
          <td>部 门</td>
          <td>操 作</td>
        </tr>
        <tr v-for="(item,index) in all_type" :key="index">
          <td>{{item.job_type}}</td>
          <td>
            <span class="c_blue">
              <at-button size="smaller" icon="icon-edit">编辑</at-button>
            </span>&nbsp;&nbsp;
            <span class="c_red">
              <at-button size="smaller" icon="icon-trash-2">删除</at-button>
            </span>
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import axios from "axios";
export default {
  name: "AdminType",
  data() {
    return {
      new_type: "",
      all_type: []
    };
  },
  mounted: function(){
      this.get_type();
  },
  methods: {
      // 查询部门
      get_type: function(){
          var _this = this;
          axios
          .get("http://job.cc/type.php", {
            params: {
              get_type: 'all'
            }
          })
          .then(function(res) {
              _this.all_type = res.data;
          })
          .catch(function(error) {
            console.log(error);
          });
      },
    // 添加一个部门
    add_type: function() {
      var _this = this;
      if (_this.new_type == "") {
        const Toast = Vue.swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000
        });
        Toast.fire({
          type: "info",
          title: "请输入部门名称。"
        });
      } else {
        axios
          .get("http://job.cc/type.php", {
            params: {
              add_type: _this.new_type
            }
          })
          .then(function(res) {
            if (res.data == "ok") {
                _this.get_type();
            }else if(res.data == "has"){
                const Toast = Vue.swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000
                });
                Toast.fire({
                    type: "info",
                    title: "已存在此部门。"
                });
            }else{
              const Toast = Vue.swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000
              });
              Toast.fire({
                type: "info",
                title: "添加失败"
              });
            }
          })
          .catch(function(error) {
            console.log(error);
          });
      }
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