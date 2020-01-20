<template>
  <AFlex
    column
    class="side-bar"
  >
    <MSideBarNavigation/>
    <ASideBarList :list-data="listData" />
  </AFlex>
</template>

<script>
import AFlex from '@atoms/AFlex';
import MSideBarNavigation from '@molecules/MSideBarNavigation.vue';
import ASideBarList from '@atoms/ASideBarList.vue';
// for mapData
import { getMapData } from '@api';

export default {
  name: 'OSideBar',

  components: {
    AFlex,
    MSideBarNavigation,
    ASideBarList,
  },

  data: () => ({
    listData: [],
  }),

  created() {
    getMapData()
      .then((data) => {
        this.listData = data;
      });
  },
};
</script>

<style lang='scss' scoped>
.side-bar {
  border-right: 2px solid #000;
}
</style>
