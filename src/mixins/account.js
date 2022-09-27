import {Cookies, Notify} from "quasar";

export const account = {
  data() {
    return {
      user: {
        name: "ahmed",
        phone: "0114628746",
        email: "a@a.asd",
        password: "",
        newPassword: "",
        city: "asd",
        country: "asd",
        address: "asd",
        governorate: "asdasd",
        post_code: null
      },
      loading: false,
      emailexsist: false,
      text: null,
      show_password: false
    };
  },
  computed: {
    is_login () {
      return this.$store.getters['account/is_login']
    },
  },
  methods: {
    validateEmail(email) {
      const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    },
    loginError () {
      this.text = 'Invalid login credentionls.'
      this.emailexsist = true
    },
    emailError () {
      this.text = 'sorry this email is uesd'
      this.emailexsist = true
    },
    success(res, noRoute = false) {
      this.emailexsist = false
      Cookies.set('account', res )
      Cookies.set('account_from_yalla2print_to_lumise', res, {
        domain: 'yalla2print.com'
      })
      this.$store.commit('account/GUEST_INFO', res)
      this.$q.notify({
          message: 'Account successfully created',
          color: 'white',
          textColor: 'black',
          timeout: 2000,
      })
      if (Cookies.has('checkOut')) {
        const url = Cookies.get('checkOut')
        Cookies.remove('checkOut')
        this.$router.push(url)
      }
      else {
        if (!noRoute)
          this.$router.push('/')
      }
    },
    updateProfile(res) {
      this.loading = false
      Cookies.remove('account' )
      Cookies.set('account', res )
      this.$q.notify({
        message: 'Account Profile updated successfully',
        color: 'white',
        textColor: 'black',
        timeout: 2000,
      })
    }
  },
  created() {
    const guest = this.$store.getters['account/guest']
    console.log(guest)
    if (guest) {
      this.user = { ...guest }
    }
  }
}
