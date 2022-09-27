import {
  Cookies,
  Notify
} from 'quasar'

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
  wishlistItems: [],
}

const mutations = {
  INIT_WISHLIST(state, payload) {
    state.wishlistItems = payload
  },
  ADD_TO_WISHLIST(state, payload) {
    const product = payload.product
    const quantity = payload.quantity
    const addedProduct = {
      ...product,
      inCart: quantity
    }
    const productIndex = state.wishlistItems.findIndex(item => product.id === item.id)
    let itemToAdd = state.wishlistItems[productIndex]
    if (productIndex === -1) {
      state.wishlistItems.push(addedProduct)
      sentNotify('product_added_to_wishlist', null, null , 'check' )
    } else {
        sentNotify('The_product_already_in_the_wishlist', 'white', 'black')
    }
    Cookies.set('wishlist', state.wishlistItems)
  },
  REMOVE_PRODUCT(state, payload) {
    const productIndex = state.wishlistItems.findIndex(item => payload.id === item.id)
    state.wishlistItems.splice(productIndex, 1)
  },
  INC_DEC(state, payload) {
    let quantity = 0
    const product = payload.product
    const productIndex = state.wishlistItems.findIndex(item => product.id === item.id)
    let inCart = state.wishlistItems[productIndex].inCart
    if (payload.type === 'inc')
      quantity = inCart + payload.quantity
    else
      quantity = inCart + payload.quantity
    state.wishlistItems[productIndex].inCart = quantity
  }

}

const actions = {
  addToWishlist({
              commit
            }, payload) {
    // delete payload.product.colors
    // delete payload.product.sizes
    commit('ADD_TO_WISHLIST', payload)
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
  }
}

const getters = {
  wishlistItems: state => state.wishlistItems,
  currency:  state => state.currency,
  wishlistLength: state => {
    return state.wishlistItems.reduce((accumlator, current) => {
      return accumlator + current.inCart
    }, 0)
  },
  subtotal: state => {
    return state.wishlistItems.reduce((accumlator, current) => {
      const subtotal = current.price * current.inCart
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
