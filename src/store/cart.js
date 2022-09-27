import { Cookies, Notify, lang } from 'quasar'
import {api} from "boot/axios";

console.log(lang)

const CookiesOption = {
  path: '/',
  maxAge: 60 * 60 * 24 * 7
}

function sentNotify (message, color = null, textColor= null, icon= null, timeout = 500) {
  Notify.create({
    message: message,
    icon: icon,
    color: color,
    textColor: textColor,
    timeout: timeout,
  })
}

const state = {
  cartItems: [],
  currency: 'ريال',
  shippingCost: 10,
  tax: 0.15,
  offer: {id: false}
}

const mutations = {
  INIT_CART(state, payload) {
    state.cartItems = payload
    Cookies.remove('cart')
    Cookies.set('cart', state.cartItems, CookiesOption)
  },
  ADD_TO_CART(state, payload) {
    const product = payload.product
    const qu = payload.qu
    console.log(qu)
    const addedProduct = {
      ...product,
      qu: qu
    }
    const productIndex = state.cartItems.findIndex(item => product.id === item.id)
    let itemToAdd = state.cartItems[productIndex]
    if (productIndex === -1) {
      state.cartItems.push(addedProduct)
      sentNotify('product_added_to_cart', null, null , 'check' )
    } else {
      if ( product.color.color === itemToAdd.color.color && product.size === itemToAdd.size ) {
        itemToAdd.qu += 1
        sentNotify('The_product_already_in_the_cart', 'white', 'black')
      }else {
        state.cartItems.push(addedProduct)
        sentNotify('new_color_added_to_cart', 'white', 'black')
      }
    }
    state.cartItems.sort((a, b) => {
      return a.name > b.name ? 1 : -1
    })
    Cookies.set('cart', JSON.stringify(state.cartItems), CookiesOption)

  },
  REMOVE_PRODUCT(state, payload) {
    state.cartItems.splice(payload, 1)
    state.cartItems.sort((a, b) => {
      return a.name > b.name ? 1 : -1
    })
    Cookies.set('cart', state.cartItems, CookiesOption)
  },
  INC_DEC(state, payload) {
    let qu = 0
    const product = payload.product
    const productIndex = state.cartItems.findIndex(item =>
      product.id === item.id &&
      product.color.color === item.color.color &&
      product.size === item.size)
    let inCart = state.cartItems[productIndex].qu
    if (payload.type === 'inc')
      qu = inCart + payload.qu
    else
      qu = inCart + payload.qu
    state.cartItems[productIndex].qu = qu
  },

  GET_COUPON(state, payload) {
    state.offer = payload
  },

  async EMPTY_CART ( state ) {
    state.cartItems = []
  }

}

const actions = {
  addToCart({
    commit
  }, payload) {
    // delete payload.product.colors
    // delete payload.product.sizes
    commit('ADD_TO_CART', payload)
  },
  removeProduct({
    commit
  }, payload) {
    commit('REMOVE_PRODUCT', payload)
    Notify.create({
      message: 'product removed',
      color: 'red',
      icon: 'check',
      timeout: 500,
    })
  },
  inc_dec({
    commit
  }, payload) {
    commit('INC_DEC', payload)
  },
  async getOffer({ commit }, payload) {
    const res = await api.post('CouponOffers/checkCoupon', payload)
    commit('GET_COUPON', await res.data)
    return res
  },
}

const getters = {
  cartItems:     state => state.cartItems,
  currency:      state => state.currency,
  tax:           state => state.tax,
  shippingCost:  state => state.shippingCost,
  offer:         state => state.offer,
  cartLength:    state => {
    return state.cartItems.reduce((accumlator, current) => {
      return accumlator + current.qu
    }, 0)
  },
  subtotal: state => {
    return state.cartItems.reduce((accumlator, current) => {
      const subtotal = current.price * current.qu
      return accumlator + subtotal
    }, 0)
  },
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
