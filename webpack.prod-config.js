const path = require("path");
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const WebpackNotifierPlugin = require("webpack-notifier");

const extractCSS = new ExtractTextPlugin({
  filename: "./style/[name].css",
  allChunks: true
});

module.exports = {
  entry: {
    master: ["./source/scripts/master.js", "./source/style/master.scss"]
  },
  output: {
    path: path.resolve(__dirname + "/frontend/web"),
    filename: "./scripts/[name].js"
  },

  module: {
    loaders: [
      {
        test: /\.js?$/,
        loader: "babel-loader",
        exclude: /node_modules\/(?!(dom7|swiper)\/).*/
      },
      {
        test: /\.scss$/,
        loader: extractCSS.extract(["postcss-loader", "sass-loader"])
      },
    ],
  },
  plugins: [
    extractCSS,
    new WebpackNotifierPlugin({
      title: `Prod Compiled!`,
      contentImage: path.join(__dirname, 'source/environment/webpack-prod-logo.png')
    })
  ]
};