<template>
  <div class="header">
    <div>
      <div @click="$emit('change-tab', 'main')">
        <img src="@images/headlight-route-planner.png" alt="headlight-route-planner" />
      </div>
      <div class="ml-3">
        Powered by <a href="https://www.graphhopper.com/">GraphHopper API</a>
      </div>
    </div>
    <AFlex>
      <AFlex
        v-if="userName"
        class="mr-3 header__user-name"
      >
          Welcome back, {{ userName }}
      </AFlex>
      <AFlex
        column
        class="header__action-place"
      >
        <AFlex
          between-xs
          class="header__action-place--row"
        >
          <ASelect
            v-model="formData.order"
            item-value="id"
            item-text="label"
            :items="formattedOrders"
            class="header__action-place--orders"
            @input="$emit('handle-order', $event)"
          />
          <MLogOutBtn class="ml-2" />
        </AFlex>
        <MMainRouterButtons @change-tab="$emit('change-tab', $event)"/>
      </AFlex>
    </AFlex>
  </div>
</template>

<script>
// Components
import MLogOutBtn from '@molecules/MLogOutBtn';
import MMainRouterButtons from '@molecules/MMainRouterButtons';
import AFlex from '@atoms/AFlex';
import ASelect from '@atoms/ASelect';

export default {
  name: 'OHeader',

  components: {
    MLogOutBtn,
    MMainRouterButtons,
    AFlex,
    ASelect,
  },

  props: {
    data: {
      type: Array,
      default: () => [],
    },
  },

  data: () => ({
    formData: {
      order: '',
    },
    userName: '',
  }),

  computed: {
    formattedOrders() {
      return this.data.map((item) => ({
        ...item,
        label: `${item.id} ${item.company}`,
      }));
    },
  },

  mounted() {
    if (localStorage.getItem('name')) {
      this.userName = localStorage.getItem('name');
    }
  },
};
</script>

<style lang="scss" scoped>
.header {
  background: #fff;
  border-bottom: 2px solid black;
  height: 100px;
  display: flex;
  align-items: center;
  justify-content: space-between;

  &__action-place {
    height: 100%;
    justify-content: space-between;

    &--row {
      align-items: baseline;
      margin-top: 5px;
    }
  }

  &__user-name {
    align-items: flex-end
  }
}
</style>
