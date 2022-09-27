<template>
  <q-card style="width : 400px">
    <q-card-section class="row items-center q-pb-none">
      <div class="text-h6 text-weight-bold">
        {{ $t("checkLog") }}
      </div>
      <q-space />
      <q-btn icon="close" flat round dense v-close-popup />
    </q-card-section>

    <q-card-section class="q-mb-lg q-pt-none">
      <div class="container">
<!--        <section-title class="q-my-none">Log In</section-title>-->

        <email :emailexsist="emailexsist" :text="text"/>

        <q-form @submit.prevent="login()">
          <q-input
            v-model="user.email"
            outlined
            type="email"
            placeholder="Email"
            lazy-rules
            :rules="[val => validateEmail(val) || 'Please type valid email']"
            class="q-mb-sm"
          />
          <q-input
            v-model="user.password"
            outlined
            :type="show_password ? 'text' : 'password'"
            placeholder="Password"
            lazy-rules
            :rules="[
            val => (val && val.length > 8) || 'Must be 8 characters or numbers '
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
    </q-card-section>
  </q-card>
</template>

<script>
import Login from "components/Account/LogIn";
import {account} from "src/mixins/account";
import Email from "components/Account/email";
import SectionTitle from "components/UI/SectionTitle";
import BaseCart from "components/UI/BaseCart";
export default {
  // eslint-disable-next-line vue/no-unused-components
  components: {Login, Email, SectionTitle, BaseCart},
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
          this.success(res.data.user, true)
          this.$emit('login')
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

<style></style>
