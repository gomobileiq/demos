const { aliases } = require('./aliases.config');

module.exports = {
  lintOnSave: false,
  configureWebpack: {
    // Set up all the aliases we use in our app.
    resolve: {
      alias: {
        ...{ vue$: 'vue/dist/vue.esm.js' }, // Resolving the vue var for standalone build,
        ...aliases,
      },
    },
  },
  css: {
    // Enable CSS source maps.
    sourceMap: true,
  },
  publicPath: '',
  devServer: {
    // open: true,
    // eslint-disable-next-line global-require
    // before: require('./_mock-api'),
  },
};
