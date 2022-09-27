<template>
  <div class="filter">
    <h4 class="q-mt-none "> {{$t('shop.filter.title')}}  </h4>
    <!--  Filter  -->
    <div class="flex">

      <div v-for="(q, i) in query" :key="i" class="inline-block relative-position">
        <transition-group appear enter-active-class="animated fadeIn"
                          leave-active-class="animated fadeOut">
          <!--  Remove From Filter  -->
          <q-btn
            :key="i + 'btn'"
            icon="close" color="white"
            @click="shopFilter('remove', i)"
            class="bg-black absolute-top-right"
            style="z-index: 1"
            flat round size="5px"
          >
            <q-tooltip
              v-if="!$q.screen.lt.md"
              anchor="top middle"
              self="bottom middle"
              :offset="[10, 10]"
              content-style="background-color: #000"
            >
              <strong>{{ $t('remove') }}</strong>
            </q-tooltip>
          </q-btn>
          <!--  Filter Labels  -->
          <q-chip :key="i + 'chip'" >{{ q }}</q-chip>
        </transition-group>
      </div>

    </div>
    <!--  Clear Filter  -->
    <transition appear enter-active-class="animated fadeIn"
                leave-active-class="animated fadeOut">
        <div class="text-center" v-if="Object.keys(this.$route.query).length">
          <q-btn
            :label="$t('shopPrint.clear')"
            class="bg-black q-mt-sm full-width"
            size="sm" padding="5px 10px 2px 10px"
            color="white" flat rounded
            @click="$router.push('/shop')" >
              <q-tooltip
                v-if="!$q.screen.lt.md"
                anchor="bottom middle"
                self="top middle"
                :offset="[10, 10]"
                content-style="background-color: #000"
              >
                <strong>{{ $t('shop.filter.remove') }}</strong>
              </q-tooltip>
          </q-btn>
        </div>
      </transition>

    <div class="sizes">
      <h5 class="q-mb-md">{{$t('shop.filter.size')}}</h5>
      <button
        v-for="(s, i) in filter.sizes"
        :key="i"
        class="text-uppercase size-button q-mr-sm q-mb-sm"
        @click="shopFilter('Add', 'size', s)"
        :class="{ active: query.size === s }"
      >
        {{ s }}
      </button>
    </div>

<!--    <div class="colors">-->
<!--      <h5 class="q-mb-md">{{$t('shop.filter.colors')}}</h5>-->
<!--      <div class="flex q-gutter-sm">-->
<!--        <app-color :colors="filter.colors" :filter="true" @colorFilter="val => shopFilter('Add', 'color', val.replace(' ', '_'))" />-->
<!--      </div>-->
<!--    </div>-->

    <div class="printable-checkbox q-mt-xl q-mb-sm">
<!--      <q-icon name="print" size="25px" class="q-mr-sm" color="deep-purple-6" />-->
<!--      <q-checkbox-->
<!--        left-label-->
<!--        v-model="printable"-->
<!--        @input="val => printableState(val)"-->
<!--        color="deep-purple-6"-->
<!--        label="is printable"-->
<!--        style="font-size : 20px"-->
<!--      />-->
    </div>

    <div class="prices">
      <h5 class="q-mb-md">{{$t('shop.filter.Prices')}} <small>({{$t('shop.filter.currency')}})</small></h5>
      <div
        v-for="(price, i) in prices"
        :key="i"
        class="price q-mb-sm text-subtitle1"
        @click="shopFilter('Add', 'price', price)"
        :class="{ active: query.price === price[0] + ',' + price[1] }"
      >
        <span v-for="(p, i) in price" :key="i"
          ><small><strong>{{$t('shop.filter.currency')}}</strong></small>{{ p }}{{ i == 0 ? " - " : "" }}</span
        >
      </div>
    </div>

    <div class="brands">
      <h5 class="q-mb-md">{{$t('shop.filter.Brands')}} </h5>
      <div class="flex q-gutter-sm">
        <div
          v-for="(b, i) in filter.brands"
          :key="i"
          class="brand text-subtitle1"
          @click="shopFilter('Add', 'brand', b.name)"
          :class="{ active: query.brand === b.name }"
        >
          {{ b.name }}
        </div>
      </div>
    </div>

    <div class="collections">
      <h5 class="q-mb-md">{{$t('shop.filter.collections')}}</h5>
      <div class="flex q-gutter-sm" >
        <div
          v-for="(coll, i) in filter.collection"
          :key="i"
          class="collection  q-mb-sm text-subtitle1"
          @click="shopFilter('Add', 'collection', coll.slug)"
          :class="{ active: query.collection === coll.slug }"
        >
          {{ coll.name_en }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      prices: [
        [0, 50],
        [50, 100],
        [100, 150],
        [150, 200],
        [200, 300],
        [300, 400]
      ],
      printable: false,
    };
  },
  computed: {
    query () {
      return this.$route.query
    },
    filter () {
      const filter = this.$store.getters['Products/filterProducts']
      return filter ? filter : []
    }
  },
  watch: {

  },
  methods: {
    changeColor(color) {
      this.A__colors.push(color);
    },
    printableState (val) {
      console.log(val)
      this.shopFilter(val ? 'Add' : 'remove', 'is_printable', 'printable')
    },
    shopFilter(type, key, val = null) {
      let query = ''
      for (const q in this.$route.query) {
        if(q !== key)
          query += q + '=' + this.$route.query[q] + '&'
      }
      if (type === 'Add')
        query += key + '=' + val
      else
        this.printable = key === 'is_printable' ? false : true
      if (query.charAt(query.length-1) == '&')
        query = query.substring(0, query.length - 1);

      // return console.log(query)
      return this.$router.push('/shop?' + query)
    }
  }
};
</script>

<style lang="scss" scoped>
.filter {
  .sizes {
    .size-button {
      background-color: transparent;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 7px 10px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s ease-in-out;
      &:hover {
        background: #000;
        color: #fff;
      }
    }
    .active {
      background: #000;
      color: #fff;
    }
  }

  .price,
  .brand,
  .collection {
    position: relative;
    width: max-content;
    cursor: pointer;
    color: $grey;
    &::before {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0%;
      height: 1px;
      background: #666666;
      transition: 0.2s ease-in-out;
    }
    &:hover {
      &::before {
        width: 100%;
      }
    }
  }
  .active {
    &::before {
      width: 100%;
    }
  }
}

@media (min-width: 992px) {
  .filter {
    max-width: 80%;
  }
}
</style>
