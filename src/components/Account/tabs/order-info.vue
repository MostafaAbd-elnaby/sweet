<template>
  <div class="q-mt-md">

    <section-title class=" q-mt-none q-mb-md">{{ $t('shipingInfo.contact') }}</section-title>

    <div class="contact-box">
      <q-list bordered separator>
        <q-item>
          <q-item-section avatar>
            <span class="text-grey">{{$t('Payment.name')}}</span>
          </q-item-section>

          <q-item-section>{{ order.name }}</q-item-section>
        </q-item>
        <q-item>
          <q-item-section avatar>
            <span class="text-grey">{{$t('Payment.contact')}}</span>
          </q-item-section>

          <q-item-section>+2{{ order.phone }}  {{ order.email }} </q-item-section>
        </q-item>
        <q-item>
          <q-item-section avatar>
            <span class="text-grey">{{$t('Payment.ShipTo')}}</span>
          </q-item-section>

          <q-item-section
          >{{ order.address }}, {{ order.city }}, {{ order.governorate }}, {{ order.country }}, {{ order.post_code }}</q-item-section
          >
        </q-item>
      </q-list>
    </div>

    <section-title class=" q-mt-none q-my-md">{{$t('Payment.products')}}</section-title>
    <div class="row" >
      <div v-for="(product, i) in order.products" :key="i" class=" col-12 col-md-6 row items-center q-mb-md q-col-gutter-md">
        <div class="col-3">
          <div class="product-img">
            <img ref="imagePalaceHolder" @error="imagePalaceHolder" :src="product.img"  class="fit" alt="" />
          </div>
        </div>
        <div class="col-8">
          <div class="product-details">
            <div class="text-subtitle-1 text-bold">{{ product.name_en }}</div>

<!--            <div class="product-color flex items-center">-->
<!--              <span class="q-mr-sm">{{$t('ShopCard.color')}}: </span>-->
<!--              <app-color :colors="[product.color]"/>-->
<!--            </div>-->
<!--            <div class="product-color flex items-center">-->
<!--              <span class="q-mr-sm">{{$t('shop.size')}}: </span>-->
<!--              <span class="q-mr-sm">{{ product.size }}</span>-->
<!--            </div>-->
          </div>
          <div class="price flex">
            <span class="q-ml-sm">
               {{ product.qu }} x
                <currency :value="product.price" />
            </span>
          </div>
        </div>
      </div>
    </div>

    <section-title class=" q-mt-none q-mb-md">{{$t('Payment.info')}}</section-title>


    <div class="contact-box">
      <q-list bordered separator>
        <q-item>
          <q-item-section avatar>
            <span class="text-grey">{{$t('ShopCard.subtotal')}}</span>
          </q-item-section>

          <q-item-section><currency :value="order.sup_total" /></q-item-section>
        </q-item>
        <q-item>
          <q-item-section avatar>
            <span class="text-grey">{{$t('ShopCard.shippingT')}}</span>
          </q-item-section>

          <q-item-section><currency :value="order.shipping_cost"/> </q-item-section>
        </q-item>
        <q-item>
          <q-item-section avatar>
            <span class="text-grey">{{$t('ShopCard.total')}}</span>
          </q-item-section>

          <q-item-section><currency :value="order.total"/> </q-item-section>
        </q-item>
      </q-list>
    </div>

  </div>
</template>

<script>
import SectionTitle from "components/UI/SectionTitle";
import {imagePalaceHolder} from "src/mixins/imagePalaceHolder";
import Currency from "components/UI/currency";
export default {
  components: {Currency, SectionTitle},
  props: ['order'],
  mixins: [imagePalaceHolder],

};
</script>

<style></style>
