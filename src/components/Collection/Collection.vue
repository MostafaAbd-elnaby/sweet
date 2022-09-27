<template>
  <section class="collection q-mt-xl">
    <div class="container">
      <section-title>{{ title }}</section-title>
      <collection-slider />
    </div>
  </section>
</template>

<script>
import SectionTitle from "../UI/SectionTitle.vue";
import CollectionSlider from "./CollectionSlider.vue";
export default {
  props: ['title'],
  components: { CollectionSlider, SectionTitle }
};
</script>

<style></style>
