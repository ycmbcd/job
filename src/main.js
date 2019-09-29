// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import AtUI from 'at-ui'
import 'at-ui-style'    // 引入组件样式
import VueI18n from 'vue-i18n'
import zhLocale from 'at-ui/dist/locale/zh-CN'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
// vue-select
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)
import 'vue-select/dist/vue-select.css';

vSelect.props.components.default = () => ({
  Deselect: {
    render: createElement => createElement('span', '✕'),
  },
  OpenIndicator: {
    render: createElement => createElement('span', '▼'),
  },
});


Vue.use(AtUI);
Vue.use(VueI18n);
Vue.use(VueSweetalert2);

Vue.config.productionTip = false


const i18n = new VueI18n({
  locale: 'zh',
  fallbackLocale: 'zh',
  messages: {
    'zh': { ...zhLocale }
  }
})

AtUI.i18n((key, value) => i18n.t(key, value))

new Vue({ i18n }).$mount('#app')

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})

const options = {
  confirmButtonColor: '#41b882',
  cancelButtonColor: '#ff7674'
}

Vue.use(VueSweetalert2, options)