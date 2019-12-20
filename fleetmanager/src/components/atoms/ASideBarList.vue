<template>
  <div class="pa-2 side-bar__list">
    <div
      v-for="item in listOrders.slice(0,8)"
      :key="item.id"
      class="pa-1 side-bar__list-item"
    >
      <AFlex between-xs>
        <div>{{ item.id }}</div>
        <div>{{ item.lrds }}</div>
      </AFlex>
      <div class="side-bar__item-company">{{ item.company }}</div>
      <div>
        <a href="#">ETA: Tue, Jan 1st, WILL CALL</a>
      </div>
    </div>
  </div>
</template>

<script>
import AFlex from '@atoms/AFlex';

export default {
  name: 'ASideBarList',

  components: {
    AFlex,
  },

  props: {
    listData: {
      type: Array,
      default: () => [],
    },
  },

  data: () => ({
    listOrders: [],
  }),

  watch: {
    listData() {
      this.getFormattedListData();
    },
  },

  created() {
    this.getFormattedListData();
  },

  methods: {
    getFormattedListData() {
      this.listOrders = this.listData.map((order) => ({
        id: order.id,
        lrds: order.lrds,
        company: order.company,
      }));
    },
  },
};
</script>

<style lang='scss' scoped>
@import "@design";

.side-bar {
  &__list {
    background-color: rgba($color: $light-blue-grey, $alpha: 0.2);
    flex: 1;
  }
  &__list-item {
    background-color: #fff;
    border: 1px solid #000;
    margin-bottom: 5px;
    font-size: 12px
  }

  &__item-company {
    font-weight: 700;
  }
}
</style>
