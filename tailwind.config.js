/** @type {import('tailwindcss').Config} */
const { boxShadow } = require('tailwindcss/defaultTheme');

module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    boxShadow: {
      ...boxShadow,
      outline: 'shadow-style-here'
    },
    extend: {},
  },
  plugins: [],
}
