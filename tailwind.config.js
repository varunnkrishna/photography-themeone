/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './inc/**/*.php',
    './template-parts/**/*.php',
    './page-templates/**/*.php',
    './assets/js/*.js'
  ],
  safelist: [
    'opacity-0',
    'opacity-100',
    'scale-95',
    'scale-100',
    'hidden',
    'visible',
    'translate-y-0',
    'translate-y-4',
    'active'
  ],
  theme: {
    extend: {
      colors: {
        'primary': '#1A1A1A',
        'secondary': '#4A4A4A',
        'accent': '#9B3322',
        'accent-hover': '#B13D2A',
        'accent-dark': '#8A2E1E',
        'accent-disabled': '#D4A6A0',
        'background': '#F0EFEA',
        'background-alt': '#EAE8E1',
        'text': '#1A1A1A',
        'text-muted': '#4A4A4A',
        'border': '#D8D6CF',
        'error': '#9B3322',
        'success': '#4A695C',
      },
      fontFamily: {
        'nav': ['Montserrat', 'sans-serif'],
        'secondary': ['Playfair Display', 'serif'],
        'primary': ['Libre Franklin', 'sans-serif'],
      },
      backgroundColor: {
        'overlay': 'rgba(26, 26, 26, 0.7)',
      },
      transitionProperty: {
        'height': 'height',
        'spacing': 'margin, padding',
      }
    },
  },
  plugins: [
    require('@tailwindcss/aspect-ratio'),
  ],
}
