<template>
  <div :class="classes" class="g-flex">
    <slot />
  </div>
</template>

<script>
import UIMixin from '../../mixins/UIMixin';

const props = {
  reverse: {
    type: Boolean,
    default: false,
  },
  row: {
    type: Boolean,
    default: false,
  },
  column: {
    type: Boolean,
    default: false,
  },
  startXs: {
    type: Boolean,
    default: false,
  },
  centerXs: {
    type: Boolean,
    default: false,
  },
  endXs: {
    type: Boolean,
    default: false,
  },
  topXs: {
    type: Boolean,
    default: false,
  },
  middleXs: {
    type: Boolean,
    default: false,
  },
  bottomXs: {
    type: Boolean,
    default: false,
  },
  aroundXs: {
    type: Boolean,
    default: false,
  },
  betweenXs: {
    type: Boolean,
    default: false,
  },
  nowrapXs: {
    type: Boolean,
    default: false,
  },
  startSm: {
    type: Boolean,
    default: false,
  },
  centerSm: {
    type: Boolean,
    default: false,
  },
  endSm: {
    type: Boolean,
    default: false,
  },
  topSm: {
    type: Boolean,
    default: false,
  },
  middleSm: {
    type: Boolean,
    default: false,
  },
  bottomSm: {
    type: Boolean,
    default: false,
  },
  aroundSm: {
    type: Boolean,
    default: false,
  },
  betweenSm: {
    type: Boolean,
    default: false,
  },
  nowrapSm: {
    type: Boolean,
    default: false,
  },
  startMd: {
    type: Boolean,
    default: false,
  },
  centerMd: {
    type: Boolean,
    default: false,
  },
  endMd: {
    type: Boolean,
    default: false,
  },
  topMd: {
    type: Boolean,
    default: false,
  },
  middleMd: {
    type: Boolean,
    default: false,
  },
  bottomMd: {
    type: Boolean,
    default: false,
  },
  aroundMd: {
    type: Boolean,
    default: false,
  },
  betweenMd: {
    type: Boolean,
    default: false,
  },
  nowrapMd: {
    type: Boolean,
    default: false,
  },
  startLg: {
    type: Boolean,
    default: false,
  },
  centerLg: {
    type: Boolean,
    default: false,
  },
  endLg: {
    type: Boolean,
    default: false,
  },
  topLg: {
    type: Boolean,
    default: false,
  },
  middleLg: {
    type: Boolean,
    default: false,
  },
  bottomLg: {
    type: Boolean,
    default: false,
  },
  aroundLg: {
    type: Boolean,
    default: false,
  },
  betweenLg: {
    type: Boolean,
    default: false,
  },
  nowrapLg: {
    type: Boolean,
    default: false,
  },
};

export default {
  name: 'AFlex',

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
        ...stringProps.map((prop) => `col-${prop}-${this.$props[prop]}`),
      ];
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@design";
</style>
