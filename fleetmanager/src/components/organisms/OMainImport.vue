<template>
  <div class="pa-3 body-import">
    <div class="body-import-tabs">
      <MImpotrTabs
        @change-tab="checkCurrentTab"
      />
    </div>
    <div class="pa-3 body-import-components">
      <div class="my-info">
        {{ activeTab.toUpperCase() }}
        <MMyInfoForm v-if="activeTab === 'my-info'"/>
      </div>
    </div>
  </div>
</template>

<script>
// Components
import MImpotrTabs from '@molecules/MImpotrTabs';
import MMyInfoForm from '@molecules/MMyInfoForm';

export default {
  name: 'OMain',

  components: {
    MImpotrTabs,
    MMyInfoForm,
  },

  data: () => ({
    activeTab: 'my-info',
  }),

  methods: {
    checkCurrentTab(tabName) {
      this.activeTab = tabName;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@design";

.body-import {
  border-top: 1px solid #000;
  width: 70%;
}

.body-import-components {
  background: $pale-blue;
  //to merge tabs and content
  margin-top: -1px;
  border-radius: 0px 3px 3px 3px;
}
</style>
