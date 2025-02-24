/** @type {import('tailwindcss').Config} */

export default {
  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  theme: {
    fontFamily: {
      sans: ['Nunito', 'sans-serif'],
      serif: ['Playfair Display', 'serif'],
    },
    extend: {
      colors: {
        primary: '#FF7F50', // Оранжевый
        secondary: '#228B22', // Зеленый
        accent: '#FF4500', // Красный
        neutral: '#F5F5DC', // Бежевый
        dark: '#8B4513', // Коричневый
        warning: '#FFD700', // Желтый
        gray: '#808080', // Серый
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
