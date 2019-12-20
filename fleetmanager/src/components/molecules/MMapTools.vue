<template>
  <div class="pa-1 map-tools">
    <ACheckboxLabel
      :value='0'
      @input="$emit('input', $event)"
    >
      Hide map clusters
    </ACheckboxLabel>
  </div>
</template>

<script>
import ACheckboxLabel from '@atoms/ACheckboxLabel';

export default {
  name: 'MMapTools',

  components: {
    ACheckboxLabel,
  },
};
</script>

<style lang='scss'>
.map-tools {
  height: 40px;
  border-bottom: 2px solid #000;
}
</style>
