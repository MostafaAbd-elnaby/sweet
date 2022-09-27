const routes = [{
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        path: '/',
        name: 'home',
        component: () => import('src/pages'),
      },
      {
        path: '/shop',
        name: 'shop',
        component: () => import('pages/Shop.vue')
      },

      {
        path: '/shop-print',
        name: 'shop-print',
        meta: {

        },
        breadcrumb: '',
        component: () => import('pages/Shop-Print.vue')
      },
      {
        path: '/About',
        name: 'About',
        component: () => import('pages/About.vue')
      },
      {
        path: '/cart',
        name: 'cart',
        component: () => import('pages/Cart.vue')
      },
      {
        path: '/product/:id',
        name: 'product_page',
        component: () => import('pages/SingleProduct.vue')
      },
      {
        path: '/Account/login',
        component: () => import('pages/Account/LogIn.vue')
      },
      {
        path: '/Account/register',
        component: () => import('pages/Account/Register.vue')
      },
      {
        path: '/Account/profile/:tab',
        component: () => import('pages/Account/Profile.vue')
      },
      {
        path: '/checkout',
        component: () => import('pages/Checkout/Payment.vue')
      },
      {
      path: '/Checkout/information',
        component: () => import('pages/Checkout/ShippingInfo.vue')
      },
      {
      path: '/Checkout/status',
        component: () => import('pages/SuccessPage.vue')
      },

    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
