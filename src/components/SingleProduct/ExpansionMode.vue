<template>
  <div class="container">
    <q-list class="q-my-lg expansion-mode">
      <q-expansion-item
        expand-separator
        default-opened
        :label="$t('review.desc')"
      >
        <product-description :desc="productDec" />
      </q-expansion-item>

      <q-expansion-item expand-separator :label="$t('review.ShipRet')">
        <shipping-return />
      </q-expansion-item>

      <q-expansion-item expand-separator :label="$t('review.policies')">
        <shipping-policies />
      </q-expansion-item>

      <q-expansion-item default-opened expand-separator :label="$t('review.reviews')">
        <product-review />
      </q-expansion-item>
    </q-list>
  </div>
</template>

<script>
import ProductDescription from "./ProductDescription.vue";
import ProductReview from "./review/ProductReview.vue";
import ShippingPolicies from "./ShippingPolicies.vue";
import ShippingReturn from "./ShippingReturn.vue";
export default {
  props: ['productDec'],
  components: {
    ProductDescription,
    ShippingReturn,
    ShippingPolicies,
    ProductReview
  }
};
</script>

<style>
.expansion-mode .q-item__label {
  font-size: 18px;
  font-weight: bold;
}
.expansion-mode .q-item__section--side > .q-icon {
  font-size: 30px;
  font-weight: bold;
}
</style>
