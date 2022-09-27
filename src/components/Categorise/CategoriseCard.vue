<template>
  <div @click="goTocat(collection)" class="collection-card cursor-pointer relative-position flex items-end">
    <div class="collection-img">
      <img :src="collection.img" :alt="collection.name_en" />
    </div>
    <div class="flex items-center opisty-box justify-between full-width relative-position">
      <div class="collection-info">
        <h6 class="q-my-none text-bold">{{ collection.name_en }}</h6>
        <span class="text-weight-light">{{ collection.count }} Items</span>
      </div>
      <div @click="goTocat(collection)" style="text-decoration: none">
        <q-btn color="white" text-color="black" icon="las la-arrow-right" round />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['collection'],
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
      if (c.children || c.children !== undefined) {
        if (c.children.length > 0)
          return this.$emit('childCat', c)
        else {
          this.$emit('childCat', c)
        }
      }
      this.goToCatigory(c.slug)
    }
  },
  computed(){
    return this.$store.state.lang
  },

};
</script>

<style lang="scss" scoped>
.collection-card {
  height: 300px;
  padding: 40px;
  //background-color: #fff;
  overflow: hidden;
  transition: 0.5s ease-in-out;
  .opisty-box {
    color: #fff;
    background-color: #fff;
    background-color: #0000008c;
    padding: 3px 15px;
    border-radius: 13px;
  }
  .collection-img {
    position: absolute;
    padding: 15px;
    top: 2%;
    left: 2%;
    width: 85%;
    height: 85%;
    img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: 0.5s ease-in-out;
    }
  }
  &:hover {
    transform: scale(1.05);
    .collection-img {
      img {
        transform: scale(1.1);
      }
    }
  }
}
</style>
