<template>
  <span
    class="g-field g-field--no-label c-checkbox-label"
    :class="{ 'c-checkbox-label--disabled': disabled }"
    @click="toggleValue"
  >
    <ACheckbox
      v-model.number="innerValue"
      :disabled="disabled"
      :has-error="hasErrors"
      class="c-checkbox-label__checkbox"
    />
    <span class="c-checkbox-label__text">
      <slot />
    </span>
    <Transition name="g-slide-fade-up">
      <span
        v-if="hasErrors"
        class="g-field__error j-error"
      >
        {{ errorMessages[0] }}
      </span>
    </Transition>
  </span>
</template>

<script>
import { isEmpty } from 'chober';

import ACheckbox from '@atoms/ACheckbox';

export default {
  name: 'ACheckboxLabel',

  components: {
    ACheckbox,
  },

  props: {
    value: {
      type: Number,
      required: true,
    },

    errorMessages: {
      type: Array,
      default: () => [],
    },

    disabled: {
      type: Boolean,
      default: false,
    },
  },

  data: () => ({
    innerValue: 0,
  }),

  computed: {
    hasErrors() {
      return !isEmpty(this.errorMessages);
    },
  },

  watch: {
    value(value) {
      this.innerValue = value;
    },
  },

  created() {
    this.innerValue = this.value;
  },

  methods: {
    update() {
      this.$emit('input', this.innerValue);
    },

    toggleValue() {
      if (!this.disabled) {
        this.innerValue = Number(!this.innerValue);
        this.update();
      }
    },
  },
};
</script>

<style lang="scss">
@import "@design";

.c-checkbox-label {
  $self: &;

  display: flex;
  align-items: center;

  &__text {
    margin-left: 8px;
    font: 14px/2.3 $font-main;
    color: $charcoal-grey;
    cursor: default;

    #{$self}--disabled & {
      opacity: 0.5;
    }
  }
}
</style>
