import './assets/main.scss'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import ElementPlus from "element-plus";
import i18n from './i18n'
const app = createApp(App);
app.use(ElementPlus);

app.use(router)
app.use(i18n)
app.mount('#app')
