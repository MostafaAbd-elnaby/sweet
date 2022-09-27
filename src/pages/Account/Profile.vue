<template>
  <div class="profile-page">
    <h4 class="text-h4 text-center q-mb-sm">{{$t('accounts.Profile')}}</h4>
    <breadcrumbs :current="$t('accounts.Profile')" />

    <transition appear enter-active-class="animated fadeInUp slower">
      <profile />
    </transition>
  </div>
</template>

<script>
import Breadcrumbs from "src/components/UI/Breadcrumbs.vue";
import Profile from "src/components/Account/Profile.vue";
export default {
  components: { Breadcrumbs, Profile }
};
</script>

<style></style>
