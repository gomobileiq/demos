<template>
  <div
    class="g-field"
    :class="{
      'g-field--no-label': !hasLabel,
      'g-field--loading': loading,
      'g-field--error': hasErrors,
      'g-field--success': !hasErrors && hasSuccessMessages,
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
      <Multiselect
        v-model="localValue"
        :options="allowSelectAll ? groupOptions : localItems"
        :value="value"
        :placeholder="placeholderText"
        :select-label="selectLabel"
        :selected-label="selectedLabel"
        :deselect-label="deselectLabel"
        :show-labels="showLabels"
        :track-by="isStringItems ? undefined : itemValue"
        :label="isStringItems ? undefined : itemText"
        :disabled="disabled || loading"
        :multiple="multiple"
        :internal-search="internalSearch"
        :close-on-select="closeOnSelect"
        :group-select="allowSelectAll"
        :group-label="allowSelectAll ? 'label' : ''"
        :group-values="allowSelectAll ? 'values' : ''"
        :loading="isPreloaderShown"
        :allow-empty="!canCreateNewValue && allowEmpty"
        @input="$emit('input', formatNewValue($event))"
        @change="$emit('change', formatNewValue($event))"
        @close="handleClose"
        @remove="clearValue"
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
import Multiselect from 'vue-multiselect';
import {
  isString,
  isObject,
  isEmpty,
} from 'chober';
import formMixin from '../../mixins/formMixin';

export default {
  name: 'ASelect',

  components: {
    Multiselect,
  },

  mixins: [
    formMixin,
  ],

  props: {
    value: {
      type: [String, Number, Array, Object],
      default: '',
    },

    itemText: {
      type: String,
      default: 'name',
    },

    itemValue: {
      type: String,
      default: 'id',
    },

    label: {
      type: String,
      default: '',
    },

    name: {
      type: String,
      default: '',
    },

    items: {
      type: Array,
      default: () => [],
    },

    placeholder: {
      type: String,
      default: 'List selection',
    },

    noResult: {
      type: String,
      default: 'Not found',
    },

    noOptions: {
      type: String,
      default: 'The list is empty',
    },

    selectLabel: {
      type: String,
      default: '',
    },

    selectedLabel: {
      type: String,
      default: '',
    },

    deselectLabel: {
      type: String,
      default: '',
    },

    hint: {
      type: String,
      default: null,
    },

    disabled: {
      type: Boolean,
      default: false,
    },

    loading: {
      type: Boolean,
      default: false,
    },

    showLabels: {
      type: Boolean,
      default: false,
    },

    multiple: {
      type: Boolean,
      default: false,
    },

    closeOnSelect: {
      type: Boolean,
      default: true,
    },

    allowSelectAll: {
      type: Boolean,
      default: false,
    },

    internalSearch: {
      type: Boolean,
      default: false,
    },

    errorMessages: {
      type: Array,
      default: () => [],
    },

    successMessages: {
      type: Array,
      default: () => [],
    },

    route: {
      type: String,
      default: null,
    },

    routeRequestProp: {
      type: String,
      default: 'search',
    },

    routeResponseProp: {
      type: String,
      default: null,
    },

    thresholdLimit: {
      type: Number,
      default: 2,
    },

    canCreateNewValue: {
      type: Boolean,
      default: false,
    },

    allowEmpty: {
      type: Boolean,
      default: true,
    },

    isNeedClearOnClose: {
      type: Boolean,
      default: false,
    },
  },

  data: () => ({
    localValue: '',
    localItems: [],
    isPreloaderShown: false,
    previousRequest: null,
    requestTimer: null,
    searchStatusText: '',
  }),

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

    isStringItems() {
      return this.localItems.length !== 0 && isString(this.localItems[0]);
    },

    isObjectItems() {
      return this.localItems.length !== 0 && isObject(this.localItems[0]);
    },

    groupOptions() {
      return [{
        label: 'All',
        values: this.localItems,
      }];
    },

    placeholderText() {
      if (this.loading || this.localItems.length !== 0) return this.placeholder;

      return this.noResult;
    },
  },

  watch: {
    value(value) {
      this.localValue = this.formatValue(value);
    },

    items(items) {
      this.localItems = this.formatItems(items);
      this.localValue = this.formatValue(this.value);
      this.checkValueAvailability();
    },
  },

  created() {
    this.localItems = this.formatItems(this.items);
    this.localValue = this.formatValue(this.value);
  },

  methods: {
    async clearValue() {
      await this.$nextTick();
      await this.$nextTick();

      if (isEmpty(this.value)) {
        if (this.multiple) {
          this.localValue = [];
          this.$emit('input', []);
        } else {
          this.localValue = null;
          this.$emit('input', null);
        }
      }
    },

    handleClose() {
      if (this.isNeedClearOnClose && this.isStringItems) {
        this.localItems = this.formatItems(this.items);
        this.localValue = this.formatValue(this.value);
      }
    },

    formatNewValue(value) {
      if (value === null) {
        return null;
      }

      if (this.isObjectItems) {
        if (this.multiple) {
          return value.map((item) => item[this.itemValue]);
        }

        return value[this.itemValue];
      }

      return value;
    },

    checkValueAvailability() {
      if (this.isObjectItems) {
        const itemKeys = Object.keys(this.localItems[0]);
        const isExistValueAndText = itemKeys.includes(this.itemValue)
          && itemKeys.includes(this.itemText);

        if (!isExistValueAndText) {
          throw new Error('Not found [item-text] or [item-value] props in items.');
        }

        if (
          this.canCreateNewValue
            && !this.items.map((item) => item[this.itemValue]).includes(this.value)
        ) {
          this.clearValue();
        }
      }
    },

    formatValue(value) {
      if ((this.isStringItems && !this.multiple) || value === null) {
        return value;
      }

      if (this.isObjectItems) {
        if (this.multiple) {
          return this.localItems
            .map((item) => (
              value.includes(item[this.itemValue])
              || value.includes(Number(item[this.itemValue]))
                ? item
                : null
            ))
            .filter((item) => item);
        }

        return this.localItems
          .find((item) => item[this.itemValue] === value || item[this.itemValue] === Number(value));
      }

      if (this.multiple) {
        return [];
      }

      return '';
    },

    mergeItems(itemsToFilter, itemsToSave) {
      const filteredItemsToFilter = itemsToFilter
        .filter((item) => itemsToSave
          .every((itemToSave) => itemToSave[this.itemValue] !== item[this.itemValue]));

      return [...filteredItemsToFilter, ...itemsToSave];
    },

    formatItems(items) {
      if (this.isObjectItems) {
        return items.map((item) => ({ ...item, $isDisabled: item.disabled }));
      }

      return items;
    },
  },
};
</script>

<style lang="scss">
@import "@design";

@mixin input {
  font-family: inherit;
  font-size: 14px;
  touch-action: manipulation;
}

.multiselect {
  @include input;

  $self: &;

  display: block;
  position: relative;
  width: 100%;
  text-align: left;
  outline: none;
  color: $charcoal-grey;

  fieldset[disabled] & {
    pointer-events: none;
  }

  &--disabled {
    pointer-events: none;
    opacity: 0.6;

    #{$self}__current,
    #{$self}__select {
      color: #a6a6a6;
    }
  }

  &--active {
    z-index: 50;

    #{$self}__select {
      transform: rotateZ(180deg);
    }

    #{$self}__placeholder {
      display: none;
    }

    #{$self}__input {
      // Remove inline styles
      width: 100% !important; // stylelint-disable-line declaration-no-important
    }
  }

  &--above {
    #{$self}__content-wrapper {
      bottom: 100%;
    }
  }

  &__input {
    @include placeholder;

    background-color: transparent;
    border: 0;
  }

  &__single {
    padding-right: 5px;
    margin-bottom: 8px;
  }

  &__input,
  &__single {
    @include input;

    &:hover {
      border-color: #cfcfcf;
    }

    &:focus {
      border-color: #a8a8a8;
      outline: none;
    }
  }

  &__tags-wrap {
    display: inline;
  }

  &__tags {
    @include field;

    .g-field--error & {
      border-color: $light-burgundy;
    }

    .g-field--success & {
      border-color: $boring-green;
    }

    padding: 5px 30px 5px 16px;
    height: auto;
  }

  &__tag-icon {
    $size: 18px;

    cursor: pointer;
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    font-weight: 700;
    font-style: initial;
    width: $size;
    text-align: center;
    line-height: $size;
    transition: all 0.2s ease;
    border-radius: 3px;

    &::after {
      content: "×";
      color: $charcoal-grey;
      font-size: 14px;
    }

    &:focus,
    &:hover {
      background: rgba(#000, 0.1);

      &::after {
        color: #fff;
      }
    }
  }

  &__tag {
    ~ #{$self}__input,
    ~ #{$self}__single {
      width: auto;
    }

    position: relative;
    display: inline-block;
    vertical-align: middle;
    padding: 2px 20px 2px 10px;
    margin: 0 2px 2px 0;
    line-height: 1;
    font-size: 12px;
    border-radius: 3px;
    background: rgba($slime-green, 0.4);
    white-space: nowrap;
    overflow: hidden;
    max-width: 100%;
    text-overflow: ellipsis;
  }

  &__current {
    line-height: 14px;
    min-height: 40px;
    display: block;
    overflow: hidden;
    padding: 8px 12px 0;
    padding-right: 30px;
    white-space: nowrap;
    margin: 0;
    text-decoration: none;
    border-radius: 5px;
    border: 1px solid #e8e8e8;
    cursor: pointer;
  }

  &__select {
    line-height: 14px;
    display: block;
    position: absolute;
    z-index: 6;
    width: 40px;
    height: $default-input-height;
    right: 1px;
    top: 1px;
    margin: 0;
    text-decoration: none;
    text-align: center;
    cursor: pointer;
    transition: transform 0.2s ease;

    &::before {
      content: "";
      position: absolute;
      z-index: 11;
      right: 15px;
      top: 8px;
      background: url("../../images/dropdown.svg") 0/cover;
      width: 8px;
      height: 14px;
    }

    #{$self}--active & {
      &::before {
        top: 10px;
        right: 17px;
      }
    }
  }

  &__placeholder {
    display: block;
    padding-right: 6px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: $placeholder-color;
  }

  &__content-wrapper {
    position: absolute;
    display: block;
    background: #fff;
    width: 100%;
    max-height: 240px;
    overflow: auto;
    border: 1px solid #e8e8e8;
    border-radius: 3px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.24);
    z-index: 50;
    -webkit-overflow-scrolling: touch;
  }

  &__content {
    list-style: none;
    display: inline-block;
    padding: 0;
    margin: 0;
    min-width: 100%;
    max-width: 100%;
    vertical-align: top;

    &::webkit-scrollbar { // stylelint-disable-line selector-pseudo-element-no-unknown
      display: none;
    }
  }

  &__element {
    display: block;
  }

  &__option {
    position: relative;
    color: $charcoal-grey;
    display: block;
    padding: 7px 16px;
    text-decoration: none;
    text-transform: none;
    line-height: 1.2;
    cursor: pointer;

    &::after {
      top: 0;
      right: 0;
      position: absolute;
      line-height: 32px;
      padding-right: 12px;
      padding-left: 20px;
      font-size: 12px;
    }

    &--highlight {
      background: rgba(#7e7e7e, 0.16);
      outline: none;

      &::after {
        content: attr(data-select);
        background: rgba($slime-green, 0.16);
      }

      &#{$self}__option--group,
      &#{$self}__option--group#{$self}__option--group-selected {
        background: rgba($slime-green, 0.32);
      }

      &#{$self}__option--group#{$self}__option--group-selected {
        color: #35495e;
      }
    }

    &--selected {
      font-weight: 700;

      &::after {
        content: attr(data-selected);
        color: #c0c0c0;
      }
    }

    &--disabled {
      background: #ededed;
      color: #a6a6a6;
      cursor: text;
      pointer-events: none;

      &#{$self}__option--highlight {
        background: #dedede;
      }
    }

    &--group {
      background: #ededed;
      color: #35495e;

      #{$self}__option--highlight {
        background: #35495e;
        color: #fff;

        &::after {
          background: #35495e;
        }
      }
    }

    &--group-selected {
      &#{$self}__option--highlight {
        background: #ff6a6a;
        color: #fff;

        &::after {
          background: #ff6a6a;
          content: attr(data-deselect);
          color: #fff;
        }
      }
    }
  }

  &__spinner {
    position: absolute;
    right: 1px;
    top: 1px;
    width: 48px;
    height: 30px;
    background: #fff;
    display: block;

    &::before,
    &::after {
      position: absolute;
      content: "";
      top: 50%;
      left: 50%;
      margin: -8px 0 0 -8px;
      width: 14px;
      height: 14px;
      border-radius: 100%;
      border-color: #41b883 transparent transparent;
      border-style: solid;
      border-width: 2px;
      box-shadow: 0 0 0 1px transparent;
    }

    &::before {
      animation: spinning 2.4s cubic-bezier(0.41, 0.26, 0.2, 0.62);
      animation-iteration-count: infinite;
    }

    &::after {
      animation: spinning 2.4s cubic-bezier(0.51, 0.09, 0.21, 0.8);
      animation-iteration-count: infinite;
    }
  }

  &__loading-enter-active,
  &__loading-leave-active {
    transition: opacity 0.4s ease-in-out;
    opacity: 1;
  }

  &__loading-enter,
  &__loading-leave-active {
    opacity: 0;
  }
}

.multiselect-enter-active,
.multiselect-leave-active {
  transition: all 0.15s ease;
}

.multiselect-enter,
.multiselect-leave-active {
  opacity: 0;
}

.multiselect__strong {
  margin-bottom: 8px;
  line-height: 20px;
  display: inline-block;
  vertical-align: top;
}

@keyframes spinning {
  from {
    transform: rotate(0);
  }

  to {
    transform: rotate(2turn);
  }
}
</style>
