<template>
  <div class="pa-1 mb-3 customer">
    <AFlex column>
      <ATitle
        h2
        class="mt-0 pl-2"
      >
        Account Information
      </ATitle>
      <AFlex>
        <ACol
          class="text-xs-right"
          xs="4"
        >
          Account id:
        </ACol>
        <ACol xs="8">
          <div>{{ data.id || '-' }}</div>
          <div>{{ data.company || '-' }}</div>
          <div>{{ data.phone || '-' }}</div>
        </ACol>
      </AFlex>
      <AFlex>
        <ACol
          class="text-xs-right"
          xs="4"
        >
          #deliveries:
        </ACol>
        <ACol xs="8">{{ data.frequency || '-' }}</ACol>
      </AFlex>
      <AFlex>
        <ACol
          class="text-xs-right"
          xs="4"
        >
          #ids:
        </ACol>
        <ACol xs="8">{{ data.geocode_accuracy || '-' }}</ACol>
      </AFlex>
      <AFlex>
        <ACol
          class="text-xs-right"
          xs="4"
        >
          #ids:
        </ACol>
        <ACol xs="8">{{ data.day || '-' }}</ACol>
      </AFlex>
    </AFlex>
  </div>
</template>

<script>
import ATitle from '@atoms/ATitle';
import AFlex from '@atoms/AFlex';
import ACol from '@atoms/ACol';

export default {
  name: 'MAccountInfo',

  components: {
    ATitle,
    AFlex,
    ACol,
  },

  props: {
    data: {
      type: Object,
      default: () => ({}),
    },
  },
};
</script>
