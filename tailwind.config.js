const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            colors: {
                'nimbus-primary': '#102a79',
                'nimbus-secondary': '#0c4f90',
                'nimbus-black': '#16161d',
                'nimbus-dark-blue': '#1f298d',
                'nimbus-medium-blue': '#4052ab',
                'nimbus-light-blue': '#cacbff',
                'nimbus-dark-gray': '#4f4f69',
                'nimbus-medium-gray': '#9696b0',
                'nimbus-light-gray': '#d0d0dd',
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            height: {
                'screen-90': '90vh',
            },
            inset: {
                '-128': '-32rem',
            },
            width: {
                '128': '32rem',
            }
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
        backgroundColor: ['hover', 'focus', 'disabled', 'dark'],
        textColor: ['disabled', 'dark', 'hover', 'focus'],
        userSelect: ['hover', 'focus', 'disabled'],
    },

    plugins: [
        require('@tailwindcss/forms')({
            strategy: 'class',
        }),

        require('@tailwindcss/typography'),
    ],
};
