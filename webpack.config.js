const path = require("path");
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const WebpackNotifierPlugin = require("webpack-notifier");

const extractCSS = new ExtractTextPlugin({
  filename: "./style/[name].css",
  allChunks: true
});

module.exports = {
  entry: {
    master: ["./source/scripts/master.js", "./source/style/master.scss"],
    loader: ["./source/scripts/loader.js"]
  },
  output: {
    path: path.resolve(__dirname + "/frontend/web"),
    filename: "./scripts/[name].js"
  },

  module: {
    rules: [
      {
        test: /\.js?$/,
        use: "babel-loader",
        exclude: /node_modules\/(?!(dom7|swiper)\/).*/
      },
      {
        test: require.resolve('snapsvg'),
        loader: 'imports-loader?this=>window,fix=>module.exports=0'
      },
      {
        test: /\.scss$/,
        use: extractCSS.extract(["css-loader", "sass-loader"])
      },
    ],
  },
  plugins: [
    extractCSS,
    new WebpackNotifierPlugin({
      title: `Development Compiled!`,
      skipFirstNotification: true,
      contentImage: path.join(__dirname, 'source/environment/webpack-dev-logo.png')
    })
  ],
  devtool: "source-map",
};
