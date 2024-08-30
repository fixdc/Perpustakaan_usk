/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
    "node_modules/preline/dist/*.js",
  ],
  theme: {
    extend: {},
    
    fontFamily: {
      'mont': ['Montserrat'],
      'cool': ['cool','sans-serif'],
      'coolit': ['coolit','sans-serif']
    }
  },
  plugins: [
    require('preline/plugin'),
    require('flowbite/plugin')
  ],
}

