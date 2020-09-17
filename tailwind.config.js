// tailwind.config.js
const plugin = require('tailwindcss/plugin');

module.exports = {
    purge:[
        './src/**/*.js'
      ],
    future: {
      removeDeprecatedGapUtilities: true,
      purgeLayersByDefault: true,
    },
  }