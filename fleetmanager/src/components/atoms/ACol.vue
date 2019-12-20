<template>
  <div :class="classes" class="col">
    <slot />
  </div>
</template>

<script>
import UIMixin from '../../mixins/UIMixin';

const MAX_COL_NUMBER = 12;

const validator = (number) => {
  const i = Number(number);

  return (
    (Number.isInteger(i) && number >= 0 && number <= MAX_COL_NUMBER) || 'auto'
  );
};

const props = {
  firstXs: {
    type: Boolean,
    default: false,
  },
  lastXs: {
    type: Boolean,
    default: false,
  },
  firstSm: {
    type: Boolean,
    default: false,
  },
  lastSm: {
    type: Boolean,
    default: false,
  },
  firstMd: {
    type: Boolean,
    default: false,
  },
  lastMd: {
    type: Boolean,
    default: false,
  },
  firstLg: {
    type: Boolean,
    default: false,
  },
  lastLg: {
    type: Boolean,
    default: false,
  },
  xsOffset: {
    type: String,
    validator,
  },
  smOffset: {
    type: String,
    validator,
  },
  mdOffset: {
    type: String,
    validator,
  },
  lgOffset: {
    type: String,
    validator,
  },
  xs: {
    type: String,
    validator,
  },
  sm: {
    type: String,
    validator,
  },
  md: {
    type: String,
    validator,
  },
  lg: {
    type: String,
    validator,
  },
  xl: {
    type: String,
    validator,
  },
};

export default {
  name: 'CCol',

  mixins: [UIMixin],

  props,

  computed: {
    classes() {
      const boolProps = Object.keys(props)
        .filter((key) => props[key].type === Boolean)
        .filter((key) => this.$props[key]);
      const stringProps = Object.keys(props)
        .filter((key) => props[key].type === String)
        .filter((key) => this.$props[key]);

      return [
        ...boolProps.map((prop) => this.dashCase(prop)),
        ...stringProps.map((prop) => {
          switch (this.$props[prop]) {
            case 'auto':
              return `col-${this.dashCase(prop)}`;
            case 'none':
              return `col-${this.dashCase(prop)}-none`;
            default:
              return `col-${this.dashCase(prop)}-${this.$props[prop]}`;
          }
        }),
      ];
    },
  },
};
</script>
