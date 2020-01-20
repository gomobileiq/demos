<template>
  <div class="pa-2 side-bar__navigation">
    <div>
      Enter search term
    </div>
    <div>
      <input type="text">
    </div>
    <APagination />
  </div>
</template>

<script>
import APagination from '@atoms/APagination';

export default {
  name: 'MSideBarNavigation',

  components: {
    APagination,
  },
};
</script>

<style lang='scss' scoped>
.side-bar {
  &__navigation {
    border-bottom: 2px solid #000;
  }
}
</style>
