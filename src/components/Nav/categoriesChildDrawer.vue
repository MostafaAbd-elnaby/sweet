<template>
  <div>
    <div class="q-mt-md flex flex-center">
      <router-link class="logo" to="/">
        <q-img class="logo" src="~assets/imgs/logo2.png"/>
      </router-link>
      <q-btn icon="close" flat round @click="$emit('close')" />
    </div>

      <router-link :to="goToCatigory(c.slug)" @click="$emit('childCat', c)" class="cat-child"
                   v-for="(c, i) in parent.children" :key="i" >
         <span>
           {{ c.name_en }}
         </span>
      </router-link>

    <nav-footer class="q-pa-md" />

  </div>
</template>

<script>
import NavFooter from "components/Nav/nav-footer/navFooter";
export default {
  components: {NavFooter},
  props: ['parent'],
  methods: {
    goToCatigory ( slug ) {
      let query = ''
      for (const q in this.$route.query) {
        if(q !== 'category')
          query += q + '=' + this.$route.query[q] + '&'
      }
      query += 'category=' + slug
      return '/shop?' + query
    }
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

.parent-name {
  display: inline-block;
  text-align: center;
  width: calc(100% - 84px);
  font-size: 25px;
  font-weight: 700;
}

.cat-child {
  display: block;
  color: $primary;
  width: 100%;
  position: relative;
  text-align: left;
  padding-left: 17px !important;
  font-size: 20px;
  padding: 10px 0;
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
