<template>
  <div
    class="g-field"
    :class="{
      'g-field--no-label': !hasLabel,
      'g-field--loading': loading,
    }"
  >
    <span
      v-if="hasLabel"
      class="g-field__label"
      :class="{
        'g-field__label--error': hasErrors,
        'g-field__label--success': !hasErrors && hasSuccessMessages,
      }"
    >
      {{ label }}
    </span>
    <div class="g-field__field-wrapper">
      <Component
        :is="multiline ? 'textarea' : 'input'"
        class="g-field__field"
        :class="{
          'g-field__field--error': hasErrors,
          'g-field__field--success': !hasErrors && hasSuccessMessages,
          'g-field__field--multiline': multiline,
        }"
        :type="multiline ? undefined : type"
        :rows="multiline ? rows : undefined"
        :placeholder="placeholder || undefined"
        :value.prop="value"
        :name="name"
        :disabled="disabled || loading"
        :autocomplete="multiline ? undefined : autocomplete"
        @blur="$emit('blur')"
        @focus="$emit('focus')"
        @input="$emit('input', $event.target.value)"
        @change="$emit('change', $event.target.value)"
        @keydown.enter.prevent="$emit('enter', $event.target.value)"
      />
    </div>
    <div
      v-if="hasErrors"
      class="g-field__hint g-field__hint--error j-error"
    >
      {{ errorMessages[0] }}
    </div>
    <div
      v-if="!hasErrors && hasSuccessMessages"
      class="g-field__hint g-field__hint--success-message"
    >
      {{ Array.isArray(successMessages) ? successMessages[0] : successMessages }}
    </div>
    <div
      v-if="hint && !hasErrors && !hasSuccessMessages"
      class="g-field__hint"
    >
      {{ hint }}
    </div>
  </div>
</template>

<script>
import { isEmpty } from 'chober';

export default {
  name: 'AInput',

  props: {
    placeholder: {
      type: String,
      default: '',
    },

    label: {
      type: String,
      default: '',
    },

    value: {
      type: [String, Number],
      default: null,
    },

    name: {
      type: String,
      default: '',
    },

    hint: {
      type: String,
      default: null,
    },

    type: {
      type: String,
      default: 'text',
    },

    autocomplete: {
      type: String,
      default: 'off',
    },

    disabled: {
      type: Boolean,
      default: false,
    },

    loading: {
      type: Boolean,
      default: false,
    },

    multiline: {
      type: Boolean,
      default: false,
    },

    rows: {
      type: [Number, String],
      default: 1,
    },

    errorMessages: {
      type: Array,
      default: () => [],
    },

    successMessages: {
      type: [Array, String],
      default: '',
    },
  },

  computed: {
    hasLabel() {
      return this.label !== '';
    },

    hasErrors() {
      return !isEmpty(this.errorMessages);
    },

    hasSuccessMessages() {
      return !isEmpty(this.successMessages);
    },
  },
};
</script>
