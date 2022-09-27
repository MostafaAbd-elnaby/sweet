<template>
  <div class="login-page">
    <h4 class="text-h4 text-center q-mb-sm">{{$t('accounts.login')}}</h4>
    <breadcrumbs current="Account" />

    <transition appear enter-active-class="animated fadeInUp slower">
      <log-in />
    </transition>
  </div>
</template>

<script>
import LogIn from "src/components/Account/LogIn.vue";
import Breadcrumbs from "src/components/UI/Breadcrumbs.vue";
export default {
  components: { LogIn, Breadcrumbs }
};
</script>

<style></style>
