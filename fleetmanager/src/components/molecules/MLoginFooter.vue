<template>
  <div class="mb-4 login-footer">
    <AFlex
      class="mt-3 auth-page__footer"
      middle-xs
    >
      <ACol class="auth-page__header--logo">
        © 2019 MobileIQ
        <a
          href="http://gomobileiq.com/assets/pdf/Headlight Terms of Service.pdf"
          class="ml-2"
        >
          Terms of Service
        </a>
        <a
          href="http://gomobileiq.com/assets/pdf/Headlight Privacy Policy.pdf"
          class="ml-2"
        >
          Privacy Policy
        </a>
      </ACol>
    </AFlex>
  </div>
</template>

<script>
import AFlex from '@atoms/AFlex';
import ACol from '@atoms/ACol';

export default {
  name: 'MLoginFooter',

  components: {
    AFlex,
    ACol,
  },
};
</script>

<style lang="scss" scoped>
@import "@design";
.auth-page__footer {
  height: 50px;
  background: $black-16;
  border-radius: 5px;
}
</style>
