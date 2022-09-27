<template>
  <div>
    <div class="q-mt-md flex flex-center">
      <router-link class="logo" to="/">
        <q-img class="logo" :src="$store.getters['home/settings'].logo" />
      </router-link>
      <q-btn icon="close" flat round @click="$emit('close')" />
    </div>
    <div>
      <div v-for="(c, i) in cats" :key="i" class="cat-parent" @click="goTocat(c)">
        <span>{{ c.name_en }}</span>

      </div>
    </div>




    <nav-footer class="q-pa-md" />
  </div>
</template>

<script>

import NavFooter from "components/Nav/nav-footer/navFooter";
export default {
  components: {  NavFooter },
  data() {

    return {
      links: [
        {
          name:this.$t('links.home'),
          url: "/"
        },
        {
          name: this.$t('links.about'),
          url: "/"
        },
        {
          name: this.$t('links.shop'),
          url: "/shop"
        },
        {
          name: this.$t('links.profile'),
          url: "/Account/profile"
        }
      ]
    };
  },
  computed: {
    cats () {
      return this.$store.getters['home/cats'];
    }
  },
  methods: {
    goToCatigory ( slug ) {
      let query = ''
      for (const q in this.$route.query) {
        if(q !== 'category')
          query += q + '=' + this.$route.query[q] + '&'
      }
      query += 'category=' + slug
      return this.$router.push('/shop?' + query)
    },
    goTocat (c) {
      console.log(c)
      if (c.children.length) {
        this.$emit('childCat', c)
      } else {
        this.goToCatigory(c.slug)
      }
    }
  },
  mounted(){
  console.log(this.checkLang());  ;
  }
};
</script>

<style lang="scss" scoped>
.logo {
  display: inline-block;
  text-align: center;
  font-size: 20px;
  margin-bottom: 3%;
  width: 70%
}

.cat-parent {
  width: 100%;
  position: relative;
  font-size: 27px;
  padding: 7px 0;
  padding-left: 17px !important;
  font-weight: 700;
  cursor: pointer;

  span {
    display: inline-block;
    position: relative;
  }

  span::before {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background-color: #000;
    transition: 0.3s ease-in-out;
  }

  &:hover {
    span::before {
      width: 100%;
    }
  }
}

</style>
