/** @type {import('tailwindcss').Config} */
const plugin = require("tailwindcss/plugin");
const colors = require("tailwindcss/colors");
module.exports = {
    content: ["./resources/**/*.blade.php", "./resources/**/*.{js,jsx}"],
    theme: {
        extend: {
            colors: {
                dark: "#212341",
                "brand": {
                    50: "#FFDBDB",
                    100: "#FFBDBD",
                    200: "#FF7575",
                    300: "#FF3333",
                    400: "#F00000",
                    500: "#AB0000",
                    600: "#8A0000",
                    700: "#660000",
                    800: "#420000",
                    900: "#240000",
                    950: "#0F0000"
                  },
            },
        },
    },
    plugins: [
        plugin(function ({ addBase, addComponents, addUtilities, theme }) {
            addComponents({
                ".center": {
                  "display": "flex",
                  "justify-content": "center",
                  "align-items": "center",
                },
            },
            {
                ".center-between": {
                    "display": "flex",
                    "justify-content": "space-between",
                    "align-items": "center",
                }
            }
            );
        }),
    ],
    prefix: "tw-",
};