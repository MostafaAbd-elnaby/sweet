<template>
  <div>

  </div>
</template>

<script>
export default {
  props: {
    label: {
      type: String,
      require: true
    },
    flat: {
      type: Boolean,
      default: true,
      require: true
    },
    back: {
      type: Boolean,
      default: false,
      require: false
    },
    url: {
      type: String,
      require: false
    },

  }
};
</script>

<style lang="scss">
.app-button {
  font-size: 13px;
  border-radius: 5px;
  .q-btn__wrapper {
    width: inherit;
  }
}
</style>
