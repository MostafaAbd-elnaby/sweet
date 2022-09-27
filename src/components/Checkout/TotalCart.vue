<template>
  <div class="total-card">
    <div class="flex justify-between q-mb-sm">
      <span class="text-grey text-subtitle1">
        {{$t('ShopCard.subtotal')}} :
      </span>
      <currency class="text-subtitle1 text-primary" :value="subtotal - tax" />
    </div>
    <div class="flex justify-between q-mb-sm">
      <span class="text-grey text-subtitle1">
          {{$t('ShopCard.tax')}} :
      </span>
      <div>
      <currency class="text-subtitle1 inline-block text-primary" :value="tax" />
        ( 15 % )
      </div>
    </div>
    <div class="flex justify-between ">
      <span class="text-grey text-subtitle1">
          {{$t('ShopCard.shippingT')}} :
      </span>
      <currency class="text-subtitle1 text-primary" :value="shippingCost" />
    </div>
    <div class="flex justify-between ">
      <span class="text-red text-subtitle1">
         {{$t('ShopCard.discount')}} :
      </span>
      <span class="text-subtitle1 text-red"> %{{ offer.cost ? offer.cost : 0 }}</span>
    </div>
    <q-separator class="q-my-md" />
    <div class="flex justify-between ">
      <span class="text-grey text-subtitle1">
         {{$t('ShopCard.total')}} :
      </span>
      <currency class="text-subtitle1 text-primary" :value="total" />
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
    },
    shippingCost() {
      return this.$store.getters["cart/shippingCost"];
    },
    offer() {
      return this.$store.getters["cart/offer"];
    },
    tax() {
      const tax = this.$store.getters["cart/tax"]
      const taxAmount = this.subtotal * tax
      return taxAmount;
    },
    total () {
      let total = this.shippingCost + this.subtotal
      if ( this.offer.id ) {
        total = total - ((total / 100) * this.offer.cost)
      }
      return total
    }
  }
};
</script>

<style lang="scss">
.total-card {
  margin: 50px auto;
  padding: 20px 30px;
  border-radius: 10px;
  background: #fff;
  box-shadow: 0px 5px 20px 5px rgb(250, 245, 245);
}
@media (min-width: 1200px) {
  .total-card {
    width: 70%;
  }
}
</style>
