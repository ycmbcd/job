import Vue from 'vue'
import Router from 'vue-router'
import JobIndex from "@/components/JobIndex";
import JobList from "@/components/JobList";
import JobShow from "@/components/JobShow";
import JobSend from "@/components/JobSend";
import JobLogin from "@/components/JobLogin";
import JobAdmin from "@/components/JobAdmin";
import AdminList from "@/components/admin/AdminList";
import AddJob from "@/components/admin/AddJob";
import ChangePwd from "@/components/admin/ChangePwd";
import AdminType from "@/components/admin/AdminType";
import ViewResume from "@/components/admin/ViewResume";

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
    },
    {
      path: '/JobSend',
      name: 'JobSend',
      component: JobSend
    },
    {
      path: '/JobShow',
      name: 'JobShow',
      component: JobShow
    },
    {
      path: '/JobLogin',
      name: 'JobLogin',
      component: JobLogin
    },
    {
      path: '/JobAdmin',
      name: 'JobAdmin',
      component: JobAdmin,
      children: [{
        path: 'AdminList',
        name: 'AdminList',
        component: AdminList
      },{
        path: 'AddJob',
        name: 'AddJob',
        component: AddJob
      },{
        path: 'ChangePwd',
        name: 'ChangePwd',
        component: ChangePwd
      },{
        path: 'AdminType',
        name: 'AdminType',
        component: AdminType
      },{
        path: 'ViewResume',
        name: 'ViewResume',
        component: ViewResume
      }]
    }
  ]
})
