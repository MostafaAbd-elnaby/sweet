<template>
  <section class="collection q-mt-xl">
    <div class="container">
      <!-- <section-title>{{ title }}</section-title> -->
      <categorise-slider :collections="collections" @childCat="viewChildCat" />
    </div>
  </section>
</template>

<script>
import SectionTitle from "../UI/SectionTitle.vue";
import CategoriseSlider from "./CategoriseSlider.vue";
export default {
  props: ['title', 'catChild'],
  components: { CategoriseSlider },

  computed: {
    collections () {
      if (!this.catChild)
        return this.$store.getters['home/cats'];
      return this.catChild.children
    },
  },

  methods: {
    viewChildCat(cat) {
      this.$emit('childCat', cat)
    }
  },

};
</script>

<style></style>
