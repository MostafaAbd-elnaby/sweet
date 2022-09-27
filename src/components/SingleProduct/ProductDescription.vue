<template>
  <q-card>
    <q-card-section>
      <div class="row q-col-gutter-lg">
        <div v-html="changeLag(desc, 'desc_ar', 'desc_en')" class="col-12 col-md-8">
        </div>
      </div>
    </q-card-section>
  </q-card>
</template>

<script>
export default {
  props: ['desc']
};
</script>

<style lang="scss">
.product-img {
  img {
    width: 50%;
  }
}

@media (min-width: 767px) {
  .product-img {
    img {
      width: 100%;
    }
  }
}
</style>
