const HtmlWebpackPlugin = require ('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyPlugin = require('copy-webpack-plugin');
const webpack = require('webpack');

module.exports = {

    mode: "development",
    output: {
        clean:true
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
                test: /\.css$/i,
                exclude: /styles.css$/,
                use: ["style-loader","css-loader"],
            },
            {
                test: /styles.css$/,
                use: [MiniCssExtractPlugin.loader, "css-loader"],

            },
            {
                test: /\.(png|jpe?g|gif)$/i,
                loader: 'file-loader',
                options: {
                    name: 'img/[name].[ext]'
                }

            }
        ]
    },   
    plugins: [
        new webpack.ProvidePlugin({
            $:'jquery',
            JQuery:'jquery'
        }),
        new HtmlWebpackPlugin({
            template: './src/index.html',
            filename: './index.html'
        }),
        new MiniCssExtractPlugin({
            filename: '[name].css',
            ignoreOrder: false
        }),
        new CopyPlugin({
            patterns: [
                { from: "src/assets", to: "./assets" },
            ]
        })
    ]
    


}