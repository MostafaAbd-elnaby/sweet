<template>
<!-- translate not compleit -->
  <q-page>
    <h3 class="text-center q-mb-sm">  {{$t('about.title')}}   </h3>
    <breadcrumbs :current="$t('about.title')" />
    <template v-if="settings.about">
      <swiper class="banner-slider" ref="mySwiper" :options="swiperOptions">
        <swiper-slide >
          <banner
            :img_small="settings.img_small"
            :img_large="settings.img_large"
            :title="about.text"
            :btnLabel="about.btnLabel1"
            :url="about.btnUrl1"
            :btnLabel_2="about.btnLabel2"
            :url_2="about.btnUrl2"
          />
        </swiper-slide>
        <div class="swiper-pagination" slot="pagination"></div>
      </swiper>
    </template>
    <template v-else>
      <q-skeleton class="bg-grey-2" height="663px" square />
    </template>
    <div class="q-mt-xl q-pa-lg" v-html="about.desc">
    </div>
    <services class="q-mt-xl" />
  </q-page>
</template>

<script>
import Breadcrumbs from "components/UI/Breadcrumbs";
import Banner from "components/Banner/Banner";
import Services from "components/Services/Services";
export default {
  components: {Services, Banner, Breadcrumbs },
  name: "About",
  data() {
    return {
      swiperOptions: {
        loop: true,
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
  computed: {
    about() {
      return this.settings.about
    },
    settings() {
      if (this.$store.getters['home/settings'])
        return this.$store.getters['home/settings']
      else
        return {about: false}
    }
  }
};
</script>

<style lang="scss" scoped >

</style>
