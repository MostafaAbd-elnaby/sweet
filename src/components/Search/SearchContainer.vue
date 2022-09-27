<template>
  <div class="search-container q-py-lg">
    <div class="container">
      <div class="search-title flex justify-between items-center">
        <div class="text-h6 text-bold">
          {{$t('SearchTitle')}}
        </div>
        <q-btn
          icon="close"
          flat
          round
          size="md"
          class="text-bold cursor-pointer"
          @click="clearSearch"
        >
          <q-tooltip
            anchor="top middle"
            self="bottom middle"
            :offset="[10, 10]"
            content-style="background-color: #000"
          >
          {{$t('close')}}
          </q-tooltip>
        </q-btn>
      </div>
      <div class="search-input q-mt-md">
        <q-input
          autofocus
          color="black"
          outlined
          dense
          v-model="name_en"
          @keyup="search"
          type="text"
          :placeholder="$t('Searchprod')"
        >
          <template v-slot:append>
            <q-icon
              v-if="name_en !== ''"
              size="md"
              @click="search"
              class="cursor-pointer"
              name="search" />
            <q-icon
              v-if="name_en !== ''"
              size="xs"
              name="close"
              @click="name_en = '';clearSearch"
              class="cursor-pointer"
            />
          </template>
        </q-input>
      </div>

      <div v-if="products.data.length" class="row q-col-gutter-md q-mt-xl" >
        <div class="col-md-9 col-lg-10">
          <template v-if="products.total">
            <product-list :products="products" />
          </template>
          <template v-else>
            <no-data-animate text="Sorry! no products founded try anther name." />
          </template>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import ProductList from "components/Product/ProductList";
import noDataAnimate from "components/Product/no-data-animate";

export default {
  components: { ProductList, noDataAnimate },
  data() {
    return {
      name_en: ""
    };
  },
  computed: {
    products() {
      return this.$store.getters['Products/search']
    }
  },
  methods: {
    async search () {
      if (this.name_en !== '') {
        const payload = {
          search: 'true',
          name_en: this.name_en
        }
        await this.$store.dispatch('Products/searchProduct', payload).then(res => {
          console.log(res)
        })
      } else {
        this.$store.commit('Products/PRODUCT_SEARCH', {
          data: []
        })
      }
    },
    clearSearch() {
      this.$store.commit('Products/PRODUCT_SEARCH', {
        data: []
      })
        this.$emit('close')
    }
  }
};
</script>

<style lang="sass">
.search-container
  background: #fff
  position: fixed
  width: 100vw
  height: 100vh
  z-index: 111111
</style>
