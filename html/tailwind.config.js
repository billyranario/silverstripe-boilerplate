/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./themes/mmp/**/*.{ss,html}", "./app/templates/**/*.{ss,html}"],
    theme: {
        extend: {
            backgroundImage: {
                "navy-semitransparent":
                    "linear-gradient(180deg, #243257E8 0%, #060B19E6 89%)",
                footer: "linear-gradient(to right, #fff 0%, #fff 30%, #1a243f 30%, #1a243f 100%)",
            },
            colors: {
                body: {
                    DEFAULT: "#6d6d6d",
                    gray: "#d9d9d9",
                },
                cream: "#f9f6f3",
                heading: {
                    DEFAULT: "#10172c",
                    light: "#faf5f2",
                },
                gold: {
                    DEFAULT: "#817565",
                    light: "#ad9779",
                    dark: "#7f6f5d",
                },
                gray: {
                    border: "#dadada",
                    dark: "#1e1e1e",
                    light: "#eaeaea",
                },
                navy: {
                    DEFAULT: "#1a243f",
                    light: "#2a334d",
                    dark: "#11192e",
                },
                semitransparent: {
                    DEFAULT: "rgba(0, 0, 0, 0.5)",
                    md: "rgba(0, 0, 0, 0.4)",
                    light: "rgba(0, 0, 0, 0.3)",
                    white: "rgba(255, 255, 255, 0.07)",
                },

                // ── First Response palette ──────────────────────────
                // Appended, not merged into the tokens above, so every
                // existing block keeps rendering identically.
                champagne: {
                    DEFAULT: "#C6A97C", // --champagne
                    deep: "#A88A5C", // --champagne-deep
                    ink: "#7A5F33", // light-variant accent (5.17:1 on porcelain)
                },
                graphite: {
                    DEFAULT: "#191B1E", // --graphite
                    panel: "#212429", // --panel
                    line: "#33373D", // --panel-line
                },
                mist: {
                    DEFAULT: "#B7B4AC", // --mist
                    dim: "#8B8880", // footer fineprint
                },
                porcelain: {
                    DEFAULT: "#F1EEE8", // --porcelain
                    line: "#DED8CC", // light-variant hairline
                },

                // ── "Private Vendor Counsel" (VC·26 /meeting handoff) ──
                // Appended, not merged into the site's own navy/gold above —
                // this campaign's tokens are different hex values from both
                // the site defaults and the unrelated /private-vendor-counsel
                // page's tokens, so every existing block keeps rendering
                // identically. Hairline opacities (0.14/0.18/0.25) are used
                // as Tailwind arbitrary values directly in templates.
                meeting: {
                    navy: "#1B2B4B",
                    "navy-hover": "#274A9C",
                    ink: "#212530",
                    body: "#3A3F4B",
                    muted: "#5A5F6B",
                    faint: "#8A8F9B",
                    gold: "#A8873E",
                    "gold-on-navy": "#C7A55C",
                    paper: "#FAF7F2",
                    placeholder: "#EDE9E2",
                },
            },
            container: {
                center: true,
                padding: {
                    DEFAULT: "1.5rem",
                    md: "2.5rem",
                },
                screens: {
                    sm: "98.125rem",
                },
            },
            fontFamily: {
                roboto: ["Roboto", "sans-serif"],
                cormorant: ["Cormorant Infant", "serif"],
                nunito: ["Nunito Sans", "sans-serif"],
                playfair: ["Playfair Display", "serif"],
                montserrat: ["Montserrat", "sans-serif"],

                // ── First Response families ─────────────────────────
                // Stacks copied exactly from the approved design. The two
                // Hanken entries are NOT duplicates: the source uses
                // "Hanken Grotesk", system-ui, sans-serif on body and
                // "Hanken Grotesk", sans-serif on .moment h3 / .card h3.
                // Kept separate so fallback behaviour matches.
                bodoni: ["Bodoni Moda", "serif"],
                hanken: ["Hanken Grotesk", "system-ui", "sans-serif"],
                "hanken-tight": ["Hanken Grotesk", "sans-serif"],

                // ── Landing Redesign family ──────────────────────────
                // Confirmed via `pdffonts`, not guessed: "Archivo" is the
                // ONLY font embedded in MMP Landing Redesign-1.pdf, at
                // SemiBold (600) — used for every text run in that file,
                // headings and body alike.
                archivo: ["Archivo", "sans-serif"],

                // ── /meeting family — single family per the build spec ──
                garamond: ["EB Garamond", "Georgia", "serif"],
            },
            fontSize: {
                md: "0.9375rem",
                sd: ".875rem",
            },
            gradientColorStops: {
                "navy-semitransparent": "#1a243fd9",
            },
            gridTemplateColumns: {
                "2/1": "2fr 1fr",
            },
            padding: {
                "10p": ".625rem",
                "15p": "0.9375rem",
                "35p": "2.1875rem",
            },
            boxShadow: {
                dropdown:
                    "0 10px 15px -3px rgb(0 0 0 / 0.1), 0 -1px 6px -4px rgb(0 0 0 / 0.1);",
            },
        },
    },
    plugins: [],
};
