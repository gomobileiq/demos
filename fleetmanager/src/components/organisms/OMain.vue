<template>
  <div class="main">
    <OSideBar />
    <OMap class="body" />
  </div>
</template>
<script>
// import GoogleMap from '@atoms/GoogleMap.vue';
import OSideBar from '@organisms/OSideBar';
import OMap from '@organisms/OMap';

export default {
  name: 'OMain',
  components: {
    OSideBar,
    OMap,
  },
};
</script>

<style lang="scss" scoped>
.main {
  display: flex;
}
.side-bar {
  width: 25%;
}
.body {
  width: 75%;
}
</style>
