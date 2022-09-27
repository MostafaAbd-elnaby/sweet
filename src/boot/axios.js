import Vue from 'vue'
import axios from 'axios'

Vue.prototype.$axios = axios

let headers = {
  header: {
    'Content-Type': "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2),
    'Access-Control-Allow-Origin' : '*',
  },
  processData: false,
  contentType: false
};

const local = 'http://sweet.build/'
const server = 'http://sweet-api.alfatechegy.com/'
const domain = local                      // Change to local for Testing

const api = axios.create({
  baseURL: domain + 'api/',
  withCredentials: false,
  headers
})

Vue.prototype.$axios = api
Vue.prototype.$storage = domain + 'storage/'

export { api }
