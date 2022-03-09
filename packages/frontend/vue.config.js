const webpack = require('webpack')
const path = require('path')
const resolve = dir => require('path').join(__dirname, dir)

console.log('Use env: ', process.env.NODE_ENV)
console.log('Base url: ', process.env.VUE_APP_BASE_URL)
console.log('APP run port: ', process.env.VUE_APP_PORT)

module.exports = {
  lintOnSave: false,
  publicPath: process.env.NODE_ENV === 'production'
    ? process.env.VUE_APP_BASE_URL
    : '/',

  devServer: {
    open: process.platform === 'darwin',
    host: '0.0.0.0',
    port: process.env.VUE_APP_PORT || 8041, // CHANGE YOUR PORT HERE!
    https: false,
    hotOnly: false
  },

  configureWebpack: {
    plugins: [
      new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
    ],
    resolve: {
      alias: {
        vue$: 'vue/dist/vue.common.js',
        '~': path.resolve(__dirname, './'),
        '@': path.resolve(__dirname, './src/')
      }
    }
  },

  pluginOptions: {
    i18n: {
      locale: 'en',
      fallbackLocale: 'en',
      localeDir: 'locales',
      enableInSFC: false
    }
  },
  chainWebpack: config => {
    config.resolve.alias.set('@', resolve('src'))
  }
}
