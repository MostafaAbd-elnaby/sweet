<template>
  <div class="reviews-list">
    <review
      v-for="(review, i) in reviews.data"
      :key="i"
      :rating="review.rating"
      :reviewrName="review.reviewrName"
      :reviewTitle="review.reviewTitle"
      :reviewBody="review.reviewBody"
      :createdAt="review.created_at"
    />
  </div>
</template>

<script>
import Review from "../review/review.vue";
export default {
  props: ["reviews"],
  components: { Review }
};
</script>

<style></style>
