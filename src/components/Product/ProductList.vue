<template>
  <div class="product-list">

    <q-card flat  v-if="products.data[0]" class="bg-transparent row q-col-gutter-xs">
      <div
        class="col-6 col-sm-4 col-md-3"
        v-for="product in products.data"
        :key="product.id"
      >
        <product-card :product="product" />
      </div>
      <q-card-section v-if="this.$route.name !== 'home'" class=" col-12 justify-center  row q-pa-none">
        <q-pagination
          v-model="current_page"
          :max="products.last_page"
          @input="pagination"
          input
          icon-last="las la-angle-double-right"
          icon-first="las la-angle-double-left"
          icon-next="las la-angle-right"
          icon-prev="las la-angle-left"
        />
      </q-card-section>
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


  </div>
</template>

<script>
import ProductCard from "../Product/ProductCard.vue";
import SkeletonProductCart from "components/Product/skeletonProductCart";
export default {
  props: ["products"],
  components: {SkeletonProductCart, ProductCard },
  data() {
    return {
      current_page: 1
    }
  },
  methods: {
    async pagination () {
      const to = this.$route
      if (to.query) {
        let payload = {search: 'true'}
        for (const i in to.query) {
          payload[i] = to.query[i]
        }
        payload['page'] = this.current_page ? '?page=' + this.current_page : ''
        await this.$store.dispatch('Products/getShopProduct', payload).then(res => {
        })
      }
    }
  },
    mounted(){

  }
};
</script>

<style></style>
