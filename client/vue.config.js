const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  configureWebpack: {
    devServer: {
      historyApiFallback: true
    }
  },
  transpileDependencies: [
    'vuetify'
  ],
})
