// webpack.config.prod.js
'use strict';

const path = require('path');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

const distPath = path.resolve(__dirname, '../../public/');

module.exports = {
    mode: 'production',
    entry: path.resolve(__dirname, 'main.js'),
    output: {
        path: path.resolve(distPath, 'app'),
        filename: 'bundle.js',
        publicPath: "/app/"
    },
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        plugins: ["transform-object-rest-spread", "transform-runtime"]
                    }
                }
            },
            {
                test: /\.css$/,
                use: [
                    'vue-style-loader',
                    'css-loader'
                ]
            },
            {
                test: /\.sass$/,
                use: [
                    'vue-style-loader',
                    'css-loader',
                    'sass-loader'
                ]
            }
        ]
    },
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.esm.js'
        },
        extensions: ['*', '.js', '.json', '.vue'],
    },
    plugins: [
        new VueLoaderPlugin()
    ]
}