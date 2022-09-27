<template>
  <div class="related-product">
    <div class="container">
      <section-title>{{$t('likeMess')}}</section-title>
      <swiper ref="mySwiper" :options="swiperOptions">
        <swiper-slide v-for="(product, i) in products" :key="i">
          <product-card :product="product" />
        </swiper-slide>
      </swiper>
    </div>
  </div>
</template>

<script>
import SectionTitle from "src/components/UI/SectionTitle.vue";
import ProductCard from "src/components/Product/ProductCard.vue";
export default {
  components: { SectionTitle, ProductCard },
  data() {
    return {
      swiperOptions: {
        slidesPerView: 1.5,
        slidesPerGroup: 1,
        spaceBetween: 10,
        freeMode: true,
        breakpoints: {
          900: {
            slidesPerView: 3.7
          },
          700: {
            slidesPerView: 3
          },
          500: {
            slidesPerView: 2.3
          }
        },
        loop: true
      }
    };
  },
  computed: {
    products() {
      return this.$store.getters["Products/relatedProducts"];
    }
  }
};
</script>

<style></style>
