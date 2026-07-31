<?php
// Set the content type to plain text for robots.txt
header('Content-Type: text/plain');

// --- Dynamically determine the site URL ---
// 1. Determine the protocol (http vs https)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
// 2. Get the hostname from the server
$host = $_SERVER['HTTP_HOST'];
// 3. Construct the full sitemap URL
$sitemapUrl = "https://mmp.co.nz/sitemap.xml";
// ---

// Define the local filesystem path to your sitemap file
$sitemapPath = __DIR__ . '/sitemap.xml';
$robotsPath = __DIR__ . '/robots.txt';

// Initialize the robots.txt content string.
// This strategy blocks all crawlers first.
$robotsContent = "User-agent: *\n";
$robotsContent .= "Disallow: /\n\n"; // Added a newline for better formatting

// Check if the sitemap file exists on the server
if (file_exists($sitemapPath) && is_readable($sitemapPath)) {
    // Load the sitemap XML file
    $xml = simplexml_load_file($sitemapPath);

    if ($xml !== false) {
        // Loop through each URL in the sitemap to create "Allow" rules
        foreach ($xml->url as $url_entry) {
            $url = (string)$url_entry->loc;
            $path = parse_url($url, PHP_URL_PATH);

            if (!empty($path)) {
                $robotsContent .= "Allow: " . $path . "\n";
            }
        }
    }
}

// Add the dynamic sitemap reference at the end of the file
$robotsContent .= "\nSitemap: " . $sitemapUrl . "\n";

if (file_put_contents($robotsPath, $robotsContent) !== false) {
    echo "Success! The robots.txt file has been created/updated successfully.<br>";
    echo "<pre>" . htmlspecialchars($robotsContent) . "</pre>";
} else {
    echo "Error: Failed to write to robots.txt. Please check file permissions for the directory.<br>";
}
