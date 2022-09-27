<template>
  <div>
    <q-form @submit="update">
      <q-input
        v-model="user.name"
        outlined
        dense
        type="text"
        :label="$t('shipingInfo.placeholderName')"
        lazy-rules
        :rules="[
              val => (val && val.length > 3) || `${$t('shipingInfo.validation.fName')}`
            ]"
      />
      <q-input
        v-model="user.email"
        type="text"
        label="Email Address"
        :rules="[val => validateEmail(val) || `${$t('shipingInfo.validation.email')}`]"
        outlined
        dense
      />
      <q-input
        v-model="user.phone"
        outlined
        dense
        type="tel"
        :label="$t('phone')"
        lazy-rules
        :rules="[
              val =>
                (val && val.length >= 11) || `${$t('shipingInfo.validation.phone')}`
            ]"
      />
      <q-input
        v-model="user.address"
        outlined
        dense
        type="text"
        :label="$t('shipingInfo.placeholderCity')"
        lazy-rules
        :rules="[
              val => (val && val.length) || `${$t('shipingInfo.validation.adress')}`
            ]"
      />
      <q-input
        v-model="user.newPassword"
        outlined
        dense
        :type="show_password ? 'text' : 'password'"
        :label="$t('accounts.form.placeholderPass')"
        :placeholder="$t('passtext')"
        class="q-mb-md"
      >
        <template v-slot:append>
          <q-icon
            :name="show_password ? 'las la-lock-open' : 'las la-lock'"
            class="cursor-pointer"
            @click="show_password = !show_password"
          />
        </template>
      </q-input>
      <q-input
        v-model="user.city"
        outlined
        dense
        type="text"
        :label="$t('shipingInfo.placeholderCity')"
        lazy-rules
        :rules="[val => (val && val.length) || `${$t('shipingInfo.validation.city')}`]"
      />

      <div class="flex no-wrap justify-between q-mb-md">
        <q-input
          v-model="user.country"
          type="text"
          :label="$t('shipingInfo.placeholderCountry')"
          outlined
          class="q-pr-md"
          :rules="[
                val => (val && val.length) || `${$t('shipingInfo.validation.country')}`
              ]"
          dense
        />
        <q-input
          v-model="user.governorate"
          type="text"
          :label="$t('shipingInfo.placeholderGov')"
          outlined
          class="q-px-md"
          :rules="[
                val => (val && val.length) || `${$t('shipingInfo.validation.gov')}`
              ]"
          dense
        />
        <q-input
          v-model="user.post_code"
          type="text"
          :label="$t('shipingInfo.placeholderPC')"          outlined
          class="q-pl-md"
          :rules="[
                val => (val && val.length) || `${$t('shipingInfo.validation.postCode')}`
              ]"
          dense
        />
      </div>

      <appButton
        type="submit"
        :label="$t('save')"
        :flat="false"
        class="full-width q-mb-md"
      />
    </q-form>
  </div>
</template>

<script>
import {account} from "src/mixins/account";
export default {
  mixins: [account],
  data() {
    return {
      tab: 'profile'
    }
  },
  methods: {
    update () {
      this.loading = true
      this.$store.dispatch('account/update', this.user).then(res => {
        this.updateProfile(res.data.user)
      })
    }
  }
};
</script>

<style></style>
