<template>
  <div class="product-card bg-white q-pa-sm">
    <div class="product-imgs q-mb-sm relative-position">
      <img
        class="fit cursor-pointer"
        :src="product.thumbnail_url"
        ref="img"
        @click="openEditor"
      />
      <!-- inner Hover -->
      <div class="inner-hover bg-white">
        <q-btn
          size="13px"
          :dense="$q.screen.lt.md"
          flat
          icon="las la-marker"
          class="cursor-pointer"
          @click.native="openEditor"
        >
          <q-tooltip
            v-if="!$q.screen.lt.md"
            anchor="top middle"
            self="bottom middle"
            :offset="[10, 10]"
            content-style="background-color: #000"
          >
            <strong>{{$t('shopPrint.custom')}}</strong>
          </q-tooltip>
        </q-btn>
        <q-btn
          size="13px"
          :dense="$q.screen.lt.md"
          flat
          icon="lab la-sketch"
          class="cursor-pointer"
          @click.native="quickView = true"
        >
          <q-tooltip
            v-if="!$q.screen.lt.md"
            anchor="top middle"
            self="bottom middle"
            :offset="[10, 10]"
            content-style="background-color: #000"
          >
            <strong>{{$t('shopPrint.select')}}</strong>
          </q-tooltip>
        </q-btn>
      </div>
    </div>
    <!-- product-details -->
    <div class="product-details">
      <div class="product-name text-subtitle1 cursor-pointer ellipsis">{{ product.name }}</div>
      <div class="product-price q-my-sm ">
        <currency :value="product.price" />
      </div>
    </div>
    <!-- printable badge -->
<!--    <div v-if="product.is_printable" class="printable">-->
<!--      <span class="text-subtitle2">printable</span>-->
<!--    </div>-->
    <!-- quick view product -->
    <q-dialog v-model="quickView" transition-show="fade" transition-hide="fade">
      <q-card class="" style="width: 900px; max-width: 90vw;">
        <q-banner>
          <q-btn icon="close" class="absolute-top-right q-mt-md q-mr-md" flat round v-close-popup />
          <div class="text-center"> {{$t('shopPrint.select')}}</div>
        </q-banner>
        <q-card-section class="row items-center justify-center">
          <div class="col-12 col-sm-4 cursor-pointer" v-for="(scr, i) in design" :key="i" >
            <q-img @click="openEditor(scr.cart_id)"  :src="'https://design.yalla2print.com/data/orders/' + scr.screenshots" />
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
import Currency from "components/UI/currency.vue";
export default {
  props: ["product"],
  components: { Currency },
  data() {
    return {
      quickView: false,
    };
  },
  computed: {
    design () {
      const design = this.product.design
      // console.log(JSON.parse(design))
      return this.product.design
    }
  },
  methods: {
    openEditor (cart_id = null) {
      const cart = cart_id === null ? '' : '&cart='+cart_id
      window.open(`https://design.yalla2print.com/editor.php?product_base=${this.product.id}`, '_blank')
    }
  }
};
</script>

<style lang="scss" scoped>
.product-card {
  position: relative;
  transition: 0.5s ease-in-out;
  &:hover {
    box-shadow: 0px 0px 12px 2px #cccccc69;
  }
  .product-imgs {
    overflow: hidden;
    .img-2 {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      visibility: hidden;
      transition: 0.5s linear;
    }
    .inner-hover {
      position: absolute;
      bottom: 0;
      width: 100%;
      display: flex;
      justify-content: space-between;
      button {
        padding: 3px 10px;
      }
    }
  }
  .product-price {
    font-size: 18px;
    color: $grey;
  }
  .printable {
    position: absolute;
    top: 20px;
    left: 30px;
    padding: 1px 15px;
    border-radius: 15px;
    background-color: #9a84c8;
    color: #fff;
  }
}

@media (min-width: 767px) {
  .product-card {
    &:hover {
      .product-imgs {
        .inner-hover {
          bottom: 40px;
          opacity: 1;
          visibility: visible;
        }
      }
    }
    .product-imgs {
      .inner-hover {
        width: max-content;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 5px;
        overflow: hidden;
        opacity: 0;
        visibility: hidden;
        transition: 0.2s ease-in-out;
        button {
          border: none;
          border-right: 1px solid #ccc;
          padding: 3px 5px;
          transition: 0.5s ease-in-out;
          &:hover {
            background: #000;
            color: #fff;
          }
        }
      }
      &:hover {
        .img-2 {
          opacity: 1;
          visibility: visible;
          transform: scale(1.1);
        }
      }
    }
    .product-name {
      font-size: 20px;
      text-decoration: underline;

    }
  }
}
</style>
