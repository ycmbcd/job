<template>
  <div>
    <at-table :columns="columns1" :data="data3" pagination></at-table>
    <table>
        <tr>
            <td>职位编号</td>
            <td>部门</td>
            <td>职位名</td>
            <td>招聘人数</td>
            <td>发布日期</td>
        </tr>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      columns1: [
        {
          title: "职位编号",
          key: "job_id"
        },
        {
          title: "部门",
          key: "job_type"
        },
        {
          title: "职位名",
          key: "job_name"
        },
        {
          title: "招聘人数",
          key: "need_num"
        },
        {
          title: "发布日期",
          key: "job_date"
        }
      ],
      data3: this.makePageData()
    };
  },
  methods: {
    makePageData() {
      const data = [
        {
          job_id: "1",
          job_type: "总务",
          job_name: "资料管理员岗位",
          need_num: "2",
          job_date: "2019-09-27"
        },
        {
          job_id: "2",
          job_type: "总务",
          job_name: "资料管理员岗位",
          need_num: "2",
          job_date: "2019-09-27"
        }
      ];
      let pageData = [];

      for (let i = 0; i < 5; i++) {
        pageData = pageData.concat(data);
      }

      return pageData;
    }
  }
};
</script>
<style>

</style>