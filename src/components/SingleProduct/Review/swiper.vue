<template>
  <swiper ref="mySwiper" :options="swiperOptions">
    <swiper-slide v-for="(img, i) in images" :key="i" >
      <div class="product-img">
        <img :src="img" class="fit" ref="img" alt=""  />
      </div>
    </swiper-slide>
    <div class="swiper-pagination" slot="pagination"></div>
    <div
      v-if="!$q.screen.lt.md"
      class="swiper-button-prev"
      slot="button-prev"
    ></div>
    <div
      v-if="!$q.screen.lt.md"
      class="swiper-button-next"
      slot="button-next"
    ></div>
  </swiper>
</template>

<script>
export default {
  props: ['images'],
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
    }
  }
}
</script>
