import {api} from "boot/axios";
import {Cookies, Notify} from "quasar";

const state = {
  login: false,
  profile: {},
  guest: {
    name: "",
    phone: "",
    email: "",
    password: "",
    newPassword: "",
    city: "",
    country: "",
    address: "",
    governorate: "",
    post_code: null
  },
  orders: [],
  order: {},
  returnCheckout: false
}

const mutations = {
  GUEST_INFO(state, payload) {
    state.guest = payload
  },
  LOGIN(state, payload) {
    state.guest = payload
    state.profile = payload
    state.login = true
  },
  UPDATA_GUEST(state, payload) {
    state.guest = payload
  },
  REGISTER(state, payload) {
    state.guest = payload
    state.profile = payload
    state.login = true
  },
  LOGOUT ( state ) {
    state.guest = {}
    state.profile = {}
    state.account = {}
    state.login = false
  }
}

const actions = {
  async guestInfo({ commit }, payload) {
    return await commit('GUEST_INFO', payload)
  },
  userInCoolies({ commit }, payload) {
    commit('GUEST_INFO', payload)
    commit('REGISTER', payload)
  },
  async login({ commit }, payload) {
    const res = await api.post('Account/Login', payload)
    commit('LOGIN', await res.data)
    return res
  },
  async register({ commit }, payload) {
    const res = await api.post('Account/Register', payload)
    commit('REGISTER', await res.data)
    return res
  },
  logout({ commit }) {
    Cookies.remove('account')
    commit('LOGOUT')
    if (this.$router.currentRoute.name !== "home" ) {
      this.$router.push('/')
    }
  },
  async update({ commit }, payload) {
    Cookies.remove('account')
    const res = await api.post('Account/Update', payload)
    Cookies.set('account', res.data)
    commit('LOGIN', await res.data)
    return res
  },
}

const getters = {
  guest: (state) => state.guest,
  profile: (state) => state.profile,
  is_login: (state) => state.login,
}


export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
