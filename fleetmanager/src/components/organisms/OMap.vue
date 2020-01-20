<template>
  <AFlex column>
    <MMapTools @input='isMarkerCluster'/>
    <MMap
      :is-marker-cluster='isMarkerCluster'
      :map-data="mapData"
    />
  </AFlex>
</template>

<script>
import AFlex from '@atoms/AFlex';
import MMapTools from '@molecules/MMapTools';
import MMap from '@molecules/MMap';
import { getMapData } from '@api';

export default {
  name: 'OMap',

  components: {
    AFlex,
    MMapTools,
    MMap,
  },

  data: () => ({
    mapData: [],
  }),

  created() {
    getMapData()
      .then((data) => {
        this.mapData = data;
      });
  },

  methods: {
    isMarkerCluster(value) {
      return value;
    },
  },
};
</script>
