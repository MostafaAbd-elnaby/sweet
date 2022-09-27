<template>
  <base-cart>
    <div class="container">
      <section-title>{{$t('accounts.login')}}</section-title>

      <email :emailexsist="emailexsist" :text="text"/>

      <q-form @submit.prevent="login()">
        <q-input
          v-model="user.email"
          outlined
          type="email"
          :placeholder="$t('accounts.form.placeholderName')"
          lazy-rules
          :rules="[val => validateEmail(val) || `${$t('shipingInfo.validation.email')}`]"
          class="q-mb-sm"
        />
        <q-input
          v-model="user.password"
          outlined
          :type="show_password ? 'text' : 'password'"
          :placeholder="$t('accounts.form.placeholderPass')"
          lazy-rules
          :rules="[
            val => (val && val.length >= 8) || `${$t('shipingInfo.validation.pass')}`
          ]"
          class=""
        >
          <template v-slot:append>
            <q-icon
              :name="show_password ? 'las la-lock-open' : 'las la-lock'"
              class="cursor-pointer"
              @click="show_password = !show_password"
            />
          </template>
        </q-input>

        <button class=" forget-password text-grey-7" style="">
          {{$t('accounts.form.ForgetPass')}}
        </button>

        <appButton
          type="submit"
          :label="$t('accounts.login')"
          :flat="false"
          :loading="loading"
          class="full-width q-my-sm"
        />
      </q-form>

      <appButton :label="$t('accounts.Register')"  class="full-width" url="/Account/register" />
    </div>
  </base-cart>
</template>

<script>
import BaseCart from "../UI/BaseCart.vue";
import SectionTitle from "../UI/SectionTitle.vue";
import {account} from "src/mixins/account";
import Email from "components/Account/email";
export default {
  components: {Email, SectionTitle, BaseCart },
  mixins: [account],
  data() {
    return {
      user: {
        email: '',
        password: ''
      }
    }
  },
  methods: {
    async login() {
      this.loading = true
      await this.$store.dispatch('account/login', this.user).then( res => {

        this.loading = false
        if (res.data.login) {
          this.success(res.data.user)
        }
        else
        {
          this.loginError()
        }
      }).catch(err => {
        if (!err) return
        console.log(err)
        this.text = 'Something went wrong, please try again later'
        this.emailexsist = true
        this.loading = false
      })
    }
  }
};
</script>

<style>
.forget-password {
  all: unset;
  text-decoration: underline;
  cursor: pointer;
}
</style>
