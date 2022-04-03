/* eslint-disable @typescript-eslint/no-var-requires */

const webpack = require('webpack')
const path = require('path')

const rootDirDocker = path.join(__dirname, '../..', '.docker')
const rootDirHusky = path.join(__dirname, '../..', '.husky')
const rootDirNodeModules = path.join(__dirname, '../..', 'node_modules')

console.log(`🚀 Server started at http://localhost:${process.env.VUE_APP_PORT}`)
console.log(`🚨️ Environment: ${process.env.NODE_ENV}`)

/**
 * Global CLI Config
 * https://cli.vuejs.org/config/#lintonsave
 */
module.exports = {
  pages: {
    index: {
      /**  entry for the page */
      entry: 'src/main.js',
      /** the source template */
      template: 'public/index.html',
      /** output as dist/index.html */
      filename: 'index.html',
      /**
       * when using title option,
       * template title tag needs to be <title><%= htmlWebpackPlugin.options.title %></title>
       */
      title: 'Index Page',
      /**
       *  chunks to include on this page, by default includes
       * extracted common chunks and vendor chunks.
       */
      chunks: ['chunk-vendors', 'chunk-common', 'index']
    }
  },

  devServer: {
    open: process.platform === 'darwin',
    host: '0.0.0.0',
    port: process.env.VUE_APP_PORT || 8041, // CHANGE YOUR PORT HERE!
    https: process.env.VUE_APP_HTTPS || false,
    hotOnly: process.env.VUE_APP_HOT_ONLY || false,
    watchOptions: {
      ignored: [/node_modules/, /public/, /.vscode/, /dist/, rootDirDocker, rootDirHusky, rootDirNodeModules]
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
