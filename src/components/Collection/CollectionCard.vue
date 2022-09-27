<template>
  <div class="collection-card relative-position flex items-end">
    <div class="collection-img">
      <img :src="collection.image" :alt="collection.name_en" />
    </div>
    <div class="flex items-center justify-between full-width relative-position">
      <div class="collection-info">
        <h6 class="q-my-none text-bold">{{ changeLag(collection) }}</h6>
        <span class="text-weight-light">{{ collection.count }} {{ $t('collection.items') }}</span>
      </div>
      <router-link :to="`/shop?collection=${collection.slug}`" style="text-decoration: none">
        <q-btn color="primary" icon="las la-arrow-right" round />
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  props: ['collection'],
};
</script>

<style lang="scss" scoped>
.collection-card {
  height: 300px;
  padding: 40px;
  //background-color: #fff;
  overflow: hidden;
  transition: 0.5s ease-in-out;
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
