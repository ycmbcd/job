<template>
  <div id="app">
    <div id="logo">
      招聘系统
    </div>
    <div id="job_view">
      <router-view/>
    </div>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style lang="stylus">
#app
  margin 40px;
#logo
  color #dedede;
  padding 10px 20px;
  font-size 30px;
#job_view
  margin 10px 40px;
</style>