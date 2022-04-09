import {createApp} from 'vue'
import App from './App.vue'
import router from './router'

import 'bootstrap-icons/font/bootstrap-icons.css'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap/dist/js/bootstrap.bundle'
import axios from "axios";
import jwtDecode from "jwt-decode";

console.log('fwef')

axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token')
axios.interceptors.request.use(request => {
    //if (request.url.)

    let token = localStorage.getItem('access_token')
    if (!token || jwtDecode(token).exp <= Date.now())
        return axios.post('/api/login', {
            email: "devris@scdhn.com",
            password: "11111111"
        }).then(response => {
            let token = response.data.access_token
            localStorage.setItem('access_token', token)
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            return request;
        })
    return request;
})

const app = createApp(App)

app.use(router)

app.mount('#app')
