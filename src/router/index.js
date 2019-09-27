import Vue from 'vue'
import Router from 'vue-router'
import JobIndex from "@/components/JobIndex";
import JobList from "@/components/JobList";

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'JobIndex',
      component: JobIndex
    },
    {
      path: '/JobList',
      name: 'JobList',
      component: JobList
    }
  ]
})
