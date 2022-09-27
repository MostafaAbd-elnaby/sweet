<template>
  <div class="product-overview relative-position">
    <q-btn
      color="white"
      icon="close"
      size="md"

      v-close-popup
      class="fixed-bottom bg-white full-width text-black "
      style="z-index : 11"
    />
    <div class="row q-col-gutter-md">
      <div class="col-12 col-sm-6 q-pa-none">
        <swiper ref="mySwiper" :options="swiperOptions">
          <swiper-slide v-for="(img, i) in product.imgs" :key="i">
            <div class="no-image">
              <img ref="img" @error="imagePalaceHolder" :src="img" class="fit" alt="" />
            </div>
          </swiper-slide>
          <div
            v-if="$q.screen.lt.am"
            class="swiper-pagination"
            slot="pagination"
          ></div>
          <div
            v-if="!$q.screen.lt.am"
            class="swiper-button-prev"
            slot="button-prev"
          ></div>
          <div
            v-if="!$q.screen.lt.am"
            class="swiper-button-next"
            slot="button-next"
          ></div>
        </swiper>
      </div>

      <div class="col-12 col-sm-6">
        <div class="container">
          <div
            class="product-desc "
            :class="!$q.screen.lt.sm ? 'q-mt-xl' : ''"
          ></div>
          <div class="product-name text-h5 q-mb-sm">
            {{ product.name_en }}
          </div>
          <div class="product-stars q-my-md">
            <q-rating
              v-model="rating"
              size="1.2em"
              :max="5"
              color="primary"
              readonly
            />
            <span>({{ product.rat }})</span>
          </div>
          <div class="product-price text-h5">
            <currency :value="product.price" :offer="product.copone_offers" />
          </div>
          <div v-if="product.is_printable" class="printable">

            <!-- Print Text -->
            <div>
              {{$t('shop.product.PrintText.title')}}
            </div>
            <div class="text-center text-red back_price">
              <q-icon size="sm" name="las la-exclamation" />
              {{$t('shop.product.PrintText.price')}}
              <currency :value="product.back_price" class="inline-block" />
            </div>
            <app-button
              :label="$t('Customize')"
              url=""
              class="full-width q-mt-sm"
            />
          </div>
          <div class="row">
            <div class="product-colors q-my-md ">
<!--              <div class="text-subtitle1 text-weight-bold text-uppercase">-->
<!--              {{$t('shop.product.PrintText.colors')}}-->
<!--              </div>-->
<!--              <div class="colors flex q-gutter-sm">-->
<!--                <app-color-->
<!--                  :product="product"-->
<!--                  :colors="product.colors"-->
<!--                  @changeColor="changeImg"></app-color>-->
<!--              </div>-->
            </div>
            <q-space/>
            <div v-if="product.sizes.length" class="q-mt-md">
              <div class="text-subtitle1 text-weight-bold text-uppercase">
              {{$t('shop.product.PrintText.size')}}
              </div>
              <q-select  dense outlined v-model="size" :options="product.sizes" />
            </div>
          </div>

          <div class="product-quantity q-my-md">
            <div class="text-subtitle1 text-weight-bold text-uppercase">
              {{$t('shop.product.PrintText.quant')}}
            </div>
            <div class="flex">
              <quantity-box :product="product" @quantity="(val) => {qu = val}" />
              <div class="add-to-cart">
                <app-button
                  :label="$t('shop.product.PrintText.add')"
                  :loading="addCartLoading"
                  url=""
                  class="full-width"
                  @click.native="addToCart(product)"
                />
              </div>
            </div>
          </div>

          <app-button
            :label="$t('shopPrint.custom')"
            url=""
            v-if="product.is_printable"
            class="full-width q-mb-md"
          />
          <app-button
            :label="$t('shop.product.PrintText.buy')"
            :flat="false"
            url=""
            class="full-width q-mb-md"
            v-close-popup
            @click.native="bayItNow(product)"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { cart } from 'src/mixins/cart'
import Currency from "components/UI/currency.vue";
import {imagePalaceHolder} from "src/mixins/imagePalaceHolder";
export default {
  props: ["product"],
  components: {Currency},
  mixins: [cart, imagePalaceHolder],
  data() {
    return {
      swiperOptions: {
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev"
        }
      },
      rating: this.product.rat,
    };
  },
  methods: {

  }
};
</script>

<style lang="scss" scoped>
.product-overview {
  .product-quantity {
    .add-to-cart {
      flex-grow: 1;
    }
  }
}
</style>
