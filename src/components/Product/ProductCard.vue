<template>
  <div class="product-card bg-white q-pa-sm">
    <div class="product-imgs q-mb-sm relative-position">
      <q-chip
        v-if="product.copone_offers.id"
        class="absolute-top-left q-ma-none offer"
        square
        color="red">{{$t('shop.product.sale')}} {{ product.copone_offers.cost }}%</q-chip>
      <img
        class="fit cursor-pointer"
        v-for="(img, i) in 2"
        :key="i"
        :src="product.imgs[i]"
        :class="{ 'img-2': i === 1 }"
        ref="img"
        :alt="img"
        @error="err => {imagePalaceHolder(err, product)}"
        @click="showProduct(product)"
      />
      <!-- inner Hover -->
      <div class="inner-hover bg-white">
          <q-btn
            size="13px"
            :dense="$q.screen.lt.md"
            :loading="addCartLoading"
            flat
            icon="las la-shopping-bag"
            @click.native="quickView = true"
            class="cursor-pointer"
          >
            <q-tooltip
              v-if="!$q.screen.lt.md"
              anchor="top middle"
              self="bottom middle"
              :offset="[10, 10]"
              content-style="background-color: #000"
            >
              <strong>{{$t('shop.product.select')}}</strong>
            </q-tooltip>
          </q-btn>
          <q-btn
            size="13px"
            :dense="$q.screen.lt.md"
            flat
            :icon=" product.is_printable ? 'las la-palette' : 'las la-eye'"
            @click.native="quickView = true"
            class="cursor-pointer"
          >
            <q-tooltip
              v-if="!$q.screen.lt.md"
              anchor="top middle"
              self="bottom middle"
              :offset="[10, 10]"
              content-style="background-color: #000"
            >
              <strong>{{ product.is_printable ? `${$t('product.PrintText.quic_cust')}` : `${$t('product.PrintText.quic')}` }}</strong>
            </q-tooltip>
          </q-btn>
<!--          <q-btn-->
<!--            size="13px"-->
<!--            :dense="$q.screen.lt.md"-->
<!--            flat-->
<!--            icon="eva-heart-outline"-->
<!--            class="cursor-pointer"-->
<!--            :loading="addWishlistLoading"-->
<!--            @click="addToWishlist(product)"-->
<!--          >-->
<!--            <q-tooltip-->
<!--              v-if="!$q.screen.lt.md"-->
<!--              anchor="top middle"-->
<!--              self="bottom middle"-->
<!--              :offset="[10, 10]"-->
<!--              content-style="background-color: #000"-->
<!--            >-->
<!--              <strong>Add To Wishlist</strong>-->
<!--            </q-tooltip>-->
<!--          </q-btn>-->
      </div>
    </div>
    <!-- product-details -->
    <div class="product-details">
      <div class="product-name text-subtitle1 cursor-pointer ellipsis" @click="showProduct(product)">{{ product.name_en }}</div>
      <div class="product-price q-my-sm ">
        <currency :value="product.price" :offer="product.copone_offers" />
      </div>
      <div class="product-colors q-mb-md flex q-gutter-sm">
<!--        <app-color-->
<!--          :colors="product.colors"-->
<!--          :product="product"-->
<!--          @changeColor="changeImg"-->
<!--        ></app-color>-->
      </div>
    </div>
    <!-- printble badge -->
<!--    <div v-if="product.is_printable" class="printable">-->
<!--      <span class="text-subtitle2">printable</span>-->
<!--    </div>-->
    <!-- quick view product -->
    <q-dialog v-model="quickView" transition-show="fade" transition-hide="fade">
      <q-card style="width: 900px; max-width: 90vw;">
        <quick-view :product="product" />
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
import QuickView from "./QuickView.vue";
import Currency from "components/UI/currency.vue";
import { cart } from "src/mixins/cart";
import {imagePalaceHolder} from "src/mixins/imagePalaceHolder";
export default {
  props: ["product"],
  mixins: [cart, imagePalaceHolder],
  components: { QuickView, Currency },
  data() {
    return {
      quickView: false,
    };
  },
};
</script>

<style lang="scss" scoped>
.product-card {
  position: relative;
  transition: 0.5s ease-in-out;
  &:hover {
    box-shadow: 0px 0px 12px 2px #cccccc69;
  }
  .offer {
    background: #ff4f4f !important;
    color: #fff;
    top: 13px;
    text-align: center;
    width: 104px;
    padding-left: 23px;
    transform: rotate(
        315deg);
    left: -26px;
    z-index: 1111;
  }
  .product-imgs {
    overflow: hidden;
    .img-2 {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      visibility: hidden;
      transition: 0.5s linear;
    }
    .inner-hover {
      position: absolute;
      bottom: 0;
      width: 100%;
      display: flex;
      justify-content: space-between;
      button {
        padding: 3px 10px;
      }
    }
  }
  .product-price {
    font-size: 18px;
    color: $grey;
  }
  .printable {
    position: absolute;
    top: 20px;
    left: 30px;
    padding: 1px 15px;
    border-radius: 15px;
    background-color: #9a84c8;
    color: #fff;
  }
}

@media (min-width: 767px) {
  .product-card {
    &:hover {
      .product-imgs {
        .inner-hover {
          bottom: 40px;
          opacity: 1;
          visibility: visible;
        }
      }
    }
    .offer {
      background: #ff4f4f !important;
      color: #fff;
      top: 13px;
      text-align: center;
      width: 104px;
      padding-left: 23px;
      transform: rotate(
          315deg);
      left: -26px;
      z-index: 1111;
    }
    .product-imgs {
      .inner-hover {
        width: max-content;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 5px;
        overflow: hidden;
        opacity: 0;
        visibility: hidden;
        transition: 0.2s ease-in-out;
        button {
          border: none;
          border-right: 1px solid #ccc;
          padding: 3px 5px;
          transition: 0.5s ease-in-out;
          &:hover {
            background: #000;
            color: #fff;
          }
        }
      }
      &:hover {
        .img-2 {
          opacity: 1;
          visibility: visible;
          transform: scale(1.1);
        }
      }
    }
    .product-name {
      font-size: 20px;
      text-decoration: underline;

    }
  }
}
</style>
