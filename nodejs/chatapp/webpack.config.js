const CopyPlugin = require('copy-webpack-plugin');
const HtmlWebPackPlugin = require ('html-webpack-plugin');
const MiniCssExtractPlugin = require ("mini-css-extract-plugin");
var webpack = require('webpack');

module.exports = {

    mode: 'development',
    output: {
        clean: true
    },
    module: {

        rules: [
            {
                test: /\.html$/,
                loader: 'html-loader',
                options:{
                minimize: true,
                }
            },
            {
            test: /\.(png|jpe?g|gif)$/i,
            loader: 'file-loader',
            options: {
                name: 'img/[name].[ext]'
                }
            },
            {
                test: /\.css$/i,
                exclude: /styles.css$/,
                use: ["style-loader","css-loader"],
            },
            {
                test: /styles.css$/,
                use: [MiniCssExtractPlugin.loader, "css-loader"],
            }
        ]
    },
    plugins: [

        new webpack.ProvidePlugin({
            $:'jquery',
            JQuery:'jquery'
        }),
        new HtmlWebPackPlugin ({
            template: './src/index.html',
            filename: './index.html'
        }),
        new MiniCssExtractPlugin({
            filename: 'nou-estil.css',
            ignoreOrder: false
        }),
        new CopyPlugin({
            patterns: [
                { from: "src/assets", to: "./assets" },

            ],
        }),
    ]
}