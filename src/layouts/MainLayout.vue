<template>
  <q-layout view="lHr lpR lFr" style="background-color: #f7f7f7; padding-bottom: 0 !important;">
    <!-- Header -->
    <q-header class="bg-white text-back" >
      <div class="container">
        <q-toolbar class="flex justify-between q-px-none">
          <div v-if="$q.screen.lt.md">
            <q-btn
              flat
              dense
              color="black"
              round
              icon="menu"
              aria-label="Menu"
              @click="mobileDrawe = !mobileDrawe"
            />
          </div>

          <q-toolbar-title class="text-left q-pt-sm">

              <q-btn
                v-if="!$q.screen.lt.md"
                flat
                dense
                round
                color="black"
                icon="menu"
                aria-label="Menu"
                @click="categoriesParentDrawe = !categoriesParentDrawe"
              >
                <q-tooltip
                  v-if="!$q.screen.lt.md"
                  anchor="top middle"
                  self="bottom middle"
                  :offset="[10, 10]"
                  content-style="background-color: #000"
                >
                  <strong>{{$t('categories')}}</strong>
                </q-tooltip>
              </q-btn>

            <router-link to="/">
<!--              Yalla2Print-->
              <q-img class="logo" :src="$store.getters['home/settings'].logo" />
            </router-link>
          </q-toolbar-title>

          <desktop-nav class="text-center" v-if="!$q.screen.lt.md" />

          <div class="icons" v-if="!$q.screen.lt.md">
            <q-btn
              flat
              dense
              color="black"
              size="15px"
              icon="las la-search"
              class="q-mr-sm cursor-pointer"
              @click="search = true"
            >
              <q-tooltip
                v-if="!$q.screen.lt.md"
                anchor="top middle"
                self="bottom middle"
                :offset="[10, 10]"
                content-style="background-color: #000"
              >
                <strong>{{$t('search')}}</strong>
              </q-tooltip>
            </q-btn>
            <q-btn
              v-if="!$q.screen.lt.md"
              flat
              color="black"
              dense
              size="15px"
              :icon="is_login ? 'las la-user-alt' : 'las la-sign-in-alt'"
              class="q-mr-sm cursor-pointer"
              :to="is_login ? '/Account/profile/info' : '/Account/login'"
            >
              <q-tooltip
                v-if="!$q.screen.lt.md"
                anchor="top middle"
                self="bottom middle"
                :offset="[10, 10]"
                content-style="background-color: #000"
              >
                <strong>{{ is_login ? 'Profile' : 'Login' }}</strong>
              </q-tooltip>
            </q-btn>
            <q-btn
              flat
              dense
              color="black"
              size="15px"
              icon="las la-shopping-bag"
              class="cursor-pointer"
              @click="shoppingCartDrawer = true" >
              <q-badge color="red" floating rounded>{{ cartLength }}</q-badge>
              <q-tooltip
                v-if="!$q.screen.lt.md"
                anchor="top middle"
                self="bottom middle"
                :offset="[10, 10]"
                content-style="background-color: #000"
              >
                <strong>{{$t('cart')}}</strong>
              </q-tooltip>
            </q-btn>
          </div>
        </q-toolbar>
      </div>
    </q-header>

    <!-- footer mob -->
    <q-footer
      v-if="$q.screen.lt.sm"
      bordered
      elevated
      class="bg-white text-black"
    >
      <q-tabs v-model="tab">
        <q-tab :name="$t('links.home')" @click="$router.push('/')" content-class="tab" icon="las la-home" />
        <q-tab :name="$t('links.shop')" @click="categoriesParentDrawe = true" content-class="tab" icon="las la-border-all" />
        <q-tab :name="$t('links.shop')" @click="$router.push('/Shop')" content-class="tab" icon="las la-store" />
        <q-tab
          :name="$t('search')"
          content-class="tab"
          icon="las la-search"
          @click="search = true"
        />
        <q-tab
          :name="$t('cart')"
          content-class="tab"
          icon="las la-shopping-bag"
          @click="shoppingCartDrawer = true"
        >
          <q-badge color="red" floating rounded>{{ cartLength }}</q-badge>
        </q-tab>
      </q-tabs>
    </q-footer>

    <!-- links drawer -->
    <q-drawer
      v-model="mobileDrawe"
      show-if-above
      overlay
      behavior="mobile"
      bordered
      content-class="bg-grey-1"
    >
      <nav-mobile />
    </q-drawer>

    <!-- Categories Parent drawer -->
    <q-drawer
      v-model="categoriesParentDrawe"
      show-if-above
      overlay
      behavior="mobile"
      bordered
      content-class="bg-grey-1"
    >
      <categories-drawer @childCat="openChildCat" @close="categoriesParentDrawe = false" />
    </q-drawer>

    <!-- Categories Child drawer -->
    <q-drawer
      v-model="categoriesChildDrawe"
      show-if-above
      overlay
      behavior="mobile"
      bordered
      content-class="bg-grey-1"
    >
      <categories-child-drawer
        v-if="categoriesChildDrawe"
        @close="categoriesChildDrawe = !categoriesChildDrawe"
        :parent="catParent" />
    </q-drawer>

    <!-- Search -->
    <transition
      appear
      enter-active-class="animated fadeIn"
      leave-active-class="animated fadeOut"
    >
      <search-container v-if="search" @close="search = false" />
    </transition>

    <q-drawer
      side="right"
      v-model="shoppingCartDrawer"
      overlay
      behavior="mobile"
      content-class="bg-grey-2"
    >
      <shopping-cart @close="shoppingCartDrawer = false"></shopping-cart>
    </q-drawer>

    <q-page-container>

      <router-view  />
    </q-page-container>
  </q-layout>
</template>

<script>
import SearchContainer from "components/Search/SearchContainer.vue";
import ShoppingCart from "src/components/ShoppingCart/ShoppingCart.vue";
import NavMobile from "src/components/Nav/MobileNav.vue";
import categoriesDrawer from "src/components/Nav/categoriesDrawer.vue";
import categoriesChildDrawer from "src/components/Nav/categoriesChildDrawer.vue";
import DesktopNav from "src/components/Nav/DesktopNav.vue";
import LangSwetcher from "components/UI/LangSwetcher";

export default {
  name: "MainLayout",
  components: { SearchContainer, ShoppingCart, NavMobile, DesktopNav, categoriesDrawer, categoriesChildDrawer },
  data() {
    return {
      mobileDrawe: false,
      shoppingCartDrawer: false,
      categoriesParentDrawe: false,
      categoriesChildDrawe: false,
      catParent: null,
      tab: "home",
      search: false
    };
  },

  computed: {
    cartLength() {
      return this.$store.getters["cart/cartLength"];
    },
    wishlistLength() {
      return this.$store.getters["wishlist/wishlistLength"];
    },
    is_login () {
      return this.$store.getters['account/is_login']
    }
  },
  methods: {
    openChildCat ( cat ) {
      this.categoriesChildDrawe = !this.categoriesChildDrawe
      this.catParent = cat
    }
  }
};
</script>
<style lang="sass">
.logo
  width: 190px
.q-toolbar__title
  flex: none !important


</style>
