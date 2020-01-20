<template>
  <AFlex
    row
    baseline-xs
    class="form-row"
  >
    <ACol
      :xs="titleXs"
      :sm="titleSm"
    >
      <div class="form-row__label">
        <slot name="title" />
      </div>
    </ACol>
    <ACol
      :xs="fieldXs"
      :sm="fieldSm"
    >
      <slot name="field" />
    </ACol>
  </AFlex>
</template>

<script>
// Components
import AFlex from '@atoms/AFlex';
import ACol from '@atoms/ACol';

export default {
  name: 'AFormRow',

  components: {
    AFlex,
    ACol,
  },

  props: {
    titleXs: {
      type: String,
      default: '12',
    },

    titleSm: {
      type: String,
      default: '3',
    },

    fieldXs: {
      type: String,
      default: '12',
    },

    fieldSm: {
      type: String,
      default: '9',
    },
  },
};
</script>

<style lang="scss">
@import "@design";

.form-row {
  &__label {
    color: #000;
    margin-top: 5px;
  }
}
</style>
