<template>
  <div class="auth-page">
    <MLoginHeader />
    <MLoginBody />
    <MLoginFooter />
  </div>
</template>

<script>
import MLoginHeader from '@molecules/MLoginHeader';
import MLoginBody from '@molecules/MLoginBody';
import MLoginFooter from '@molecules/MLoginFooter';

export default {
  name: 'OAuthPage',

  components: {
    MLoginHeader,
    MLoginBody,
    MLoginFooter,
  },
};
</script>

<style lang="scss" scoped>
.auth-page {
  position: relative;
  margin-right: auto;
  margin-left: auto;
  width: 940px;
}
</style>
