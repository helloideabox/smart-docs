const webpack = require( 'webpack' );
const path = require( 'path' );


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
			test: /\.css$/,
			use: ['style-loader', 'css-loader']
		  },
		  {
			  test: /\.scss$/,
			  use: ['style-loader', 'css-loader', 'sass-loader']
			}
		],
	},
}


module.exports = config;