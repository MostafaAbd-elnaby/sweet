<template>
  <div class="breadcrumbs">
    <q-breadcrumbs align="center">
      <template v-slot:separator>
        <q-icon size="1.5em" name="chevron_right" color="grey" />
      </template>

      <q-breadcrumbs-el style="color : grey" :label="this.$t('links.home')" to="/" />
      <q-breadcrumbs-el :label="current" />
    </q-breadcrumbs>
  </div>
</template>

<script>
export default {
  props: ["current"],
  created() {
    // console.log(this.$route)
  },
};
</script>

<style></style>
