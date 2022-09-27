import Vue from 'vue'
import Vuex from 'vuex'

import Products from './Products'
import cart from './cart'
import wishlist from './wishlist'
import account from './account'
import home from './home'
import order from './order'

Vue.use(Vuex)

/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Store instance.
 */
export default function ( /* { ssrContext } */ ) {
  const Store = new Vuex.Store({
    modules: {
      Products,
      cart,
      wishlist,
      home,
      account,
      order
    },

    // enable strict mode (adds overhead!)
    // for dev mode only
    strict: process.env.DEBUGGING
  })

  return Store
}
