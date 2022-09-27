<template>
  <div class="flex justify-between items-center">
      <div>

      <router-link class="link" to="/">{{$t('links.home')}}</router-link>
      <router-link class="link" to="/shop">{{$t('links.shop')}}</router-link>
      <router-link class="link" to="/shop-print">{{$t('links.custom')}}</router-link>
      <router-link class="link" to="/About">{{$t('links.about')}}</router-link>
      </div>
      <div class="flex left" dir="ltr" >
        <div dir="ltr" class="link cursor-pointer nomargen" @click="lang = 'ar'" >{{$t('links.ar')}}</div>
        <div dir="ltr" class="link cursor-pointer nomargen "  @click="lang = 'en-us'" >{{$t('links.en')}}</div>
      </div>
<!--    <change-langes />-->
  </div>
</template>

<script>
import changeLanges from './changeLanges.vue';
export default {
  // components: { changeLanges },
  data() {
    return {
      lang: this.$q.lang.isoName
    };
  },
  watch: {
    lang (val) {
      import('quasar/lang/' + val).then(lang => {
        this.$q.lang.set(lang.default)
      })
      this.$i18n.locale = val
    }
  },

};
</script>

<style lang="scss" scoped>
.left {
  margin-left: 100px !important;
}
.en {
  margin: 5px 100px 5px 100px !important;
}
.nomargen {
  margin: 5px 10px 5px 10px !important;
}
.link {
  position: relative;
  text-decoration: none;
  color: black;
  margin: 5px 50px 5px 0;
  font-size: 17px;
  &::before {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 1px;
    background-color: #000;
    transition: 0.3s ease-in-out;
  }
  &:hover {
    &::before {
      width: 100%;
    }
  }
}
</style>
