var webpack = require('webpack');
var path = require('path');
var ExtractTextPlugin = require("extract-text-webpack-plugin");
var OptimizeCssAssetsPlugin = require("optimize-css-assets-webpack-plugin");
var inProduction = process.env.NODE_ENV === 'production';

module.exports = {
	context: __dirname,
	entry: {
		'iris.js': './assets/js/main.js',
		'iris.min.js': './assets/js/main.js',
		'iris.css': './assets/scss/app.scss',
		'iris.min.css': './assets/scss/app.scss'
	},
	output: {
		path: path.resolve(__dirname, './dist'),
		filename: '[name]'
	},
	module: {
		rules: [
			{
				test: /\.scss$/,
				use: ExtractTextPlugin.extract({
					fallback: "style-loader",
					use: ["css-loader", "sass-loader"]
				})
			},
			{
				test: /\.(png|jpe?g|gif|svg|eot|ttf|woff|woff2)$/,
				loader: "file-loader",
				options: {
					name: 'images/[name].[ext]'
				}
			},
			{
				test: /\.js$/,
				exclude: /node_modules/,
				loader: "babel-loader"
			}
		]
	},
	plugins: [
		new ExtractTextPlugin("[name]"),
		new webpack.optimize.UglifyJsPlugin({
			include: /\.min\.js$/,
			minimize: true
		}),
		new OptimizeCssAssetsPlugin({
			assetNameRegExp: /\.min\.css$/
		}),
		new webpack.ProvidePlugin({
			$: 'jquery',
			jQuery: 'jquery',
			'window.jQuery': 'jquery',
		})
	]
}