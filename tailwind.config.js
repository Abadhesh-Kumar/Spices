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
            colors: {
                brand: {
                    50: '#f1f8f7',
                    100: '#d6ece7',
                    200: '#acd8d0',
                    300: '#7ec0b6',
                    400: '#4aa59a',
                    500: '#1f877c',
                    600: '#156d64',
                    700: '#115651',
                    800: '#0f3f3c',
                    900: '#0b2b29',
                },
                accent: {
                    50: '#fff7ed',
                    100: '#ffedd5',
                    200: '#fed7aa',
                    300: '#fdba74',
                    400: '#fb923c',
                    500: '#f97316',
                    600: '#ea580c',
                    700: '#c2410c',
                    800: '#9a3412',
                    900: '#7c2d12',
                },
                sand: '#f7f2ea',
                ink: '#1f2937',
            },
            fontFamily: {
                sans: ['Manrope', ...defaultTheme.fontFamily.sans],
                display: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            boxShadow: {
                soft: '0 16px 40px -24px rgba(15, 23, 42, 0.4)',
            },
        },
    },

    plugins: [forms],
};
