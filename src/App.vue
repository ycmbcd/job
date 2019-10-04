<template>
  <div>
    <job-top></job-top>
    <div id="app">
      <a href="#/">
        <div id="logo">ABC招聘系统Logo</div>
      </a>
      <div id="job_view">
        <router-view />
      </div>
    </div>
  </div>
</template>

<script>
import JobTop from "@/components/JobTop";

export default {
  name: "App",
  components: {
    JobTop
  }
};
</script>
