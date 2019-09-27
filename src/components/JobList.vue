<template>
  <div class="j_panel">
    <table class="j_table">
      <tr class="j_th">
        <td>职位编号</td>
        <td>部门</td>
        <td>职位名</td>
        <td>招聘人数</td>
        <td>发布日期</td>
      </tr>
      <tr>
        <td>1</td>
        <td>总务</td>
        <td><a href="#">资料管理员岗位</a></td>
        <td>2</td>
        <td>2019-09-27</td>
      </tr>
      <tr>
        <td>1</td>
        <td>总务</td>
        <td><a href="#">资料管理员岗位</a></td>
        <td>2</td>
        <td>2019-09-27</td>
      </tr>
      <tr>
        <td>1</td>
        <td>总务</td>
        <td><a href="#">资料管理员岗位</a></td>
        <td>2</td>
        <td>2019-09-27</td>
      </tr>
      <tr>
        <td>1</td>
        <td>总务</td>
        <td><a href="#">资料管理员岗位</a></td>
        <td>2</td>
        <td>2019-09-27</td>
      </tr>
      <tr>
        <td>1</td>
        <td>总务</td>
        <td><a href="#">资料管理员岗位</a></td>
        <td>2</td>
        <td>2019-09-27</td>
      </tr>
      <tr>
        <td>1</td>
        <td>总务</td>
        <td><a href="#">资料管理员岗位</a></td>
        <td>2</td>
        <td>2019-09-27</td>
      </tr>
      <tr>
        <td>1</td>
        <td>总务</td>
        <td><a href="#">资料管理员岗位</a></td>
        <td>2</td>
        <td>2019-09-27</td>
      </tr>
    </table>
    <div class="f_right mt20">
      <at-pagination :total="60"></at-pagination>
    </div>
    <div class="clear"></div>
  </div>
</template>

<script>
export default {
 
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
.j_table td{
  padding: 4px 10px;
  border: 1px solid #e9e9e9;
  height: 38px;
}
</style>