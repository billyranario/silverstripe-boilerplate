<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$SiteConfig.Title</title>
    <meta name="description" content="$SiteConfig.Tagline">
    <% if $NoIndex %>
        <meta name="robots" content="noindex,follow">
    <% end_if %>

    <%-- Google Fonts preconnect (both font @imports live in styles.css) --%>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <%-- Preload LCP --%>
    <% if $ElementalArea.Elements.filter('ClassName', 'HeroCarousel').exists %>
        <% loop $ElementalArea.Elements.filter('ClassName', 'HeroCarousel') %>
            <% if $FirstMobileImage %>
                <link rel="preload" href="$FirstMobileImage" as="image" type="image/jpeg">
            <% end_if %>
        <% end_loop %>
    <% end_if %>
    
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';
        j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KH9G2QQP');
    </script>
    <!-- End Google Tag Manager -->

    <%-- Favicon --%>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <%-- <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5"> --%>
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">

    <% require themedCSS('styles.min') %>
    <% require themedJavascript('flickity') %>

    <%-- Swiper Carousel --%>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<body class="relative"> 
    <!-- Google Tag Manager (noscript) -->
    <%-- <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KH9G2QQP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript> --%>
    <!-- End Google Tag Manager (noscript) -->

    <% if not $HideHeader %>
        <div class="pt-[6.875rem]"></div>
        <% include Header %>
    <% end_if %>

    $Layout

    <% if not $HideFooter %>
        <% include Footer %>
    <% end_if %>

    <% if not $HideHeader %>
        <% require themedJavascript('header') %>
    <% end_if %>

    <% if $ElementalArea.Elements.filter('ClassName', 'HeroCarousel').exists %>
        <% require themedJavascript('heroCarousels') %>
    <% end_if %>
    <% if $ElementalArea.Elements.filter('ClassName', 'TeamMemberCarousel').exists %>
        <% require themedJavascript('teamCarousels') %>
    <% end_if %>
    <% if $ElementalArea.Elements.filter('ClassName', 'TestimonialCarousel').exists %>
        <% require themedJavascript('testimonialCarousels') %>
    <% end_if %>
    <% if $ElementalArea.Elements.filter('ClassName', 'SponsorCarousel').exists %>
        <% require themedJavascript('sponsorCarousels') %>
    <% end_if %>
    <% if $ElementalArea.Elements.filter('ClassName', 'TeamMemberGrid').exists %>
        <% require themedJavascript('teamCardDetails') %>
    <% end_if %>
    <% if $ElementalArea.Elements.filter('ClassName', 'Accordion').exists %>
        <% require themedJavascript('accordions') %>
    <% end_if %>
</body>
</html>