// import something here
import {  Cookies, LocalStorage, Loading, QSpinnerIos  } from 'quasar'
import  Quasar from 'quasar'

export default async ({ store, router, app}) => {

   router.beforeEach((to, from, next) => {


    /*
    ***********************
    ****** Cookies *******
    ***********************
     */

    const langCookies          = Cookies.get('lang');
    const cartItems     = Cookies.get('cart',     { parseJSON : true });
    const SingleProduct = Cookies.get('SingleProduct', { parseJSON : true });
    const account       = Cookies.get('account', { parseJSON : true });
    const offer         = JSON.parse(LocalStorage.getItem('offer'));
    if (cartItems && cartItems.length > 0) {
      store.commit('cart/INIT_CART', cartItems )
    }
    if ( offer // 👈 null and undefined check
      && Object.keys(offer).length === 0
      && Object.getPrototypeOf(offer) === Object.prototype) {
      store.commit('cart/GET_COUPON', offer )
    }
    if (account) {
      const newAccount = account.login ? account.user : account
      store.dispatch('account/userInCoolies', newAccount ).then(res => {});
    }

    const asdasd = {
      id: 1,
      name: 'asdasd'
    }

    const {id} = asdasd

     /*
     ***********************
     ****** Lang *******
     ***********************
      */

     import(
     'quasar/lang/'+ langCookies
       ).then(lang => {

       Quasar.lang.set(lang.default)
       app.i18n.locale = langCookies
     })



    /*
    ***********************
    ******* Loading *******
    ***********************
     */

    Loading.show({
      spinner: QSpinnerIos
    })

    /*
    ***********************
    ******** Store ********
    ***********************
     */

    const cats = store.state.home.cats;
    const collections = store.state.home.collections;
    const products = store.state.Products.products;

    store.dispatch('home/getSettings');


    if (!cats.length) {
      store.dispatch('home/getCats')
    }
    if (to.name === 'home') {
        if (!collections.length) {
          store.dispatch('home/getCollections').then(res => {
            store.commit('Products/GET_HOME_PRODUCTS', res)
          })
        } else {
          if (!products.length)
          store.commit('Products/GET_HOME_PRODUCTS', collections);
        }
    }

    if (to.name === 'shop-print') {
      store.dispatch('Products/getShopPrintProduct', {})
    }

    if (to.name === 'shop') {
      if (to.query) {
        let payload = {search: 'true'}
        for (const i in to.query) {
          payload[i] = to.query[i]
        }
          store.dispatch('Products/getShopProduct', payload)
      } else {
        store.dispatch('Products/getShopProduct', {})
      }
    }

    if (to.name === "product_page") {
      store.dispatch('Products/getProduct', to.params.id ).then( res => {
        console.log(to.name)
        return next()
      } ).catch(err => {
        console.log('Single Product Request Error => ' , err)
        return next()
      });
    }

    return next()

  })

  router.afterEach((to, from, next) => {
    /*
    ***********************
    ******* Loading *******
    ***********************
     */
    Loading.hide()

  })

}
