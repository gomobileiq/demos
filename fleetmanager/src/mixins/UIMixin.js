import Typograf from 'typograf';
import { formatNumber } from 'chober';

const typografInstance = new Typograf({ locale: ['ru', 'en-US'] });
const typografText = (value) => (value ? typografInstance.execute(value.toString()) : '');

export default {
  data: () => ({
    isPreloaderShown: false,
    digitsRegex: /\d\.{0,1}/,
  }),

  patterns: {
    letters: /[а-яёa-z]/i,
    numbers: /^([0-9 ,.]{0,10}?)$/,
    numbersNoComma: /^([0-9 .]{0,10}?)$/,
    digits: /^([0-9]{0,10}?)$/,
  },

  filters: {
    formatNumber,

    formatPhone(phone) {
      return phone
        ? phone.replace(/(\d{3})(\d{3})(\d{2})(\d{2})/, '($1) $2-$3-$4')
        : '';
    },

    typograf(value) {
      return typografText(value);
    },

    fixed(value, amount = 1) {
      const number = Number(value);

      return number.toFixed(Number.isInteger(number) ? 0 : amount);
    },
  },

  methods: {
    typografText,

    getTotal(array, param) {
      return Math.round(array.reduce((acc, item) => acc + item[param], 0));
    },

    showPreloader(variableName = 'isPreloaderShown') {
      this[variableName] = true;
    },

    hidePreloader(variableName = 'isPreloaderShown') {
      this[variableName] = false;
    },

    changeComa(variable = '') {
      const varArray = variable.split('.');

      if (varArray.length === 1) {
        this[varArray[0]] = this[varArray[0]].replace(',', '.');
      } else if (varArray.length === 2) {
        this[varArray[0]][varArray[1]] = this[varArray[0]][varArray[1]].replace(
          ',',
          '.',
        );
      }
    },

    dashCase(string) {
      return string.replace(/[A-Z]/g, (m) => `-${m.toLowerCase()}`);
    },

    triggerWindow(eventName) {
      window.dispatchEvent(new Event(eventName));
    },
  },
};
