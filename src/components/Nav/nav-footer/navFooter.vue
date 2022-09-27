<template>
  <div class="account full-width">
    <h5 class="q-mb-md">{{$t('myAcc')}}</h5>
    <template v-if="!is_login">
      <app-button
        :label="$t('accounts.login')"
        url="/Account/login"
        :flat="false"
        class="full-width q-mb-md"
      />
      <app-button
        :label="$t('accounts.Register')"
        url="/Account/register"
        class="full-width q-mb-md"
      />
    </template>
    <template v-else>
      <app-button
        :label="$t('links.profile')"
        url="/Account/profile/info"
        :flat="false"
        class="full-width q-mb-md"
      />
      <app-button
      :label="$t('history')"
        url="/Account/profile/orders"
        class="full-width q-mb-md"
      />
      <app-button
        :label="$t('accounts.logout')"
        url=""
        @click.native="$store.dispatch('account/logout')"
        class="full-width q-mb-md"
      />
    </template>
  </div>
</template>

<script>
export default {
  computed: {
    is_login () {
      return this.$store.getters['account/is_login']
    }
  }
}
</script>

<style scoped>
.account {
  /*position: fixed;*/
  /*bottom: 0px;*/
}
</style>
