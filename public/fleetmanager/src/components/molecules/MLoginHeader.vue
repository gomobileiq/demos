<template>
  <div class="mb-4 login-header">
    <AFlex
      class="auth-page__header"
      between-xs
      middle-xs
    >
      <ACol class="auth-page__header--logo">
        <img src="@images/logo.png" alt="MobileIQ" />
      </ACol>
      <ACol class="auth-page__header--link">
        <a href="http://www.gomobileiq.com">Return to website</a>
      </ACol>
    </AFlex>
  </div>
</template>

<script>
import AFlex from '@atoms/AFlex';
import ACol from '@atoms/ACol';

export default {
  name: 'MLoginHeader',

  components: {
    AFlex,
    ACol,
  },
};
</script>
