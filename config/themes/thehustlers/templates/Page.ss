<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$SiteConfig.Title</title>
    <meta name="description" content="$SiteConfig.Tagline">
    <link rel="icon" type="image/svg+xml" href="$themedResourceURL('images/favicon.svg')" />
    <!-- Styles -->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
      integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
      crossorigin="anonymous"
    />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <% require themedCSS('dist/styles.min') %>
  </head>
  <body class="font-roboto text-sm">
    <% include Header %>
    
    <main class="relative">
      $Layout
    </main>

    <% include Footer %>

  	<% require themedJavascript('main.js') %>
  </body>
</html>