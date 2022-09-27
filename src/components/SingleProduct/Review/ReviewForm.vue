<template>
  <q-card style="width : 400px">
    <q-card-section class="row items-center q-pb-none">
      <div class="text-h6 text-weight-bold">
        {{ $t("review.write") }}
      </div>
      <q-space />
      <q-btn icon="close" flat round dense v-close-popup />
    </q-card-section>

    <q-card-section>
      <q-form @submit.prevent="onSubmit">

        <div class="review-rating q-mb-md">
          <label>{{$t('review.rating')}}</label>
          <q-rating
            v-model="review.rating"
            size="1.5em"
            icon="star"
            color="primary"
            class="block"
          />
        </div>

        <div class="review-title">
          <label>{{$t('review.reviewT')}}</label>
          <q-input
            v-model="review.reviewTitle"
            :rules="[val => (val && val.length > 0) || `${$t('Payment.paymentCard.noInput')}`]"
            outlined
            :placeholder="$t('review.placeholderRev')"
          />
        </div>

        <div class="review-body">
          <label>{{$t('review.body')}}</label>
          <q-input
            v-model="review.reviewBody"
            :rules="[val => (val && val.length > 0) || `${$t('review.placeholdertype')}`]"
            type="textarea"
            outlined
            :placeholder="$t('review.placeholderWrite')"
          />
        </div>
        <div class="submit-btn flex justify-end">
          <app-button :label="$t('review.submit')" :flat="false" type="submit" />
        </div>
      </q-form>
    </q-card-section>
  </q-card>
</template>

<script>
export default {
  data() {
    return {
      review: {
        rating: 0,
        reviewTitle: "",
        reviewBody: ""
      }
    };
  },
  methods: {
    onSubmit() {
      this.$emit("onSubmit", this.review);
    }
  },
};
</script>

<style></style>
