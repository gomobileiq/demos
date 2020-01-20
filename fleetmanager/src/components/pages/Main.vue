<template>
  <div class="main">
    <General />
  </div>
</template>

<script>
import General from '@templates/Genaral';

export default {
  name: 'main',

  components: {
    General,
  },
};
</script>

<style lang="scss" scoped>
.main {
  height: 100%;
}
</style>
