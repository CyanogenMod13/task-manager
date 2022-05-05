import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from "./store";

import axios from "axios";
import jwtDecode from "jwt-decode";

axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token')
axios.interceptors.request.use(request => {
    if (request.url.endsWith('login'))
        return request

    let token = localStorage.getItem('access_token')

    if (!token || jwtDecode(token).exp * 1000 <= Date.now())
        return axios.post('/api/login', {
            email: "devris@scdhn.com",
            password: "11111111"
        }).then(response => {
            let token = response.data.access_token
            console.log(token)
            localStorage.setItem('access_token', token)
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            request.headers['Authorization'] = 'Bearer ' + token
            return request;
        })
    return request;
})

const app = createApp(App)

app.use(router)
app.use(store)

app.mount('#app')
