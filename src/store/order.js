import {api} from 'boot/axios'
import axios from "axios";
import {Notify} from "quasar";
const state = {
  orders: {data: []},
  order: {},
}

const mutations = {
  GET_ORDERS(state, payload) {
    state.orders = payload
  },
  GET_ORDER(state, payload) {
    state.order = payload
  },
}

const actions = {
  async getOrders({ commit }, payload) {
    payload.page = payload.page ? '?page=' + payload.page : ''
    const res = await api.get(`orders/ShowAll/${payload.id}${payload.page}`)
    commit('GET_ORDERS', await res.data)
    return res
  },
  async getOrder({ commit }, payload) {
    const res = await api.post('orders/trackingOrShowSingle', payload)
    commit('GET_ORDER', await res.data)
    return res.data
  },
  async createOrder({ commit }, payload) {
    const res = await api.post('orders/create', payload)
    // const res = await axios.post('/sweet.build/api/orders/create', payload)
    commit('GET_ORDER', await res.data.order)
    return res.data
  },

  async SendCheckoutId({ commit }, payload) {
    const res =  await api.post('checkout/status' ,payload );
    const {data} = res
    // const {status} = res
    console.log(data.message , data.code)
    if(data.status){
      Notify.create({
        message: data.message,
        color: "green",
        textColor: "white",
        position:"top"
      })
    }else {
      Notify.create({
        message: data.message,
        color: "red",
        textColor: "white",
        position:"top"
      })
    }
  },

}

const getters = {
  orders: (state) => state.orders,
  order: (state) => state.order,
}


export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
