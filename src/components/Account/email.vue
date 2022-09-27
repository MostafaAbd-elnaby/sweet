<template>

  <div style="height: 24.5px"  class="text-body1 q-mb-sm text-red">
    <transition-group appear class="row items-center" leave-active-class="animated fadeInLeft slower" enter-active-class="animated fadeInRight slower">
        <q-icon v-if="emailexsist" key="icon" size="sm" name="las la-frown"/>
      <span v-if="emailexsist" key="text">
        <span class="q-mt-sm inline-block">{{ text }}</span>
      </span>
    </transition-group>
  </div>

</template>
<script>
export default {
  props: ['emailexsist', 'text']
}
</script>
