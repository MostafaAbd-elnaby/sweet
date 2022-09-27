<template>
  <q-skeleton class="bg-grey-2" height="380px" square >
    <q-skeleton animation="none" class="absolute-bottom bg-grey-4 no-border-radius q-pl-sm" height="120px" >
      <q-skeleton animation="pulse-x" width="160px" height="10px" class="bg-grey-6" />
      <q-skeleton animation="pulse-x" width="140px" height="10px" class="bg-grey-6 q-mt-sm" />
      <div class="flex q-mt-lg q-ml-sm ">
        <q-skeleton animation="none" type="circle" class="bg-grey-5" size="30px" />
        <q-skeleton animation="none" class="q-ml-sm bg-grey-5" type="circle" size="30px" />
      </div>
    </q-skeleton>
  </q-skeleton>
</template>
