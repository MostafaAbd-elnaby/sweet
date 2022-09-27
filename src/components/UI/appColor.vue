<template>
  <div class="row items-center">
    <div class="flex">
      <div
        v-for="(c, i) in colorsMax"
        :key="i"
        class="flex flex-center q-mr-sm q-mb-sm color"
        :class="{ 'active-color': active_color === i, 'image' : img }"
        @click="changeColor(c, i)"
      >
        <div v-if="img" class="rounded-color" @mouseenter="$emit('show', c.img)" @mouseleave="$emit('hide')" :style="{ background: c.color }">
          <q-img class="fit" :src="$storage + c.img" />
        </div>
        <div v-else-if="filter" @click="$emit('colorFilter', i)" class="rounded-color" :style="{ background: c }"></div>
        <div v-else  class="rounded-color" :style="{ background: c.color }"></div>

        <q-tooltip
          v-if="!$q.screen.lt.md && filter"
          anchor="top middle"
          self="bottom middle"
          :offset="[10, 10]"
          content-style="background-color: #000"
        >
          <strong>{{ i }}</strong>
        </q-tooltip>

        <q-tooltip
          v-if="!$q.screen.lt.md && c.name"
          anchor="top middle"
          self="bottom middle"
          :offset="[10, 10]"
          content-style="background-color: #000"
        >
          <strong>{{ c.name }}</strong>
        </q-tooltip>
      </div>
    </div>
    <q-space/>
      <span v-if="product" @click="showProduct(product)" class="q-mb-sm moreColors cursor-pointer">{{ $t('ui.allColors') }}</span>
  </div>
</template>

<script>

export default {
  props: {
    colors: {
      type: [Array, Object],
      require: true
    },
    product: {
      require: false,
      type: Object
    },
    img: {
      require: false,
      type: Boolean,
      default: false
    },
    filter: {
      require: false,
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      active_color: 0
    };
  },
  computed: {
    colorsMax () {
      if (this.colors) {
        if (!this.filter) {
          let colors = [], max = this.colors > 3 ? 3 : this.colors.length
          for (let i = 0; i < max; i++) {
            colors.push(this.colors[i])
          }
          return colors
        } else {
          return this.colors
        }
      }
      return []
    }
  },
  methods: {
    changeColor(color, index) {
      if (this.$q.screen.lt.md) this.$emit('showName', color.name)
      this.active_color = index;
      this.$emit("changeColor", color);
    },
    async showProduct( product ) {
      console.log(product)
      await this.$store.dispatch("Products/showProduct", product).then(res=> {
        this.$router.push(`/product/${res.id}`)
      });
    }
  }
};
</script>

<style lang="scss">
.color {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: #fff;
  overflow: hidden;
  cursor: pointer;
  transition: 0.3s ease-in-out;
  .rounded-color {
    width: 100%;
    height: 100%;
    border-radius: 50%;
  }
  &:hover {
    border: 1px solid #000;
    padding: 3px;
    transform: scale(1.1);
  }
}

.image {
  width: 47px;
  height: 47px;
}
.active-color {
  border: 1px solid #000;
  padding: 3px;
  transform: scale(1.1);
}
.moreColors {
  text-decoration: underline;
  color: #121212;
}
</style>
