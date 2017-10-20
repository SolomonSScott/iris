var webpack = require('webpack');
var path = require('path');
var ExtractTextPlugin = require("extract-text-webpack-plugin");
var inProduction = process.env.NODE_ENV === 'production';

module.exports = {
	entry: {
		app: [
			'./assets/js/main.js',
			'./assets/scss/app.scss'
		]
	},
	output: {
		path: path.resolve(__dirname, './dist'),
		filename: '[name].js'
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
		new ExtractTextPlugin("[name].css"),
		new webpack.LoaderOptionsPlugin({
			minimize: inProduction
		}),
		new webpack.ProvidePlugin({
			$: 'jquery',
			jQuery: 'jquery',
			'window.jQuery': 'jquery',
			Popper: ['popper.js', 'default']
		})
	]
}

if ( inProduction ) {
	module.exports.plugins.push(
		new webpack.optimize.UglifyJsPlugin()
	);
}