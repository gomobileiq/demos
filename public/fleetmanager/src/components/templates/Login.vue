<template>
  <div class="login">
    <OAuthPage />
  </div>
</template>

<script>
// Componets
import OAuthPage from '@organisms/OAuthPage';

export default {
  name: 'Login',

  components: {
    OAuthPage,
  },
};
</script>

<style lang="scss" scoped>
.login {
  height: 100%;
  background: url("../../images/bgr.gif") #f9faf4 repeat-x top;
  color: #555555;
}
</style>
