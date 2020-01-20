<template>
  <AMap :map-data="mapData" :is-marker-cluster='isMarkerCluster' />
</template>

<script>
import AMap from '@atoms/AMap';

export default {
  name: 'MMap',

  props: {
    mapData: {
      type: Array,
      default: () => [],
    },

    isMarkerCluster: {
      type: Number,
      default: 1,
    },
  },

  components: {
    AMap,
  },
};
</script>
