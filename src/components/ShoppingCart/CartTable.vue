<template>
  <div class="cart-table">
    <div class="container">
      <q-markup-table v-if="!$q.screen.lt.sm" flat>
        <thead>
          <tr>
            <th class="text-left">{{$t('ShopCard.product')}}</th>
            <th class="text-center">{{$t('ShopCard.size')}}</th>
            <th class="text-center">{{$t('ShopCard.price')}}</th>
            <th class="text-center">{{$t('ShopCard.quantity')}}</th>
            <th class="text-center">{{$t('ShopCard.total')}}</th>
            <th class="text-center">
              <q-icon
                name="las la-trash"
                size="25px"
                class="q-mb-sm"
              />
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(product, i) in cartItems" :key="i">
            <td class="text-left">
              <div class="flex items-center q-gutter-md">
                <img
                  style="width : 70px; height : auto"
                  :src="$storage + product.color.img"
                  class="cursor-pointer"
                  @click="showProduct(product)"
                  ref="imagePalaceHolder" @error="err => {imagePalaceHolder(err, product)}"
                />
                <div class="product-details q-mt-lg">
                  <div class="text-subtitle1 semi-bold cursor-pointer" @click="showProduct(product)">{{ product.name_en }}</div>
<!--                  <div class="flex items-center q-gutter-sm text-grey">-->
<!--                    <span>{{$t('ShopCard.color')}} :</span>-->
<!--                    <app-color :colors="[product.color]" />-->
<!--                  </div>-->

                </div>
              </div>
            </td>
            <td class="text-center ">
              {{ product.size !== 'select' ? product.size : '-' }}
            </td>
            <td class="text-center ">
              <currency class="text-subtitle1" :value="product.price" />
            </td>
            <td class="text-center text-subtitle2">
              <quantity-box :product="product" />
            </td>
            <td class="text-center ">
              <currency class="text-subtitle1" :value="product.price * product.qu" />
            </td>
            <td class="text-center ">
              <q-btn
                :icon="$t('close')"
                round flat size="sm"
                @click="removeProduct(product)"
              />
            </td>
          </tr>
        </tbody>
      </q-markup-table>
      <div v-else class="mobile-layout">
        <template v-if="cartItems.length" >
          <section-title class="q-mt-none">{{$t('ShopCard.subtitle')}}</section-title>
          <product v-for="(product, i) in cartItems" :key="i" :index="i" :product="product"/>
        </template>
        <div v-else class="empty-cart text-center">
          <h5 class="q-mb-md">{{$t('ShopCard.empty')}}</h5>
          <app-button url="/shop" label="Return to shop" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import QuantityBox from "src/components/UI/QuantityBox.vue";
import Product from "./product.vue";
import SectionTitle from "../UI/SectionTitle.vue";
import Currency from "components/UI/currency";
import {imagePalaceHolder} from "src/mixins/imagePalaceHolder";
import {cart} from "src/mixins/cart";
export default {
  mixins : [imagePalaceHolder, cart],
  components: { QuantityBox, Product, SectionTitle, Currency },
  computed: {
    cartItems() {
      return this.$store.getters["cart/cartItems"];
    }
  },
  methods: {
    removeProduct(product) {
      this.$store.dispatch("cart/removeProduct", product);
    }
  }
};
</script>

<style lang="scss">

.cart-table {
  margin-top: 100px;
  .q-table {
    th {
      font-size: 17px;
      font-weight: bold;
    }
    .color {
      width: 20px;
      height: 20px;
      margin: 0;
    }
    .quantity-box {
      width: max-content;
      margin: auto;
    }
  }
}

@media (max-width: $sm-breakpoint){
  .cart-table {
    margin-top: 20px !important;
  }
}
</style>
