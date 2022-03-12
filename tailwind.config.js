module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    safelist: ["z-50"],
    theme: {
        extend: {
            gridTemplateColumns: {
                "cal-pegawai": "min-content auto auto auto auto auto",
            },
        },
    },
    // variants: {
    //     extend: {},
    // },
    plugins: [require("daisyui")],
    daisyui: {
        themes: [
            {
                djp: {
                    /* your theme name */
                    primary: "#212C5F" /* Primary color */,
                    "primary-focus": "#263788" /* Primary color - focused */,
                    "primary-content":
                        "#ffffff" /* Foreground content color to use on primary color */,

                    secondary: "#FFC91B" /* Secondary color */,
                    "secondary-focus":
                        "#FFE804" /* Secondary color - focused */,
                    "secondary-content":
                        "#ffffff" /* Foreground content color to use on secondary color */,

                    accent: "#37cdbe" /* Accent color */,
                    "accent-focus": "#2aa79b" /* Accent color - focused */,
                    "accent-content":
                        "#ffffff" /* Foreground content color to use on accent color */,

                    neutral: "#3d4451" /* Neutral color */,
                    "neutral-focus": "#2a2e37" /* Neutral color - focused */,
                    "neutral-content":
                        "#ffffff" /* Foreground content color to use on neutral color */,

                    "base-100":
                        "#ffffff" /* Base color of page, used for blank backgrounds */,
                    "base-200": "#F3F4F6" /* Base color, a little darker */,
                    "base-300": "#D1D5DB" /* Base color, even more darker */,
                    "base-content":
                        "#1f2937" /* Foreground content color to use on base color */,

                    info: "#2094f3" /* Info */,
                    success: "#009485" /* Success */,
                    warning: "#ff9900" /* Warning */,
                    error: "#ff5724" /* Error */,

                    "--rounded-box": "0.5rem",
                },
            },
        ],
    },
};
