export const imagePalaceHolder = {
  data() {
    return {};
  },
  computed: {
  },
  methods: {
    imagePalaceHolder ( event, product = null ) {
      if (product !== null)
        event.target.src = product.img;
      else
        event.target.src = this.$storage + 'no-image.jpg';
      // this.$refs.imagePalaceHolder.src =
    }
  }
}
