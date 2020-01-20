const path = require('path');

const resolve = (dir) => path.join(__dirname, dir);
const aliases = {
  '@atoms': resolve('src/components/atoms'),
  '@molecules': resolve('src/components/molecules'),
  '@organisms': resolve('src/components/organisms'),
  '@templates': resolve('src/components/templates'),
  '@pages': resolve('src/components/pages'),
  '@assets': resolve('src/assets'),
  '@router': resolve('src/router'),
  '@design': resolve('src/design/index.scss'),
  '@utils': resolve('src/utils'),
  '@state': resolve('src/state'),
  '@components': resolve('src/components'),
  '@images': resolve('src/images'),
  '@api': resolve('src/api'),
};
module.exports = {
  aliases,
};
