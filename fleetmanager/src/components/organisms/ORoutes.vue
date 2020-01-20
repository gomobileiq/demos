<template>
  <div class="main">
    <div class="side-bar">Side-bar Routes</div>
    <div class="body">Main Routes</div>
  </div>
</template>

<script>

export default {
  name: 'ORoutes',
};
</script>

<style lang="scss" scoped>
.main {
  display: flex;
}
.side-bar {
  width: 25%;
  background: rgb(199, 247, 213);
}
.body {
  width: 75%;
  background: rgb(182, 181, 250);
}
</style>
