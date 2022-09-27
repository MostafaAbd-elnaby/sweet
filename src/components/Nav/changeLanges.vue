<template>

<div>
  <q-select
    v-model="lang"
    :options="langOptions"
    :label="$t('lang')"
    dense
    borderless
    emit-value
    map-options
    options-dense
    style="min-width: 150px"
  />
<h1>  {{ lang }}</h1>
</div>
</template>

<script>
import languages from 'quasar/lang/index.json'
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
    lang (val) {
      // dynamic import, so loading on demand only
      import('quasar/lang/' + val).then(lang => {
        this.$q.lang.set(lang.default)
      })
      this.$i18n.locale = val
      // console.log($i18n);
    }
  },

  created () {
    console.log(this.$i18n.lang);
    this.langOptions = appLanguages.map(lang => ({
      label: lang.nativeName, value: lang.isoName
    }))
  },

}
</script>
