const webpack = require( 'webpack' );
const path = require( 'path' );
const MiniCssExtractPlugin = require('mini-css-extract-plugin');


// Webpack config.
const config = {
	// Tell the entry point for webpack file.
	entry: {
		admin: [ './src/index.js' ],
	},

	// Tell webpack where to output.
	output: {
		path: path.resolve( __dirname, './build' ),
		filename: '[name].js',
	},

	module: {
		rules: [
		  {
			test: /\.js$/,
			exclude: /(node_modules|bower_components)/,
			use: {
			  loader: 'babel-loader',
			},
		  },
		  {
			test: /\.(css|scss)$/,
			use: [
				{
					loader : MiniCssExtractPlugin.loader
				},
				'css-loader',
				{
					loader : 'postcss-loader',
					options : {
						plugins : [ require( 'autoprefixer' ) ]
					}
				},
				'sass-loader',
			]
		  }
		],
	},
	plugins : [
		new MiniCssExtractPlugin({
			filename : 'admin.css'
		})
	]
}


module.exports = config;