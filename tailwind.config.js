import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                // Dark / Cyber palette — Black + Cyan
                paper: {
                    50:  '#0A0A0A',
                    100: '#111111',
                    200: '#1C1C1C',
                    300: '#282828',
                    DEFAULT: '#0D0D0D',
                },
                ink: {
                    50:  '#6B8F94',
                    100: '#A8C8CC',
                    200: '#D4ECEF',
                    DEFAULT: '#FFFFFF',
                },
                sienna: {
                    50:  '#E3F9FC',
                    100: '#B0EDF6',
                    200: '#5DD8EE',
                    300: '#3CC8E0',
                    DEFAULT: '#29BDD4',
                    600:  '#1B9DB3',
                },
                warm: {
                    gray: '#4A7A82',
                    border: '#1E2E30',
                },
            },
            fontFamily: {
                serif: ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
                sans:  ['"DM Sans"', ...defaultTheme.fontFamily.sans],
                mono:  ['"JetBrains Mono"', ...defaultTheme.fontFamily.mono],
            },
            animation: {
                'fade-in':  'fadeIn 0.4s ease-out',
                'slide-up': 'slideUp 0.5s ease-out',
                'glow':     'glow 2s ease-in-out infinite alternate',
            },
            keyframes: {
                fadeIn: {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%':   { opacity: '0', transform: 'translateY(14px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                glow: {
                    '0%':   { boxShadow: '0 0 6px 0 rgba(41,189,212,0.2)' },
                    '100%': { boxShadow: '0 0 18px 2px rgba(41,189,212,0.45)' },
                },
            },
            boxShadow: {
                'cyan-sm':  '0 0 8px rgba(41,189,212,0.25)',
                'cyan-md':  '0 0 20px rgba(41,189,212,0.35)',
            },
        },
    },

    plugins: [forms],
};
