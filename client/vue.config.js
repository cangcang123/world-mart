const webpack = require('webpack')
const WebpackBar = require('webpackbar')

module.exports = {
    assetsDir: 'assets',
    productionSourceMap: false,

    outputDir: process.env.BUILD_OUTPUT_DIR || 'dist',
    publicPath: process.env.BUILD_PUBLIC_PATH || '/',
    configureWebpack: {
        plugins: [
            new webpack.NormalModuleReplacementPlugin(/element-ui[\/\\]lib[\/\\]locale[\/\\]lang[\/\\]zh-CN/, 'element-ui/lib/locale/lang/en'),
            new WebpackBar({
                color: '#2d077d'
            })
        ],
    },

    chainWebpack: config => {
        config.module
            .rule('vue')
            .use('vue-loader')
            .loader('vue-loader')
            .tap(options => {
                options.compilerOptions.preserveWhitespace = true;
                return options
            })
            .tap(options => {
                options.transformAssetUrls = {
                    img: 'src',
                    image: 'xlink:href',
                    'b-img': 'src',
                    'b-img-lazy': ['src', 'blank-src'],
                    'b-card': 'img-src',
                    'b-card-img': 'src',
                    'b-card-img-lazy': ['src', 'blank-src'],
                    'b-carousel-slide': 'img-src',
                    'b-embed': 'src'
                }
                return options
            })
    },

    runtimeCompiler: false
}