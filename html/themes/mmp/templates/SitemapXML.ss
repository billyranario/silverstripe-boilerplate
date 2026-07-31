<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<% loop $Pages %>
    <url>
        <loc>$Link</loc>
        <lastmod>$LastModified</lastmod>
        <priority>$Priority</priority>
    </url>
<% end_loop %>
</urlset>