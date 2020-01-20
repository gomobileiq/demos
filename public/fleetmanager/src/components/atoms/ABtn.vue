<template>
  <Component
    :is="isButton ? 'button' : 'a'"
    class="c-btn"
    :type="isButton ? type : undefined"
    :class="{
      [`c-btn--${colorText}`]: colorText,
      'c-btn--without-text': hasText($slots.default),
      'c-btn--disabled': disabled,
      'c-btn--transparent': transparent,
      'c-btn--outline': outline,
      'c-btn--loading': loading,
      'c-btn--link': link,
      'c-btn--transparent-hover': transparentHover,
      'c-btn--secondary-action': secondaryAction
    }"
    :target="target || undefined"
    :href="href || undefined"
    :disabled="(isButton ? disabled : undefined) || loading"
    @click="$emit('click')"
  >
    <Transition name="g-fade">
      <CPreloader :color="preloaderColor" size="20" v-if="loading" />
    </Transition>
    <slot />
  </Component>
</template>

<script>
export default {
  name: 'CBtn',

  props: {
    color: {
      type: String,
      default: 'green',
    },

    href: {
      type: String,
      default: '',
    },

    icon: {
      type: String,
      default: '',
    },

    target: {
      type: String,
      default: '',
    },

    iconImage: {
      type: String,
      default: '',
    },

    iconHover: {
      type: String,
      default: '',
    },

    type: {
      type: String,
      default: 'button',
    },

    disabled: {
      type: Boolean,
      default: false,
    },

    secondaryAction: {
      type: Boolean,
      default: false,
    },

    transparent: {
      type: Boolean,
      default: false,
    },

    transparentHover: {
      type: Boolean,
      default: false,
    },

    loading: {
      type: Boolean,
      default: false,
    },

    link: {
      type: Boolean,
      default: false,
    },

    iconWidth: {
      type: [String, Number],
      default: null,
    },

    iconHeight: {
      type: [String, Number],
      default: null,
    },

    outline: {
      type: String,
      default: '',
    },
  },

  computed: {
    isButton() {
      return this.href === '';
    },

    colorText() {
      switch (this.color) {
        case 'green':
          return 'green';
        case 'red':
          return 'red';
        case 'white':
          return 'white';
        case 'dark':
          return 'dark';
        case 'grey':
          return 'grey';
        case 'dark-grey':
          return 'dark-grey';
        case 'blue':
          return 'blue';
        case 'fiery':
          return 'fiery';
        default:
          return '';
      }
    },

    preloaderColor() {
      if (this.transparent) return '';

      switch (this.color) {
        case 'grey':
          return 'white';
        case 'blue':
          return 'blue';
        default:
          return 'white';
      }
    },
  },

  methods: {
    hasText(slot) {
      return slot === undefined || slot[0].text.trim() === '';
    },
  },
};
</script>

<style lang="scss">
@import "@design";

@mixin pseudoClasses {
  &:hover:not([disabled]),
  &:active:not([disabled]) {
    @content;
  }
}

$colors: (
  "green": $true-green,
  "red": $light-burgundy,
  "dark": $charcoal-grey,
  "blue": $blue-link,
  "dark-grey": $dark-grey,
  "grey": $pale-blue,
  "fiery": $fiery
);

.c-btn {
  $self: &;

  position: relative;
  display: inline-flex;
  align-items: center;
  border: 0;
  border-radius: 3px;
  padding: 5px 16px;
  height: $default-input-height;
  font-weight: 500;
  outline: none;
  text-decoration: none;
  transition: all 0.15s ease;
  transition-property: background-color, color;
  color: #fff;
  cursor: pointer;

  @each $btn-name, $btn-color in $colors {
    &--#{$btn-name} {
      background-color: $btn-color;

      @include pseudoClasses {
        background-color: darken($btn-color, 10%);
      }

      &#{$self}--transparent {
        color: $btn-color;
        background-color: transparent;

        &:hover {
          @include pseudoClasses {
            color: darken($btn-color, 10%);
          }
        }
      }

      &#{$self}--transparent-hover {
        color: $charcoal-grey;
        background-color: transparent;
      }
    }
  }

  &--disabled {
    background-color: $black-16;
    cursor: default;
  }

  &--secondary-action {
    color: $charcoal-grey;
    font-weight: 500;
    border: 1px solid $pale-blue;
    background-color: #fff;

    &:hover:not([disabled]) {
      background-color: $pale-blue;
    }
  }

  &--white {
    background-color: #fff;
    color: $charcoal-grey;

    @include pseudoClasses() {
      background-color: $black-16;
    }

    &--disabled {
      background-color: #fff;
      color: rgba($charcoal-grey, 0.4);
    }
  }

  &--outline {
    border: 1px solid $blue;
    background-color: #fff;
    color: $blue;

    @include pseudoClasses() {
      background-color: $blue;
      color: #fff;
    }
  }

  &--transparent,
  &--link {
    padding-left: 0;
    padding-right: 0;
    background: none;
    color: $charcoal-grey;

    @include pseudoClasses {
      background: none;
    }

    &--disabled {
      color: rgba($charcoal-grey, 0.4);
    }
  }

  &--link {
    position: relative;

    &--disabled {
      &::before {
        border-color: rgba($charcoal-grey, 0.4);
      }
    }

    &::before {
      content: "";
      position: absolute;
      bottom: 5px;
      left: 0;
      right: 0;
      height: 0;
      border-top: 1px dashed $charcoal-grey;
    }

    @include pseudoClasses {
      color: $true-green;

      &::before {
        border-top: 1px dashed $true-green;
      }
    }
  }

  &--without-text {
    justify-content: center;
    padding: 0;
    width: $default-input-height;
    height: $default-input-height;
  }

  &--loading {
    color: rgba(#fff, 0);
  }

  &__icon {
    max-height: 20px;
    margin-right: 10px;
    transition: opacity 0.3s ease;

    &--without-text {
      margin-right: 0;
      max-width: 20px;
    }

    &--loading {
      opacity: 0;
    }

    #{$self}--white[disabled] & {
      opacity: 0.4;
    }

    #{$self}--transparent#{$self}--disabled &,
    #{$self}--link#{$self}--disabled & {
      opacity: 0.6;
    }
  }

  .c-preloader {
    position: absolute;
    top: calc(50% - 10px);
    left: calc(50% - 10px);
  }
}
</style>
