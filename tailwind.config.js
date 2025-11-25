import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                floralBlue: '#6A80C1',
                lightBlue: '#9EB2E5',
                floralOrange: '#D98B45',
                lightOrange: '#F2B36D',
                floralBg: '#FAF6F0',
                floralBrown: '#7A3E2B'
            },
        },
    },

  
    plugins: [forms],
};
