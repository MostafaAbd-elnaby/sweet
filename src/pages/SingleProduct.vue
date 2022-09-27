<template>
  <div>

    <product-overview v-if="product && Object.keys(product).length !== 0 " :product="product" class="q-my-md" />

    <expansion-mode :productDec="product" class="q-my-md" />

<!--    <related-products class="q-my-md" />-->

    <services class="q-mt-md" />

  </div>
</template>

<script>
import ProductOverview from "src/components/SingleProduct/ProductOverview.vue";
import ExpansionMode from "src/components/SingleProduct/ExpansionMode.vue";
import RelatedProducts from "src/components/SingleProduct/RelatedProducts.vue";
import Services from "src/components/Services/Services.vue";

export default {
  components: { ProductOverview, ExpansionMode, Services },
  computed: {
    product() {
      return this.$store.getters["Products/singleProduct"]
    }
  },
  watch: {
   product(val) {
     this.color = val.colors[0]
   }
  }
};
</script>
