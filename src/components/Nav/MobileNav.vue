<template>
  <div class="flex flex-column full-height justify-between q-pa-md">
    <q-list class="full-width">
      <q-item
        class="q-pa-none"
        clickable
        v-ripple
        v-for="(link, i) in compLinks.links"
        :key="i"
        :to="link.url"
      >
        <q-item-section>{{ link.name }}</q-item-section>
        <q-item-section avatar>
          <q-icon color="primary" name="las la-angle-right" size="xs" />
        </q-item-section>
      </q-item>
          <div v-if="$q.screen.lt.md">
              <ChangeLanges />
          </div>
    </q-list>

    <nav-footer />
  </div>
</template>

<script>
import NavFooter from "components/Nav/nav-footer/navFooter";
import ChangeLanges from "./changeLanges.vue";
export default {
  components: { NavFooter, ChangeLanges },
  data() {
    return {
      // links: [
      //   {
      //     name: this.$t('links.home'),
      //     url: "/"
      //   },
      //   {
      //     name: this.$t('links.shop'),
      //     url: "/shop"
      //   },
      //   {
      //     name: this.$t('links.custom'),
      //     url: "/shop-print"
      //   },
      //   {
      //     name: this.$t('links.about'),
      //     url: "/About"
      //   },
      // ]
    };
  },
  computed:{
    compLinks(){
    return {
      links: [
        {
          name: this.$t('links.home'),
          url: "/"
        },
        {
          name: this.$t('links.shop'),
          url: "/shop"
        },
        {
          name: this.$t('links.custom'),
          url: "/shop-print"
        },
        {
          name: this.$t('links.about'),
          url: "/About"
        },
      ]
    };
    }
  }
};
</script>

<style></style>
