<template>
  <div class="quantity-box flex bg-grey-4 q-mr-md">
    <span class="dec" @click="inc_dec('dec')">-</span>
    <span>{{ product.qu ? product.qu : qu }}</span>
    <span class="inc" @click="inc_dec('inc')">+</span>
  </div>
</template>

<script>
export default {
  props: ["product"],
  data() {
    return {
      qu: 1
    };
  },
  methods: {
    inc_dec(type) {
      if (this.product.qu) {
        // Increment quantity if product in cart
        const oldQuantity = this.product.qu
        let inc = 0, dec = 0
        if (type === "inc") inc++
        else if (type === "dec") {
          if (this.product.qu == 1) return;
          dec--
        }
        const payload = {
          product: this.product,
          type: type,
          qu: type === 'inc' ? inc : dec
        };
        this.$store.dispatch("cart/inc_dec", payload);
      }
      else { // Increment quantity in Box only And Emitting value
        if (type === "inc") this.qu++
        else if (type === "dec") {
          if (this.qu == 1) return;
          this.qu--
        }
        this.$emit('quantity', this.qu)
      }
    }
  }
};
</script>

<style lang="scss">
.quantity-box {
  border-radius: 5px;
  span {
    font-size: 20px;
    padding: 5px 10px;
  }
  .dec,
  .inc {
    cursor: pointer;
  }
}
</style>
