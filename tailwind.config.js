import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'media', // Enable dark mode based on media query
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#007FFF',      // Custom Blue
                secondary: '#5DB996',    // Custom teal
                light: '#E3F0AF',        // Custom light green
                cream: '#FBF6E9',        // Custom cream
            },
        },
        
    },
    plugins: [],
};
