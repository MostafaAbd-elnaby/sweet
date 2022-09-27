<template>
  <base-cart>
    <div class="container">
      <section-title class="q-mb-lg">{{$t('PInfo')}}</section-title>

      <email :emailexsist="emailexsist" :text="text"/>

      <q-form @submit.prevent="register()">
        <q-input
          v-model="user.name"
          outlined
          type="text"
          :placeholder="$t('shipingInfo.placeholderName')"
          lazy-rules
          :rules="[
            val => (val && val.length > 3) ||  `${$t('shipingInfo.validation.fName')}`
          ]"
          class="q-mb-sm"
        />
        <q-input
          v-model="user.phone"
          outlined
          type="tel"
          :label="$t('phone')"
          lazy-rules
          :rules="[
            val => (val && val.length >= 11) || `${$t('shipingInfo.validation.phone')}`
          ]"
          class="q-mb-sm"
        />
        <q-input
          v-model="user.email"
          outlined
          type="text"
          :placeholder="$t('shipingInfo.placeholderEmail')"
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
            val => (val && val.length > 8) || `${$t('shipingInfo.validation.pass')}`
          ]"
          class="q-mb-sm"
        >
          <template v-slot:append>
            <q-icon
              :name="show_password ? 'las la-lock-open' : 'las la-lock'"
              class="cursor-pointer"
              @click="show_password = !show_password"
            />
          </template>
        </q-input>

        <appButton
          type="submit"
          :label="$t('signUp')"
          :flat="false"
          :loading="this.loading"
          class="full-width q-mb-md"
        />
      </q-form>

      <appButton :label="$t('accounts.login')" class="full-width" url="/Account/login" />
    </div>
  </base-cart>
</template>

<script>
import BaseCart from "../UI/BaseCart.vue";
import SectionTitle from "../UI/SectionTitle.vue";
import {account} from "src/mixins/account";
import Email from "components/Account/email";
import email from "components/Account/email";
export default {
  components: {Email, SectionTitle, BaseCart },
  mixins: [account],
  data() {
    return {

    };
  },
  methods: {

    async register() {
      this.loading = true
      await this.$store.dispatch('account/register', this.user).then( res => {
        this.loading = false
        if (res.data.email) {
          this.emailError()
        }
        else
        {
          this.success(res.data.user)
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
