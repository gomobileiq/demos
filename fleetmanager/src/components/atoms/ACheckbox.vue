<template>
  <input
    v-model.number="innerValue"
    type="checkbox"
    class="c-checkbox__input"
    true-value="1"
    false-value="0"
    @change="update"
  >
</template>

<script>
export default {
  name: 'ACheckbox',

  props: {
    value: {
      type: Number,
      required: true,
    },
  },

  data: () => ({
    innerValue: 0,
  }),

  watch: {
    value(value) {
      this.innerValue = value;
    },
  },

  methods: {
    update() {
      this.$emit('input', this.innerValue);
    },
  },
};
</script>

<style lang="scss">
@import "@design";

.c-checkbox {
  $self: &;
  $size: 16px;

  display: flex;
  align-items: center;
  justify-content: center;
  flex: none;
  width: $size;
  height: $size;
  border: 1px solid $light-blue-grey;
  border-radius: 2px;
  transition: border-color 0.2s ease;
  cursor: pointer;

  &:hover,
  &--checked {
    border-color: rgba($charcoal-grey, 0.56);
  }
}
</style>
