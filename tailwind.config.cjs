/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './public/views/**/*.{php, html}',
    './includes/templates/*.{php, html}',
    './**.{php, html}'
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
