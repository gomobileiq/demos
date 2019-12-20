<template>
  <div class="import-tabs">
    <AFlex>
      <div
        v-for="tab in tabsList"
        :key="tab.name"
      >
        <ABtn
          class="mr-2"
          color="grey"
          @click="$emit('change-tab', tab.slug)"
        >
          {{ tab.name }}
        </ABtn>
      </div>
    </AFlex>
  </div>
</template>

<script>
// Components
import ABtn from '@atoms/ABtn';
import AFlex from '@atoms/AFlex';

export default {
  name: 'MImpotrTabs',

  components: {
    ABtn,
    AFlex,
  },

  data: () => ({
    tabsList: [
      {
        name: 'My Info',
        slug: 'my-info',
      },
      {
        name: 'Settings',
        slug: 'settings',
      },
      {
        name: 'Import',
        slug: 'import',
      },
    ],
  }),
};
</script>
