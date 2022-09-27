<template>
  <q-btn
    class="semi-bold app-button"
    :color="color"
    :label="label"
    :outline="flat"
    :loading="loading"
    :to="url"
    @click="back ? $router.go(-1) : null"
    padding="7px 30px"
  />
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
    color: {
      type: String,
      require: false,
      default: 'primary'
    },
    loading: {
      type: Boolean,
      default: false,
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
