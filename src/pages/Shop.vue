<template>
  <div class="shop-page">
    <h3 class="text-center q-mb-sm"> {{$t('shop.title')}}</h3>
    <breadcrumbs :current="$t('shop.title')" />

    <div v-if="!$q.screen.lt.md" class="q-px-xl" >
      <div class="row q-col-gutter-md">
        <transition appear enter-active-class="animated fadeInRight slower">
          <div class="col-md-3 col-lg-2">
            <shop-filter />
          </div>
        </transition>
        <transition appear enter-active-class="animated fadeInLeft slower">
          <div class="col-md-9 col-lg-10">
            <template v-if="products.total">

              <Categorise @childCat="childCat" title="Categories" />

              <Categorise v-if="showCatChild" @childCat="childCat" :catChild="catChildrenis" :title="catChildrenis.name_en" />

              <sort class="q-mb-md" />
              <product-list :products="products" />
            </template>
            <template v-else>
              <no-data-animate text="Sorry! no products founded try to remove some of the filter" />
            </template>
          </div>
        </transition>
      </div>
    </div>

    <div v-else class="mobile-layout">
      <div class="container">
        <Categorise title="Categories" @childCat="childCat" />
        <Categorise v-if="showCatChild" @childCat="childCat" :catChild="catChildrenis" :title="catChildrenis.name_en"  />
        <div class="flex q-my-lg">
        <q-btn
          icon="las la-filter"
          color="transparent"
          flat
          text-color="primary"
          label="Filter"
          @click="filterDrawer = true"
        />
        <sort />
      </div>
        <template v-if="products.total">

          <product-list :products="products" />
        </template>
        <template v-else>
          <no-data-animate text="Sorry! no products founded try to remove some of the filter" />
        </template>
      </div>
      <q-drawer side="left" v-model="filterDrawer" overlay>
        <q-card>
          <q-card-section>
            <shop-filter />
          </q-card-section>
        </q-card>
      </q-drawer>
    </div>

    <services class="q-mt-xl" />
  </div>
</template>

<script>
import Breadcrumbs from "components/UI/Breadcrumbs.vue";
import ShopFilter from "components/shop/ShopFilter.vue";
import ProductList from "components/Product/ProductList.vue";
import noDataAnimate from "components/Product/no-data-animate.vue";
import Sort from "src/components/Shop/Sort.vue";
import Services from "src/components/Services/Services.vue";
import Categorise from "components/Categorise/Categorise";
export default {
  components: { Breadcrumbs, Services, ShopFilter, ProductList, Sort, noDataAnimate, Categorise },
  data() {
    return {
      filterDrawer: false,
      showCatChild: false,
      catChildrenis: null,
    };
  },
  computed: {
    products() {
      return this.$store.getters["Products/products"];
    }
  },
  methods : {
    childCat(cat) {
      this.showCatChild = true
      this.catChildrenis = cat
    }
  }
};
</script>

<style></style>
