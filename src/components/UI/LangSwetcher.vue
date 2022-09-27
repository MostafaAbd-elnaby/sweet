<template>
  <q-select
    v-model="lang"
    :options="langOptions"
    label="Quasar Language"
    dense
    borderless
    emit-value
    map-options
    options-dense
    style="min-width: 150px"
  />
</template>

<script>
import languages from 'quasar/lang/index.json'
import {i18n} from "boot/i18n";
import {Cookies} from "quasar";
const appLanguages = languages.filter(lang =>
  [ 'ar', 'en-us' ].includes(lang.isoName)
)

export default {
  data () {
    return {
      lang: this.$q.lang.isoName
    }
  },

  watch: {
    lang (lang) {
      // dynamic import, so loading on demand only

      import(
      'quasar/lang/'+ lang
        ).then(lang => {
        this.$q.lang.set(lang.default)
      })
      this.$i18n.locale = lang
      Cookies.set('lang', this.$i18n.locale)
    }
  },

  created () {
    this.langOptions = appLanguages.map(lang => ({
      label: lang.nativeName, value: lang.isoName
    }))
  }
}
</script>
