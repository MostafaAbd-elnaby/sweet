<template>
  <div class="subtotal">
    <div class="flex justify-between q-pb-md ">
      <currency class="text-subtitle1 semi-bold text-primary" :value="subtotal" />
    </div>
    <slot></slot>
    <div class="checkout-btn">
      <app-button
        :label="$t('ui.checkout')"
        :flat="false"
        class="full-width"
        url="/Checkout/information"
      ></app-button>
    </div>
  </div>
</template>

<script>
import Currency from "components/UI/currency";
export default {
  components: { Currency },
  computed: {
    subtotal() {
      return this.$store.getters["cart/subtotal"];
    }
  }
};
</script>

<style></style>
