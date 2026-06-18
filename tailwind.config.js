import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                coinpel: {
                    DEFAULT: "#4B2E83", 
                    dark: "#2E1A4D", 
                    light: "#7C5CBF", 
                    50: "#F3EFFA", 
                },
                "coinpel-orange": "#F0871D",
            },
        },
    },

    plugins: [forms],
};
