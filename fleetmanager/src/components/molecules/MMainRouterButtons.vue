<template>
  <div class="mb-1 main-router">
    <ABtn
      class="mr-2 main-router-button"
      color='fiery'
      @click="$emit('change-tab', 'import')"
    >
      Import
    </ABtn>
    <ABtn
      class="mr-2 main-router-button"
      color='fiery'
      @click="$emit('change-tab', 'routes')"
    >
      Routes
    </ABtn>
    <ABtn
      class="mr-2 main-router-button"
      color='fiery'
      @click="$emit('change-tab', 'reports')"
    >
      Reports
    </ABtn>
    <ABtn
      class="mr-2 main-router-button"
      color='fiery'
      @click="routTo('help')"
    >
      Help
    </ABtn>
  </div>
</template>

<script>
// Components
import ABtn from '@atoms/ABtn';

export default {
  name: 'MMainRouterButtons',

  components: {
    ABtn,
  },

  methods: {
    routTo() {
      window.open('http://www.gomobileiq.com/help/', '_blank');
    },
  },
};
</script>

<style lang="scss" scoped>
.header {
  background: #fff;
  display: flex;
  align-items: center;
  justify-content: flex-end;
}
.main-router-button {
  color: #fff !important;
}
.main-router-button:hover {
  color: #fff !important;
}
</style>
