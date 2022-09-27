<template>
  <div>
    <template v-if="collections.length">
      <swiper ref="mySwiper" :options="swiperOptions">
        <swiper-slide v-for="(collection, index) in collections" :key="index">
          <collection-card :collection="collection" />
        </swiper-slide>

        <div class="swiper-pagination" slot="pagination"></div>
      </swiper>
    </template>
    <template v-else>
      <div class="row">
        <div class="col-12 col-md-3 q-px-md" v-for="i in 4" :key="i">
          <q-skeleton class="bg-grey-2" height="380px" square />
        </div>
      </div>
    </template>
  </div>
</template>

<script>
import CollectionCard from "./CollectionCard.vue";
export default {
  components: {
    CollectionCard
  },
  data() {
    return {
      swiperOptions: {
        slidesPerView: 1.3,
        slidesPerGroup: 1,
        spaceBetween: 30,
        centeredSlides: false,
        freeMode: true,
        loop: true,
        breakpoints: {
          1300: {
            slidesPerView: 4
          },
          1000: {
            slidesPerView: 3.3
          },
          900: {
            slidesPerView: 2.5
          },
          700: {
            slidesPerView: 2.3
          }
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true
        }
      }
    };
  },
  computed: {
    collections () {
      return this.$store.getters['home/collections'];
    },
  },
  mounted(){

  }
};
</script>

<style></style>
