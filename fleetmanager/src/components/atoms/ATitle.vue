<template>
  <div
    :is="tagName"
    class="c-title"
    :class="{
      'c-title--h1': tagName === 'h1',
      'c-title--inline': inline,
      'c-title--text': text && !caption,
      'c-title--caption': caption,
      'c-title--subheader': subheader,
      [`c-title--${colorText}`]: colorText,
    }"
    :title="isTitleShown ? title : undefined"
  >
    <slot />
  </div>
</template>

<script>
export default {
  name: 'ATitle',

  props: {
    inline: {
      type: Boolean,
      default: false,
    },

    h1: {
      type: Boolean,
      default: false,
    },

    h2: {
      type: Boolean,
      default: false,
    },

    h3: {
      type: Boolean,
      default: false,
    },

    h4: {
      type: Boolean,
      default: false,
    },

    subheader: {
      type: Boolean,
      default: false,
    },

    regular: {
      type: Boolean,
      default: false,
    },

    color: {
      type: String,
      default: '',
    },

    text: {
      type: Boolean,
      default: false,
    },

    caption: {
      type: Boolean,
      default: false,
    },

    isTitleShown: {
      type: Boolean,
      default: true,
    },
  },

  computed: {
    tagName() {
      if (this.h1) return 'h1';
      if (this.h2) return 'h2';
      if (this.h3) return 'h3';
      if (this.h4) return 'h4';
      return 'div';
    },

    colorText() {
      switch (this.color) {
        case 'secondary':
          return 'secondary';
        case 'hint':
          return 'hint';
        case 'error':
          return 'error';
        default:
          return '';
      }
    },

    title() {
      return this.$slots.default[0].text.trim();
    },
  },
};
</script>

<style lang="scss">
@import "@design";

.c-title {
  $self: &;

  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;

  &--h1 {
    margin: 24px 0;
  }

  &--inline {
    display: inline;
  }

  &--block {
    display: block;
  }

  &--error {
    color: $light-burgundy;
  }

  &--text {
    font-size: 14px;
  }

  &--caption {
    font-size: 12px;
  }

  &--subheader {
    font-weight: 500;
  }

  &--secondary {
    color: rgba($charcoal-grey, 0.5);
  }

  &--hint {
    color: rgba($charcoal-grey, 0.4);
  }
}
</style>
