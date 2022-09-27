import Vue from 'vue'
import VueI18n from 'vue-i18n'
import messages from 'src/i18n'

Vue.use(VueI18n)

const i18n = new VueI18n({
  locale: 'ar',
  messages
})

export default ({ app }) => {
  // Set i18n instance on app
  app.i18n = i18n
}

export { i18n }
// import { boot } from 'quasar/wrappers'
// import { createI18n } from 'vue-i18n'
// import messages from 'src/i18n'

// export default boot(({ app }) => {
//   const i18n = createI18n({
//     locale: 'ar',
//     messages
//   })

//   // Set i18n instance on app
//   app.use(i18n)
// })
