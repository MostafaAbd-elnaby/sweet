<template>
  <div class="shop-page">
    <h3 class="text-center q-mb-sm">{{$t('shopPrint.title')}}</h3>
    <breadcrumbs :current="$t('shopPrint.title')" />
    <div v-if="!$q.screen.lt.md" class="q-px-xl" >
      <div class="row q-col-gutter-md">
        <transition appear enter-active-class="animated fadeInLeft slower">
          <div class="offset-1 col-md-10 col-lg-10">
            <template v-if="products">
              <sort class="q-mb-md" />
              <q-card flat v-if="products.length" class="row bg-transparent q-col-gutter-xs">
                <div
                  class="col-6 col-sm-4 col-md-3"
                  v-for="product in products"
                  :key="product.id"
                >
                  <print-product-card :product="product" />
                </div>
              </q-card>

              <div v-else class="row q-col-gutter-xs">
                <div
                  class="col-6 col-sm-4 col-md-3 q-px-sm"
                  v-for="i in 4"
                  :key="i"
                >
                  <skeleton-product-cart />
                </div>
              </div>
            </template>
            <template v-else>
              <no-data-animate :text="$t('shopPrint.noProducts')" />
            </template>
          </div>
        </transition>
      </div>
    </div>

    <div v-else class="mobile-layout">
      <div class="container">
        <div class="flex q-my-lg">
          <q-btn
            icon="las la-filter"
            color="transparent"
            flat
            text-color="primary"
            :label="$t('shopPrint.filter')"
          />
          <sort />
        </div>
        <template v-if="products.length">

          <q-card flat v-if="products.length" class="row q-col-gutter-xs">
            <div
              class="col-6 col-sm-4 col-md-3"
              v-for="product in products"
              :key="product.id"
            >
              <print-product-card :product="product" />
            </div>
          </q-card>
        </template>
        <template v-else>
          <no-data-animate text="Sorry! no products founded try to remove some of the filter" />
        </template>
      </div>
    </div>

    <services class="q-mt-xl" />

  </div>
</template>

<script>
import Breadcrumbs from "components/UI/Breadcrumbs.vue";
import ProductList from "components/Product/ProductList.vue";
import noDataAnimate from "components/Product/no-data-animate.vue";
import Sort from "src/components/Shop/Sort.vue";
import SkeletonProductCart from "components/Product/skeletonProductCart";
import PrintProductCard from "components/Product/PrintProductCard";
import Services from "components/Services/Services";
export default {
  components: {Services, PrintProductCard, Breadcrumbs, Sort, noDataAnimate, SkeletonProductCart  },
  data() {
    return {
      filterDrawer: false
    };
  },
  computed: {
    products() {
      return this.$store.getters["Products/printProduct"];
    }
  }
};
</script>

<style></style>
