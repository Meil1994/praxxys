/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      width:{
        '100%':'100%',
        '400px':'400px',
        '500px':'500px'
      },
      height:{
        '500px':'500px'
      },
      fontSize:{
        '2px':'12px',
      },
      screens:{
        '588px':'588px',
        '686px':'686px',
        '730px':'730px',
        '1000px':'1000px',
      },
      padding:{
        '15px':'15px',
        '7px':'7px'
      }
    },
  },
  plugins: [],
}

