<template>
  <div class="shopping-cart-product q-my-lg">
      <div class="row items-center q-col-gutter-md">
        <div class="col-4">
          <div class="product-img">
            <img ref="imagePalaceHolder" @error="err => {imagePalaceHolder(err, product)}" :src="$storage + product.color.img"  class="fit" alt="" />
          </div>
        </div>
        <div class="col-8">
          <div class="product-details">
            <div class="text-subtitle-1 text-bold">{{ product.name_en }}</div>
            <div class="product-color flex items-center">
<!--              <span class="q-mr-sm">Color: </span>-->
<!--              <app-color :colors="[product.color]"/>-->
              <q-space/>
              <span v-if="product.size !== 'select'" class="q-mr-sm">{{ product.size }}</span>
            </div>
            <div class="price">
                <currency :value="product.price" />
            </div>
            <div class="flex items-center">
              <quantity-box :product="product" />
              <div
                class="remove-item cursor-pointer"
                @click="removeProduct(index)"
              >
                <span>{{ $t("Remove") }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
import Currency from "components/UI/currency.vue";
import QuickView from "components/Product/QuickView";
import {imagePalaceHolder} from "src/mixins/imagePalaceHolder";
export default {
  props: ["product", "index"],
  mixins : [imagePalaceHolder],
  components: { Currency },
  methods: {
    removeProduct(index) {
      this.$store.dispatch("cart/removeProduct", index);
    },

  }
};
</script>

<style lang="scss">
.shopping-cart-product {
  .color {
    width: 15px;
    height: 15px;
    margin: 0;
  }
  .remove-item {
    span {
      text-decoration: underline;
      color: #121212;
    }
  }
}
</style>
