import {Cookies} from "quasar";
import {api} from 'boot/axios'

const CookiesOption = {
  path: '/',
  maxAge: 60 * 60 * 24 * 7
}

const state = {
  products: {
    data: [
      {
        copone_offers: {id: false}
      }
    ]
  },
  homeProduct: {
    data: []
  },
  product: {},
  printProduct: [],
  filter: [],
  reviews: {data: null},
  search: {
    data: []
  }
}
const mutations = {
  SORTING_PRODUCTS_BY_NAME({
    products
  }, name) {
    products = products.data.sort((a, b) => {
      if (name == 'asc')
        return a.name_en > b.name_en ? 1 : -1

      else if (name == 'desc')
        return a.name_en < b.name_en ? 1 : -1
    })
  },
  SORTING_PRODUCTS_BY_PRICE({
    products
  }, name) {
    products = products.data.sort((a, b) => {
      if (name == 'asc')
        return a.price > b.price ? 1 : -1
      else if (name == 'desc')
        return b.price > a.price ? 1 : -1
    })
  },
  // FILTER_PRODUCTS(state, payload) {
  //   state.filter = payload
  // },
  SHOW_PRODUCTS(state, payload) {
    state.product = payload
    Cookies.set('SingleProduct', payload, CookiesOption)
  },
  HOME_PRODUCTS(state, payload) {
    state.homeProduct = payload
  },
  GET_HOME_PRODUCTS( state, payload ) {
    const homeProduct = payload.filter( coll => coll.is_home)
    state.homeProduct.data = homeProduct[0].products
  },
  GET_SHOP_PRODUCTS( state, payload ) {
    state.products = payload
  },
  GET_SHOP_FILTER( state, payload ) {
    state.filter = payload
  },
  GET_SHOP_PRINT( state, payload ) {
    state.printProduct = payload
  },
  PRODUCT_SEARCH( state, payload ) {
    state.search = payload
  },
  GET_REVIEWS( state, payload ) {
    state.reviews = payload
  },
  CREATE_REVIEW( state, payload ) {
    state.reviews.data.unshift(payload)
  },
}

const actions = {
  sortingProducts({
    commit
  }, payload) {
    if (payload.type === 'title')
      commit('SORTING_PRODUCTS_BY_NAME', payload.name)
    if (payload.type === 'price')
      commit('SORTING_PRODUCTS_BY_PRICE', payload.name)
  },
  // filterProducts({
  //   commit,
  // }, payload) {
  //   commit('FILTER_PRODUCTS', payload)
  // },
  async showProduct({
     commit,
   }, payload) {
    const res = commit('SHOW_PRODUCTS', payload)
    return payload
  },
  async getProduct({ commit }, payload) {
    const res = await api.get(`product/product/${payload}`)
    commit('SHOW_PRODUCTS', await res.data)
    return res
  },
  async searchProduct({ commit }, payload) {
    let page = payload.page ? payload.page : ''
    const res = await api.post(`product/search${page}`, payload)
    commit('PRODUCT_SEARCH', await res.data.products)
    return res
  },
  async getShopProduct({ commit }, payload) {
    let page = payload.page ? payload.page : ''
    delete payload.page
    const res = await api.post(`product/search${page}`, payload)
    commit('GET_SHOP_PRODUCTS', await res.data.products)
    commit('GET_SHOP_FILTER', await res.data.filter)
    return res
  },

  async getShopPrintProduct({ commit }) {
    const res = await api.get('product/shop-print-product')
    commit('GET_SHOP_PRINT', await res.data)
    return res
  },

  async getreviews ({ commit }, payload) {
    const res = await api.get(`ProductComments/${payload}`)
    commit('GET_REVIEWS', await res.data)
    return res
  },

  async createreview({ commit }, payload) {
    const res = await api.post('createOrUpdateProductsComments', payload)
    commit('CREATE_REVIEW', await res.data)
    return res
  },

}

const getters = {
  search: (state) => state.search,
  homeProduct: (state) => state.homeProduct,
  reviews: (state) => state.reviews,
  printProduct: (state) => state.printProduct ? state.printProduct : {},
  singleProduct: (state) => state.product ? state.product : {},
  relatedProducts: (state) => {
    const randomNumber = Math.floor(Math.random() * state.products.length)
    let relatedProducts = state.products.slice(0, 5);
    return relatedProducts;
  },
  filterProducts (state) {
    return state.filter
  },
  products (state) {
    return state.products
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
