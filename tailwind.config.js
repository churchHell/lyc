const colors = require('tailwindcss/colors')

module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class' or 'false'-default
  theme: {
    container: {
      center: true,
      padding: '2rem'
    },
    colors: colors,
    extend: {
      colors: {
        transparent: 'transparent',
        current: 'currentColor',
        primary: {
          DEFAULT: '#54c8b1',
        }
      }
    },
  },
  variants: {
    extend: {
    },
  },
  plugins: [],
}
