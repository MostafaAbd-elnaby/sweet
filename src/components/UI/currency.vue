<template>
  <div>
    <template v-if="value && offer.id">


      <span class="text-caption q-pr-sm text-red" style="text-decoration: line-through">
        <small>{{ currency }}</small>
        {{ price }}</span>
      <small>{{ currency }}</small>
      <span class="">{{ offerCost }}</span>
    </template>
    <template v-else>
      <small>{{ currency }}</small>
      {{ price }}
    </template>


  </div>
</template>

<script>
export default {
  props: {
    value: {
      require: true,
      type: [Number, String],
      default: 0
    },
    offer: {
      require: false,
      type: Object,
      default: ()=>{ return {id : false} }
    }
  },
  computed: {
    currency () {
      return this.$store.getters['cart/currency'];
    },
    price () {
      return Number(this.value).toFixed(2)
    },
    offerCost () {
      let offer = 0
      if ( this.offer.id ) {
        offer = this.value - ((this.value / 100) * this.offer.cost)
      }
        return offer
    }
  }
}
</script>

<style lang="sass"  scoped>

</style>
