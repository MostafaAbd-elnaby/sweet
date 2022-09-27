<template>
  <q-card flat>
    <q-markup-table v-if="!$q.screen.lt.sm" flat>
      <thead>
      <tr>
        <th class="text-left">{{$t('order.num')}}</th>
        <th class="text-right">{{$t('order.count')}}</th>
        <th class="text-right">{{$t('order.sup')}}</th>
        <th class="text-right">S{{$t('order.ship')}}</th>
        <th class="text-right">{{$t('order.total')}}</th>
        <th class="text-right">{{$t('order.status')}}</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(order, i) in orders.data" :key="i">
        <td class="text-left cursor-pointer text-blue"
            @click="$emit('singleOrder', order.id)"
            style="text-decoration: underline">{{ order.order_num }}</td>
        <td class="text-center">{{ order.products.length }}</td>
        <td class="text-center"><currency :value="order.sup_total" /></td>
        <td class="text-center"><currency :value="order.shipping_cost" /></td>
        <td class="text-center"><currency :value="order.total" /></td>
        <td class="text-center">{{ order.status }}</td>
      </tr>
      </tbody>
    </q-markup-table>

    <div v-else >
      <q-list class="q-my-md" v-for="(order, i) in orders.data" :key="i" bordered separator>
        <q-item clickable v-ripple
                @click="$emit('singleOrder', order.id)">
          <q-item-section avatar>
            <span >{{$t('order.num')}}</span>
          </q-item-section>
          <q-item-section style="text-decoration: underline" class="text-blue" >{{order.order_num}}</q-item-section>
        </q-item>
        <q-item>
          <q-item-section avatar>
            <span class="text-grey">{{$t('order.count')}}</span>
          </q-item-section>
          <q-item-section>{{ order.products.length }} </q-item-section>
        </q-item>
        <q-item>
          <q-item-section avatar>
            <span class="text-grey">{{$t('order.sup')}}</span>
          </q-item-section>
          <q-item-section><currency :value="order.sup_total"/> </q-item-section>
        </q-item>
        <q-item>
          <q-item-section avatar>
            <span class="text-grey">{{$t('order.ship')}}</span>
          </q-item-section>
          <q-item-section><currency :value="order.shipping_cost"/> </q-item-section>
        </q-item>
        <q-item>
          <q-item-section avatar>
            <span class="text-grey">{{$t('order.total')}}</span>
          </q-item-section>
          <q-item-section><currency :value="order.total"/> </q-item-section>
        </q-item>
        <q-item>
          <q-item-section avatar>
            <span class="text-grey">{{$t('order.status')}}</span>
          </q-item-section>
          <q-item-section><currency :value="order.total"/> </q-item-section>
        </q-item>
      </q-list>
    </div>

    <q-card-section class=" justify-center  row q-pa-none">
      <q-pagination
        v-model="current_page"
        :max="orders.last_page"
        @input="$emit('pagination', current_page)"
        input
        icon-last="las la-angle-double-right"
        icon-first="las la-angle-double-left"
        icon-next="las la-angle-right"
        icon-prev="las la-angle-left"
      />
    </q-card-section>
  </q-card>
</template>

<script>
import Currency from "components/UI/currency";
export default {
  components: {Currency},
  props: ['orders'],
  data() {
    return {
      orderNum: null,
      current_page: 1
    };
  },
  methods: {

  }
};
</script>

<style></style>
