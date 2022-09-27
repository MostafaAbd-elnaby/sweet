<template>
  <div class="container">
    <div class="shopping-cart q-py-md">
      <header class="flex justify-between items-center q-pb-md">
        <div class="text-h6 text-bold">
          {{$t('card.title')}}
        </div>
        <q-icon
          name="close"
          size="20px"
          class="text-bold cursor-pointer"
          @click="$emit('close')"
        />
      </header>

      <main>
        <div v-if="cartItems.length" class="cart-items">
          <product
            v-for="(product, i) in cartItems"
            :key="i"
            :index="i"
            :product="product"
          />
        </div>
        <div v-else class="empty-cart text-center">
          <h5 class="q-mb-md">{{$t('card.empty')}}</h5>
          <app-button url="/shop" :label="$t('ShopCard.return_back')" />
        </div>
      </main>

      <div v-if="cartItems.length" style="margin-top: -30px" class="q-py-sm">
        <subtotal-box />
        <router-link
          class="block text-center q-mt-sm text-subtitle1 text-grey"
          to="/cart"
          >{{$t('card.view')}}</router-link
        >
      </div>
    </div>
  </div>
</template>

<script>
import SubtotalBox from "../UI/SubtotalBox.vue";
import Product from "./product.vue";
export default {
  components: { SubtotalBox, Product },
  computed: {
    cartItems() {
      return this.$store.getters["cart/cartItems"];
    }
  }
};
</script>

<style lang="scss" scoped>
.shopping-cart {
  height: 100vh;
  overflow-y: hidden;
  main {
    height: 78%;
    overflow: scroll;
    overflow-x: hidden;
  }
  footer {
    .subtotal {
      span {
        font-size: 18px;
      }
    }
  }
}
@media (min-width: 767px) {
  .shopping-cart {
    main {
      height: 80%;
    }
  }
}
main::-webkit-scrollbar {
  width: 7px;
}
main::-webkit-scrollbar-track {
  background-color: transparent;
}
main::-webkit-scrollbar-thumb {
  background-color: #ccc;
  border-radius: 10px;
}
main::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>
