import './bootstrap';

import { createApp } from 'vue'
import router from './router'
import App from './App.vue'
import toastr from 'toastr'
import 'toastr/build/toastr.min.css'

const app = createApp(App)
app.config.globalProperties.$toastr = toastr
app.use(router).mount("#app")
