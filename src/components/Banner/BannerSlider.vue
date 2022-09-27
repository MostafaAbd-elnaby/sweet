<template>
  <div>
    <template v-if="sliders && Object.keys(sliders).length !== 0">
      <swiper class="banner-slider" ref="mySwiper" :options="swiperOptions">
        <swiper-slide v-for="slide in sliders.sliders" :key="slide.id">

          <banner
            :img_small="slide.img_small"
            :img_large="slide.img_large"
            :subtitle="slide.title"
            :title="slide.body"
            :btnLabel="slide.btnLabel1"
            :url="slide.btnUrl1"
            :btnLabel_2="slide.btnLabel2"
            :url_2="slide.btnUrl2"
          />

        </swiper-slide>
        <div class="swiper-pagination" slot="pagination"></div>
      </swiper>
    </template>
    <template v-else>
      <q-skeleton class="bg-grey-2" height="663px" square />
    </template>
  </div>
</template>

<script>
import Banner from "./Banner.vue";

export default {
  components: {
    Banner
  },
  data() {
    return {
      swiperOptions: {
        loop: false,
        effect: "fade",
        fadeEffect: { crossFade: true },
        autoplay: { delay: 7000 },
        pagination: {
          el: ".swiper-pagination",
          clickable: true
        }
      },
    };
  },
  computed : {
    sliders () {
      return this.$store.getters['home/settings'];
    },
    sliders_old () {
      return [
        {
          id: 1,
          img: this.$q.screen.lt.md
            ? "imgs/banner_1.jpg"
            : "imgs/banner_11.jpg",
          subtitle: "New Arrivals",
          title: "Double Breasted",
          btnLabel: "Shop Now",
          url: "/shop",
          btnLabel_2: "custom design",
          url_2: "/shop-print"
        },
        {
          id: 2,
          img: this.$q.screen.lt.md
            ? "imgs/banner_2.jpg"
            : "imgs/banner_22.jpg",
          subtitle: "Best Sellers",
          title: "Autumn Collection",
          btnLabel: "Discover Now",
          url: "/shop",
          btnLabel_2: "custom design",
          url_2: "/shop-print"
        },
        {
          id: 3,
          img: this.$q.screen.lt.md
            ? "imgs/banner_3.jpg"
            : "imgs/banner_33.jpg",
          subtitle: "Hot Trend",
          title: "Venice Haute Couture",
          btnLabel: "Shop Now",
          url: "/shop",
          btnLabel_2: "custom design",
          url_2: "/shop-print"
        }
      ]
    }
  },
  mounted(){


  }
};
</script>

<style lang="scss">
.swiper-pagination {
  position: relative;
  margin-top: 40px;
  .swiper-pagination-bullet {
    position: relative;
    width: 10px;
    height: 10px;
    margin: 7px !important;
  }
  .swiper-pagination-bullet-active {
    background-color: transparent;
    border: 1px solid;
    transform: scale(1.5);
  }
}
@media (min-width: 767px) {
  .banner-slider {
    .swiper-pagination {
      position: absolute;
      top: 50%;
      bottom: unset;
      left: 35%;
      transform: translateY(-50%) rotate(90deg);
    }
  }
}
</style>
