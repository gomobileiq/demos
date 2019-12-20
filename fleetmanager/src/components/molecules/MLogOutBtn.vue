<template>
  <div class="log-out">
    <ABtn
      class="mr-2 log-out-btn"
      transparent
      @click="logout"
    >
      Log out
    </ABtn>
  </div>
</template>

<script>
// Components
import ABtn from '@atoms/ABtn';

export default {
  name: 'MLogOutBtn',

  components: {
    ABtn,
  },

  methods: {
    logout() {
      localStorage.removeItem('name');
      this.$router.push('/login');
    },
  },
};
</script>

<style lang="scss" scoped>
.log-out {
  display: flex;
  justify-content: flex-end;
}

.log-out-btn {
  color: #000 !important;
}
.log-out-btn:hover {
  color: #000 !important;
}
</style>
