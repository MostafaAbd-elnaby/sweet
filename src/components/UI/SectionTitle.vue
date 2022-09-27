<template>
  <h6 class="section-title text-uppercase"><slot></slot></h6>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.section-title {
  position: relative;
  padding-bottom: 5px;
  &::before {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 70px;
    height: 2px;
    background: $primary;
  }
}
</style>
