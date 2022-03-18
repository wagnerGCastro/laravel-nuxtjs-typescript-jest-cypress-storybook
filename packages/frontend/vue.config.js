
const webpack = require('webpack')


console.log('Use env: ', process.env.NODE_ENV)
console.log('Base url: ', process.env.VUE_APP_BASE_URL)
console.log('APP run port: ', process.env.VUE_APP_PORT)

/**
 * Global CLI Config
 * https://cli.vuejs.org/config/#lintonsave
 */
module.exports = {
  pages: {
    index: {
      // entry for the page
      entry: 'src/main.js',
      // the source template
      // template: 'public/index.html',
      // output as dist/index.html
      // filename: 'index.html',
      // when using title option,
      // template title tag needs to be <title><%= htmlWebpackPlugin.options.title %></title>
      // title: 'Index Page'
      // chunks to include on this page, by default includes
      // extracted common chunks and vendor chunks.
      // chunks: ['chunk-vendors', 'chunk-common', 'index']
    }
  },

  configureWebpack: {
    plugins: [
      new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
    ]
  },

  pluginOptions: {
    i18n: {
      locale: 'en',
      fallbackLocale: 'en',
      localeDir: 'locales',
      enableInSFC: false
    },
    'resolve-alias': {
      alias: {
        '~': './',
        '@': './src'
      }
    }
  }
}
