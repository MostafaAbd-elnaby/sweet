<template>
  <div class="product-review">
    <header>
      <h5
        class="text-bold q-my-md"
        :class="$q.screen.lt.sm ? 'text-center' : ''"
      >
        {{$t('review.customer')}}
      </h5>
      <div
        class="flex q-gutter-md"
        :class="$q.screen.lt.sm ? 'justify-center' : 'justify-between'"
      >
        <div class="flex items-center">
          <span>{{$t(('review.Based'))}} {{ reviews.total }} {{$t(('review.title'))}}</span>
        </div>
        <app-button
          style="display : inline-block"
          :label="$t('review.write')"
          url=""
          @click.native="openReviewDialog"
        />
      </div>
    </header>
    <q-separator color="grey" class="q-my-lg" />

    <main>
      <reviews-list :reviews="reviews" />

      <q-dialog v-model="reviewDialog">
        <review-form @onSubmit="submitReview" />
      </q-dialog>
      <q-dialog v-model="openLoginFirst">
        <login-first @login="reviewDialog = true; openLoginFirst = false" />
      </q-dialog>
    </main>
  </div>
</template>

<script>
import ReviewForm from "../Review/ReviewForm.vue";
import LoginFirst from "../Review/LoginFirst.vue";
import ReviewsList from "../Review/ReviewsList.vue";
export default {
  components: { ReviewsList, ReviewForm, LoginFirst },
  data() {
    return {
      ratingModel: 4,
      reviewDialog: false,
      openLoginFirst: false,

    };
  },
  computed: {
    reviews () {
      return this.$store.getters['Products/reviews']
    },
  },
  methods: {
    async getReviews () {
      await this.$store.dispatch('Products/getreviews', this.$route.params.id).then(res => {

      })
    },
    openReviewDialog () {
      if (this.$store.getters['account/is_login']) {
        this.reviewDialog = true
      } else {
        this.openLoginFirst = true
      }
    },
    async submitReview(review) {
      const product_id = this.$route.params.id
      const payload = { ...review, product_id: product_id, client_id: this.$store.getters['account/guest'].id }
      this.$store.dispatch('Products/createreview', payload).then(res => {
        this.reviewDialog = false;
        this.getReviews()
      })
    }
  },
  created() {
    this.getReviews()
  }
};
</script>

<style></style>
