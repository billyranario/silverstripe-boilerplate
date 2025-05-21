<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <% base_tag %>
    <title>
      <% if $MetaTitle %>
      $MetaTitle
      <% else %>
      $Title
      <% end_if %>
       |  $SiteConfig.Title
    </title>

    <% if $MetaDescription %>
    <meta name="description" content="$MetaDescription">
    <% else %>
    <meta name="description" content="$SiteConfig.Tagline">
    <% end_if %>

    <!-- Standard meta tags -->
    <% if $MetaKeywords %>
    <meta name="keywords" content="$MetaKeywords" />
    <% end_if %>

    <% if $MetaCustomTags %>
    <meta name="tags" content="$MetaCustomTags" />
    <% end_if %>

    <!-- Open Graph / Facebook -->
    <%-- Basic OG setup --%>
    <meta property="og:type"        content="website" />
    <meta property="og:url"         content="$AbsoluteLink" />
    <meta property="og:title"       content="<% if $FBTitle %>$FBTitle<% else_if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %>" />
    <% if $FBDescription %>
    <meta property="og:description" content="$FBDescription" />
    <% else_if $MetaCustomTags %>
    <meta property="og:description" content="$MetaCustomTags" />
    <% end_if %>
    <% if $FBImage %>
    <meta property="og:image"       content="$FBImage.URL" />
    <% end_if %>

    <!-- Twitter Card -->
    <meta name="twitter:card"        content="summary_large_image" />
    <meta name="twitter:url"         content="$AbsoluteLink" />
    <meta name="twitter:title"       content="<% if $TwitterTitle %>$TwitterTitle<% else_if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %>" />
    <% if $TwitterDescription %>
    <meta name="twitter:description" content="$TwitterDescription" />
    <% else_if $MetaCustomTags %>
    <meta name="twitter:description" content="$MetaCustomTags" />
    <% end_if %>
    <% if $TwitterImage %>
    <meta name="twitter:image"       content="$TwitterImage.URL" />
    <% end_if %>

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