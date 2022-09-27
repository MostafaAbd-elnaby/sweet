<template>
  <section class="home-products">
    <div class="container">
      <section-title>{{ $t("index.someProducts") }}</section-title>
      <product-list :products="products" />
      <div class="text-center">
        <app-button
          :label="$t('index.labelButton')"
          url="/shop"
          class="q-mt-lg"
          :class="!$q.screen.lt.md ? '' : 'block'"
        />
      </div>
    </div>
  </section>
</template>

<script>
import SectionTitle from "../UI/SectionTitle.vue";
import ProductList from "../Product/ProductList.vue";
export default {
  components: { ProductList, SectionTitle },
  computed: {
    products() {
      return this.$store.getters["Products/homeProduct"];
    }
  },
mounted () {

}
};
</script>

<style></style>
