<template>
  <div class="main-import">
    <div class="side-bar">
      <MCustomerSupport />
      <MAccountInfo :data="data"/>
    </div>
    <div class="body"><OMainImport /></div>
  </div>
</template>

<script>
// Components
import MCustomerSupport from '@molecules/MCustomerSupport';
import MAccountInfo from '@molecules/MAccountInfo';
import OMainImport from '@organisms/OMainImport';

export default {
  name: 'OMain',

  components: {
    MCustomerSupport,
    MAccountInfo,
    OMainImport,
  },

  props: {
    data: {
      type: Object,
      default: () => ({}),
    },
  },
};
</script>

<style lang="scss" scoped>
.main-import {
  display: flex;
  height: 100%;
}
.side-bar {
  width: 25%;
  border: 1px solid #000;
  display: flex;
  flex-direction: column
}
.body {
  width: 75%;
}
</style>
