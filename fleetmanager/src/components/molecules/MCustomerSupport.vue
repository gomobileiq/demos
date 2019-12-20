<template>
  <div class="pa-1 mb-3 customer">
    <AFlex column>
      <ATitle
        h2
        class="mt-0 pl-2"
      >
        Customer Support
      </ATitle>
      <AFlex>
        <ACol>email:</ACol>
        <ACol><a href="mailto:name@mail.com?subject=Ask">support@gomobileiq.com</a></ACol>
      </AFlex>
      <AFlex>
        <ACol>phone:</ACol>
        <ACol>(866) 261-8600 Option #3</ACol>
      </AFlex>
    </AFlex>
  </div>
</template>

<script>
import ATitle from '@atoms/ATitle';
import AFlex from '@atoms/AFlex';
import ACol from '@atoms/ACol';

export default {
  name: 'MCustomerSupport',

  components: {
    ATitle,
    AFlex,
    ACol,
  },
};
</script>
