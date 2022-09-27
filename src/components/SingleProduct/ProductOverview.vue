<template>
  <div class="product-overview">
    <div class="container">
      <div class="row q-col-gutter-md">
        <div class="col-12 col-sm-6 relative-position">
          <product-swiper :images="product.imgs" />
          <q-img v-if="colorImage && colorImage !== null" :src="$storage + colorImage" class="color-hover"/>
<!--          <test style="width: 100%; height: 100%;" />-->
        </div>

        <div class="col-12 col-sm-6">
          <template v-if="$q.screen.lt.sm">
            <!-- Product Colors -->
            <div class="product-colors q-my-md">
<!--              <div class="text-subtitle1 text-weight-bold text-uppercase">-->
<!--                colors: <span class="text-body1 text-lowercase">{{ colorName }}</span>-->
<!--              </div>-->
              <div class="colors flex q-gutter-sm">
<!--                <app-color v-if="product && Object.keys(product).length !== 0 " @showName="val => colorName = val" :img="true" :colors="product.colors"></app-color>-->
              </div>
            </div>
            <div v-if="product.sizes.length" class="product-colors q-my-md">
              <div class="text-subtitle1 text-weight-bold text-uppercase">
                size:
              </div>
              <q-select style="width: 50%" dense outlined v-model="size" :options="product.sizes" />
            </div>
          </template>
          <div class="product-desc " :class="!$q.screen.lt.md ? 'q-mt-xl' : ''">
            <!-- Product Name -->
            <div class="flex items-center" >
              <div class="">
                <div class="product-name text-h5 q-mb-sm">
                  {{ changeLag(product) }}
                </div>
                <div class="product-name">
                  {{ changeLag(product, 'small_desc_ar', 'small_desc_en') }}
                </div>
                <!-- Brands -->
                <div class="flex items-center">
                  <q-img
                    v-for="(brand, i) in product.brand"
                    :key="i" :src="brand.img" class="q-mr-sm" style="width: 50px" >
                    <q-tooltip
                      v-if="!$q.screen.lt.md && brand.name"
                      anchor="bottom middle"
                      self="top middle"
                      :offset="[10, 10]"
                      content-style="background-color: #000"
                    >
                      <strong>{{ brand.name }}</strong>
                    </q-tooltip>
                  </q-img>
                </div>
                <!-- Rating -->
                <div class="product-stars q-my-md">
                  <q-rating
                    v-model="rat"
                    size="1.2em"
                    :max="5"
                    color="primary"
                    readonly
                  />
                  <span>({{ rat }})</span>
                </div>
                <!-- Product Price -->
                <div class="product-price text-h5">
                  <currency :value="product.price" :offer="product.copone_offers" />
                </div>
              </div>
              <q-space/>
              <!-- Print Option -->
<!--              <div v-if="product.is_printable" class="printable">-->
<!--                &lt;!&ndash; Print Iocn &ndash;&gt;-->
<!--                <div :class="product.back_print ? 'back' : 'front'" class="icon">-->
<!--                  <q-img v-if="product.back_print" class="back" src="~assets/imgs/t-shirt-back.png" />-->
<!--                  <q-img v-else src="~assets/imgs/t-shirt-front.png" />-->
<!--                </div>-->
<!--                &lt;!&ndash; Print Text &ndash;&gt;-->
<!--                <div>-->
<!--                  you can Build or upload your own design-->
<!--                </div>-->
<!--                <app-button-->
<!--                  :label="$t('Customize')"-->
<!--                  url=""-->
<!--                  class="full-width q-mt-sm"-->
<!--                />-->
<!--              </div>-->

            </div>
            <template v-if="!$q.screen.lt.sm">
              <!-- Product Colors -->
              <div v-if="product.sizes && product.sizes.length" class="product-colors flex items-center q-my-md">
                <div class="text-subtitle1 text-weight-bold text-uppercase">
           {{$t('shop.product.size') }}  :
                </div>
                <q-select style="width: 30%" class="q-ml-md" dense outlined v-model="size" :options="product.sizes" />
              </div>

<!--              <div class="product-colors flex items-center q-my-md">-->
<!--                <div class="text-subtitle1 text-weight-bold text-uppercase">-->
<!--                {{$t('shop.filter.colors')}}:-->
<!--                </div>-->
<!--                <div class="colors q-ml-sm flex q-gutter-sm">-->
<!--                  <app-color v-if="product && Object.keys(product.colors).length !== 0 " @changeColor="changeImg" @show="val => colorImage = val" @hide="colorImage = null"  :img="true" :colors="product.colors"></app-color>-->
<!--                </div>-->
<!--              </div>-->
            </template>
            <!-- Product Quantity -->
            <div class="product-quantity q-my-md">
              <div class="text-subtitle1 text-weight-bold text-uppercase">
               {{$t('shop.product.PrintText.quant')}}:
              </div>
              <div class="flex">
                <quantity-box :product="product" @quantity="(val) => {qu = val}" />
                <div class="add-to-cart">
                  <app-button
                    url=""
                    :label="$t('shop.product.PrintText.add')"
                    :loading="addCartLoading"
                    class="full-width"
                    @click.native="addToCart(product)"
                  />
                </div>
              </div>
            </div>

            <app-button
              :label="$t('shop.product.PrintText.buy')"
              :flat="false"
              url=""
              class="full-width"
              @click.native="bayItNow(product)"
            />

            <q-separator class="q-my-lg" />
            <!-- Delivery -->
            <div class="delivery">
<!--              <q-icon name="las la-truck" size="22px" class="q-mr-sm" />-->
<!--              <span class="text-weight-bold"-->
<!--                >{{ $t("Estimated Delivery") }}:-->
<!--              </span>-->
<!--              <span>{{ shippingData }}</span>-->
            </div>
            <img class="q-my-md fit" src="~assets/imgs/visa.png" alt="" />
<!--            <span class="block text-center">{{ $t("Gurantee safe & secure checkout") }}</span>-->

            <q-separator class="q-mt-lg q-mb-md" />
            <!-- Categories -->
            <div class="flex items-center">
              <span class="q-mr-sm">{{ $t('categories') }} : </span>
              <q-chip
                v-for="(cat, i) in product.cat"
                :key="i" :label="cat.name_en"
                outline clickable size="13px"
              />
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Currency from "components/UI/currency.vue";
import productSwiper from "src/components/SingleProduct/Review/swiper.vue";
import test from "components/SingleProduct/Review/test";
import {cart} from "src/mixins/cart";
import { date } from 'quasar'
export default {
  components: {Currency, productSwiper},
  mixins: [cart],
  props:
    {
      product : {
        require: true,
        default: () => {
          return  null;
        },
        type: Object
      },
    },
  data() {
    return {
      colorImage: null,
      colorName: null,
    };
  },
  computed: {
    rat () {
      return this.product.rat ? this.product.rat : 0
    },
    shippingData () {
      const { addToDate } = date
      let nowDate = new Date(),
          startDate = date.formatDate(nowDate, "MMM D ddd"),
          endDate = addToDate(nowDate, {days: 1})

      endDate = date.formatDate(endDate, "MMM D ddd")
      return startDate + ' - ' + endDate
    },
    ratingModel () {
      return this.product.rating
    }
  },
};
</script>

<style lang="scss" scoped>
.product-overview {
  .color-hover {
    position: absolute;
    top: 16px;
    left: 16px;
    width: 97.5%;
    z-index: 11;
  }
  .product-quantity {
    .add-to-cart {
      flex-grow: 1;
    }
  }
  .printable {
    //width: 100px;
    .icon {
      margin: auto 0;
    }
    .front {
      width: 80px !important;
    }
    .back {
      width: 175px !important;
    }
    .back_price {
      div {
        color: #000 ;
        span {
          font-size: 11px !important;
        }
      }
    }
  }

}

@media (min-width: 767px) {
  .product-overview {
    .color-hover {
      //width: 95.6%;
    }
    .product-img {
      width: 70%;
      margin: 0 auto;
    }
  }
  .printable {
    .icon {
      margin: auto !important;
    }
  }
}
</style>
