import {Notify} from "quasar";

export const cart = {
  data() {
    return {
      addCartLoading: false,
      addWishlistLoading: false,
      color: null,
      qu: 1,
      size: 'select'
    };
  },
  computed: {
    // color : {
    //   get(){
    //     return this.product ? this.product.colors[0] : []
    //   },
    //   set (val) {
    //     return  val
    //   }
    // }
  },
  methods: {
    async addToCart(product) {
      if (this.size !== 'select' || !product.sizes.length) {
        this.addCartLoading = true;
        let price
        if ( product.copone_offers.id ) {
          price = product.price - ((product.price / 100) * product.copone_offers.cost)
        } else {
          price = product.price
        }
        const item = {
          id: product.id,
          name_en: product.name_en,
          img: product.img,
          colors: product.colors,
          sizes: product.sizes,
          price: price,
          offers: product.copone_offers.id,
        }
        const newProduct = { ...item, color: this.color, size: this.size};
        const payload = { product: newProduct, qu: this.qu };
        await this.$store.dispatch("cart/addToCart", payload);
        setTimeout(() => {
          this.addCartLoading = false;
        }, 1000);
        return true
      }
      else {
        Notify.create({
          message: this.$t('Select_size'),
          icon: 'error',
          timeout: 500,
          color: 'red',
          textColor: 'white'
        })
        return false
      }
    },
    async bayItNow (product) {
      await this.addToCart(product).then( res => {
        if (res) this.$router.push('/cart')
      })
    },
    addToWishlist(product) {
        this.addWishlistLoading = true;
        const newProduct = { ...product, color: this.color, size: this.size};
        const payload = { product: newProduct, qu: this.qu };
        this.$store.dispatch("wishlist/addToWishlist", payload);
        setTimeout(() => {
          this.addWishlistLoading = false;
        }, 1000);
    },
    changeImg(color) {
      this.color = color;
      this.$refs.img[0].src = this.$storage + color.img;
    },
    async showProduct( product ) {
      this.$router.push(`/product/${product.id}`)
      // await this.$store.dispatch("Products/showProduct", product).then(res=> {
      // });
    }
  },
  mounted() {
    this.color = this.product.colors[0]
  }
}
