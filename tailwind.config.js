const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/img/*'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'transparent-white': 'rgba(255,255,255,0.8)',
                'primary': '#2A9E79',
                'secondary': '#A2185B'
            },
            backgroundImage: {
                'street': 'url(/resources/img/fondoapp.png)',
                'main-gradient': 'linear-gradient(to right, #099070, #C52360)'
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
