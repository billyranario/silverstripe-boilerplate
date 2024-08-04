module.exports = {
    content: [
        "./themes/thehustlers/**/*.{ss,html}",
        "./app/templates/**/*.{ss,html}",
    ],
    theme: {
        extend: {
          boxShadow: {
            inset: "rgba(0,0,0,.17) 0 -8px 21px 0",
            card: "rgba(26,37,69,.25) 0 1px 4px 0",
            "card-2": "rgba(26,37,69,.1) 0 4px 10px 3px",
          },
          colors: {
            primary: "#14a2e1",
            secondary: "#FFDD74",
            "light-gray": "#fafafa",
            "light-gray-2": "#eeeeee",
            "light-gray-3": "#cccccc",
            "dark-gray": "#696969",
          },
          fontFamily: {
            roboto: ['"Roboto"', "sans-serif"],
            // agrandir: ['"Agrandir"', "sans-serif"],
          },
          fontWeight: {
            thin: 100,
            light: 300,
            regular: 400,
            medium: 500,
            bold: 700,
            black: 900,
          },
          fontStyle: {
            italic: "italic",
            normal: "normal",
          },
          maxWidth: {
            sm: "540px",
            md: "720px",
            lg: "960px",
            xl: "1140px",
            "2xl": "1140px",
          },
          backgroundImage: {
            // "hero-landing": "url('/public/img/hero_bg.webp')",
          },
        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
};
