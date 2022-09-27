<template>
  <div class="sort ">
    <q-btn
      icon="las la-sort-amount-up"
      color="transparent"
      flat
      text-color="primary"
      :label="$t('sort')"
    >
      <q-menu transition-show="jump-up" transition-hide="jump-down" auto-close>
        <q-list style="min-width: 100px">
          <q-item
            v-for="(item, i) in list"
            :key="i"
            clickable
            @click="sortingProducts(item, $event)"
          >
            <q-item-section>{{ item.label }}</q-item-section>
          </q-item>
        </q-list>
      </q-menu>
    </q-btn>
  </div>
</template>

<script>
export default {
  data() {
    return {
      list: [
        {
          type: {
            type: 'title',
            name: 'asc'
          },
          label: 'Alphabetically, A-Z'
        },
        {
          type: {
            type: 'title',
            name: 'desc'
          },
          label: 'Alphabetically, Z-A'
        },
        {
          type: {
            type: 'price',
            name: 'asc'
          },
          label: 'Price, low to high'
        },
        {
          type: {
            type: 'price',
            name: 'desc'
          },
          label: 'Price, high to low'
        }
      ]
    };
  },
  methods: {
    sortingProducts(item, e) {
      this.$store.dispatch("Products/sortingProducts", item.type);
      this.sort = item.label;
    }
  }
};
</script>

<style></style>
