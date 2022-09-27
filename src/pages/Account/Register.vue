<template>
  <div class="register-page">
    <h4 class="text-h4 text-center q-mb-sm">Register</h4>
    <breadcrumbs current="Create Account" />
    <transition appear enter-active-class="animated fadeInUp slower">
      <register />
    </transition>
  </div>
</template>

<script>
import Register from "src/components/Account/Register.vue";
import Breadcrumbs from "src/components/UI/Breadcrumbs.vue";

export default {
  components: { Register, Breadcrumbs }
};
</script>

<style></style>
