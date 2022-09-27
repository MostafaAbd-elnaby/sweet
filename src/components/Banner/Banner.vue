<template>
  <div class="banner">

    <img :src="img_small"  v-if="$q.screen.lt.md" class="fit" alt=""  />
    <img :src="img_large" v-else class="fit" alt=""  />
    <div class="container">
      <div class="hero text-center">
        <div class="text-subtitle banner-subtitle text-bold">
          {{ subtitle }}
        </div>
        <div :class="!$q.screen.lt.md? 'text-white' : ''"
             class="text-h2 banner-title q-my-md q-mb-xl ">{{ title }}</div>
        <AppButton :label="btnLabel" :color="!$q.screen.lt.md? 'white' : ''"  :url="url" :class="{'block': !$q.screen.lt.sm }" />
        <AppButton :url="url_2" :color="!$q.screen.lt.md? 'white' : ''"  :label="btnLabel_2"  class="q-ml-sm" />
      </div>
    </div>

  </div>
</template>

<script>
export default {
  props: ["img_small", "img_large", "subtitle", "title", "btnLabel", "url", "url_2","btnLabel_2"],
  methods: {
    goToEditor () {
      window.open('https://design.yalla2print.com/', '_blank')
    },

  }
};
</script>

<style lang="scss" scoped>
.banner {
  position: relative;
  img {
    width: 100vw;
  }
  .hero {
    margin-top: 20px;
    .banner-title {
      font-size: 35px;
    }
  }
}
@media (min-width: 767px) {
  .banner {

    height: 70vh;
    .hero {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      text-align: left;
      @media (min-width: $md-breakpoint){
        padding: 20px;
        background: #000000a8;
        border-radius: 25px;
      }
      @media (min-width: $lg-breakpoint){
        padding: 20px;
        background: #000000a8;
        border-radius: 25px;
      }
      .banner-subtitle {
        font-size: 20px;
        font-weight: 500;
        margin-bottom: 20px;
      }
      .banner-title {
        font-size: 75px;
        font-weight: 500;
      }
      .app-button {
        display: inline-block !important;
      }
    }
  }
}
</style>
