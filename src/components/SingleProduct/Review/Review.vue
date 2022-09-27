<template>
  <div class="review q-mt-md">
    <div class="review-rating">
      <q-rating
        :value="ratingModel"
        readonly
        color="primary"
        size="1.2em"
        icon="star"
      />
    </div>
    <span class="reviewr-name text-h6 semi-bold q-mr-sm">{{
      reviewrName
    }}</span>
    <span>On {{ createdAt | date }}</span>

    <h6 class="review-title semi-bold q-my-md">
      {{ reviewTitle }}
    </h6>

    <p class="review-body">
      {{ reviewBody }}
    </p>
    <q-separator class="q-my-lg" color="grey" />
  </div>
</template>

<script>
import {date} from "quasar";

export default {
  props: ["rating", "reviewrName", "reviewTitle", "reviewBody", "createdAt"],
  data() {
    return {
      ratingModel: this.rating
    };
  },
  computed : {
    ratingWatch () {
      return this.rating
    }
  },
  filters: {
    date (val) {
      console.log(val)
      return date.formatDate(val, 'MMM DD, YYYY')
    }
  },
};
</script>

<style></style>
