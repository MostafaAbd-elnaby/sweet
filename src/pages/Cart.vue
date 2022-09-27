<template>
  <div class="cart-page">
    <h4 class="text-h4 text-center q-mb-sm">{{$t('card.title')}}</h4>
    <breadcrumbs :current="$t('Your Shopping Cart')" />

    <cart-table />

    <div v-if="cartItems.length" class="container q-mt-xl">
      <div class="coupon-subtotal">
        <coupon />
        <q-separator color="grey" class="q-my-md" />

        <subtotal-box>
<!--          <span class="text-subtitle2 text-grey block q-mb-md">-->
<!--              {{$t('card.tax')}}-->
<!--          </span>-->
        </subtotal-box>
      </div>
    </div>

  </div>
</template>

<script>
import Breadcrumbs from "src/components/UI/Breadcrumbs.vue";
import CartTable from "src/components/ShoppingCart/CartTable.vue";
import SubtotalBox from "src/components/UI/SubtotalBox.vue";
import Coupon from "src/components/ShoppingCart/Coupon.vue";
export default {
  components: { Breadcrumbs, CartTable, SubtotalBox, Coupon },
  computed: {
    cartItems() {
      return this.$store.getters["cart/cartItems"];
    }
  },
};
</script>

<style lang="scss">
@media (min-width: 600px) {
  .coupon-subtotal {
    max-width: 45%;
    margin-left: auto;
  }
}
@media (min-width: 1200px) {
  .coupon-subtotal {
    max-width: 25%;
    margin-left: auto;
  }
}
</style>
