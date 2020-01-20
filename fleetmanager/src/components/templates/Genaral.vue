<template>
  <div class="general">
    <div class="header">
      <OHeader
        :data="orderData"
        @change-tab="getTab"
        @handle-order="findOrderData"
      />
    </div>
    <div class="main">
      <OImport
        v-if="currentTab === 'import'"
        :data="currentOrderData"
      />
      <ORoutes v-if="currentTab === 'routes'" />
      <OReports v-if="currentTab === 'reports'" />
      <OMain v-if="currentTab === 'main'" />
    </div>
  </div>
</template>
<script>
// Components
import OHeader from '@organisms/OHeader';
import OImport from '@organisms/OImport';
import ORoutes from '@organisms/ORoutes';
import OReports from '@organisms/OReports';
import OMain from '@organisms/OMain';

// api
import { getOrders } from '@api';

export default {
  name: 'General',
  components: {
    OHeader,
    OImport,
    OReports,
    ORoutes,
    OMain,
  },

  data: () => ({
    orderData: [],
    currentOrderData: {},
    currentTab: 'main',
  }),

  mounted() {
    getOrders().then((res) => {
      this.orderData = res;
    });
  },

  methods: {
    getTab(value) {
      this.currentTab = value;
    },

    findOrderData(value) {
      this.currentOrderData = this.orderData.find((item) => item.id === value);
    },
  },
};
</script>
<style lang="scss" scoped>
.general {
  display: flex;
  flex-direction: column;
  height: 100%;
}
.main {
  height: 100%;
}
.log-out-btn {
  color: #fff !important;
}
.log-out-btn:hover {
  color: #fff !important;
}
</style>
