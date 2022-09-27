import Vue from 'vue'
import {
  Swiper,
  SwiperSlide
} from "vue-awesome-swiper";
import SwiperCore, {
  EffectFade,
  Pagination,
  Navigation,
  Autoplay
} from "swiper/core";
import "swiper/swiper-bundle.css";
import AppButton from 'components/UI/AppButton.vue'
import AppColor from 'components/UI/AppColor.vue'
import QuantityBox from 'components/UI/QuantityBox.vue'
import lang from "src/mixins/lang.js"

SwiperCore.use([EffectFade, Pagination, Autoplay, Navigation]);

Vue.component('Swiper', Swiper)
Vue.component('SwiperSlide', SwiperSlide)
Vue.component('AppButton', AppButton)
Vue.component('AppColor', AppColor)
Vue.component('QuantityBox', QuantityBox)
// Vue.mixin(lang)

Vue.mixin({
  data() {
    return {obj: {}}
  },
  methods: {

    changeLag(obj, ar = 'name_ar', en = 'name_en') {
      this.obj = obj
      return this.$q.lang.isoName == "ar" ?  this.langFallback(ar) : this.langFallback(en)
    },
    langFallback(lang) {
      return this.obj[lang] !== '' ? this.obj[lang] : this.$t('noName')
    },

    checkLang(){
      if(this.$q.lang.isoName == "ar")
      return "name_ar";
        return "name_en";


    }
  },
})

