<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><% if $Title %> $Title | <% end_if %>$SiteConfig.Title</title>

    <% if $MetaDescription %>
    <meta name="description" content="$MetaDescription">
    <% else %>
    <meta name="description" content="$SiteConfig.Tagline">
    <% end_if %>

    <meta property="og:type" content="website" />
    <meta property="og:title" content="$Title" />
    <meta property="og:description" content="$MetaDescription" />
    <meta property="og:site_name" content="$SiteConfig.Title" />
    <meta property="og:url" content="$AbsoluteLink" />

    <% if $SiteConfig.Favicon %>
		<link rel="shortcut icon" href="$SiteConfig.Favicon.URL">
    <% else %>
    <link rel="shortcut icon" href="$themedResourceURL('images/favicon.ico')">
    <% end_if %>

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