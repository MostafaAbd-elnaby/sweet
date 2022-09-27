import {api} from 'boot/axios'
const state = {
  cats: [],
  collections: [],
  settings: {},
  lang:''
}

const mutations = {
  GET_CATS(state, payload) {
    state.cats = payload
  },
  GET_COLLECTIONS(state, payload) {
    state.collections = payload
  },
  GET_SETTINGS(state, payload) {
    state.settings = payload
  },
  GET_LANGUAGE(state ,payload){
  state.lang = payload

  }
}

const actions = {
  changelanguage({ commit } , payload){
  commit('GET_LANGUAGE' ,payload)
  },
  async getCats({ commit }, payload) {
      const res = await api.get(`cat`)
    commit('GET_CATS', await res.data)
    return res
  },
  async getCollections({ commit }, payload) {
    const res = await api.get('collections/All')
    commit('GET_COLLECTIONS', await res.data)
    return res.data
  },
  async getSettings({ commit }, payload) {
    const res = await api.get('Settings/show')
    commit('GET_SETTINGS', await res.data)
    return res.data
  },
}

const getters = {
  cats: (state) => state.cats,
  collections: (state) => state.collections,
  settings: (state) => state.settings,
}


export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
