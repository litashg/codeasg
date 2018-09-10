module.exports = () => ({
  plugins: {
    'autoprefixer': {
      browsers: ['> 0.5%', 'IE 10']
    },
    'postcss-flexbugs-fixes': {},
    'postcss-short': {},
    'cssnano': {}
  }
});