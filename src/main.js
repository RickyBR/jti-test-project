import { createApp } from 'vue'
import App from './App.vue'

import Echo from "laravel-echo"
import Pusher from 'pusher-js';

import router from './router';

import axios from 'axios';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: "local",
    wsHost: "127.0.0.1",
    wsPort: 6001,
    cluster: "mt1",
    forceTLS: false,
    disableStats: true,
    encrypted: true,

});
const app = createApp(App);

app.config.globalProperties.$axios = axios;

app.use(router)
.mount('#app')