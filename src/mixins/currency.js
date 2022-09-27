export const currency = {
  computed: {
    currency () {
      return this.$store.getters['cart/currency'];
    }
  }
}
