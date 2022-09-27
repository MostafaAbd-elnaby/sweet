<template>
  <div v-if="settings.id" class="services q-mb-none">
    <div class="container">
      <section-title>{{$t('about.services.title')}}</section-title>
      <div class="row q-col-gutter-md">
                        <!--------- service - 1 - -------->
          <!-- v-for="(service, i) in services"
          :key="i" > -->
        <div
          class="col-12 col-sm-6 col-md-3">
          <div class="service flex q-gutter-md items-center">
            <q-icon name="las la-dollar-sign" size="md" />
            <div class="service-content">
              <div class="text-h6 ">
                {{ $t('services.title_1') }}
              </div>
              <div class="">{{ $t('services.desc_1')}}</div>
            </div>
          </div>
        </div>
                        <!--------- service - 2 - -------->
    <div
          class="col-12 col-sm-6 col-md-3" >
          <div class="service flex q-gutter-md items-center">
            <q-icon name="las la-headset" size="md" />
            <div class="service-content">
              <div class="text-h6 ">
                {{ $t('services.title_2') }}
              </div>
              <div class="">{{ $t('services.desc_2')}}</div>
            </div>
          </div>
        </div>
                        <!--------- service - 3 - -------->
        <div
          class="col-12 col-sm-6 col-md-3">
          <div class="service flex q-gutter-md items-center">
            <q-icon name="las la-credit-card" size="md" />
            <div class="service-content">
              <div class="text-h6 ">
                {{ $t('services.title_3') }}
              </div>
              <div class="">{{ $t('services.desc_3')}}</div>
            </div>
          </div>
        </div>
                        <!---------End service  - -------->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="service flex flex-center q-gutter-md items-center">
            <div class="service-content">

              <div class="inline-block">
                <a style="text-decoration: none" :href="settings.info.faceBook" target="_blank">
                  <q-btn  icon="lab la-facebook-f" flat color="white" />
                </a>
              </div>
              <div class="inline-block">
                <a style="text-decoration: none" :href="settings.info.twitter" target="_blank">
                  <q-btn icon="lab la-instagram" flat color="white" />
                </a>
              </div>
              <div class="inline-block">
                <a style="text-decoration: none" :href="'mailto:' + settings.info.mail">
                  <q-btn icon="las la-at" flat color="white" />
                  <span class="text-white"> {{ settings.info.mail }} </span>
                </a>
              </div>
              <div class="block">
                <a style="text-decoration: none"  :href="'https://wa.me/02' + settings.info.phone" target="_blank">
                  <q-btn icon="lab la-whatsapp" flat color="white" />
                  <span class="text-white"> {{ settings.info.phone }} </span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center" style="color: #97a5b7">
        Copyright @ 2022
        <a href="https://nethuby.com" class="text-center" target="_blank" style="color: #97a5b7;text-decoration: none;">Powered by
        </a>
        <a href="https://nethuby.com" class="text-center block" target="_blank" style="text-decoration: none;">
          <q-img src="nethuby.png" width="150px" class="" />
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import SectionTitle from "../UI/SectionTitle.vue";
export default {
  components: { SectionTitle },
  data() {
    return {
      // services: [

      //   {
      //     icon: "las la-dollar-sign",
      //     title: this.$t('services.title_1'),
      //     desc: this.$t('services.desc_1'),
      //   },
      //   {
      //     icon: "las la-headset",
      //     title: this.$t('services.title_2'),
      //    desc: this.$t('services.desc_2'),
      //   },
      //   {
      //     icon: "las la-credit-card",
      //     title: this.$t('services.title_3'),
      //    desc: this.$t('services.desc_3'),
      //   }
      // ]
    };
  },
  computed: {
    settings() {
      return this.$store.getters['home/settings']
    }
  }
};
</script>

<style lang="scss">
.services {
  background: rgb(35, 47, 62);
  color: #fff;
  padding: 20px 0 10px 0;
}
</style>
