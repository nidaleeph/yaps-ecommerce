import {createApp} from 'vue'
import CKEditor from '@ckeditor/ckeditor5-vue'
import store from './store'
import router from './router'
import './index.css';
// import currencyUSD from './filters/currency.js'
import currencyPHP from './filters/currency.js'
// Vue.use(require('vue-moment'));

import App from './App.vue'

import PrimeVue from 'primevue/config';


const app = createApp(App);

// app.use(PrimeVue);

app
  .use(store)
  .use(router)
  .use(CKEditor)
  .mount('#app')
;

app.config.globalProperties.$filters = {
  // currencyUSD,
  currencyPHP
}
