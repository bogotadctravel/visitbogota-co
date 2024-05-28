<?php

// Function to fetch URL content using cURL
function fetchURL($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
    $content = curl_exec($ch);
    curl_close($ch);
    return $content;
}

// Function to extract URLs from HTML content
function extractURLs($html, $base_url) {
    $urls = [];
    $dom = new DOMDocument();
    @$dom->loadHTML($html); // Suppress warnings
    $anchors = $dom->getElementsByTagName('a');
    foreach ($anchors as $anchor) {
        $href = $anchor->getAttribute('href');
        // Handle relative URLs
        $url = new \Net_URL2($href);
        if (!$url->isAbsolute()) {
            $url = new \Net_URL2($base_url);
            $url->resolve($href);
        }
        $urls[] = $url->getURL();
    }
    return $urls;
}

// Main function to crawl a website and extract URLs
function crawlWebsite($start_url) {
    $visited = [];
    $to_visit = [$start_url];
    $base_url = parse_url($start_url, PHP_URL_SCHEME) . '://' . parse_url($start_url, PHP_URL_HOST);
    
    while (!empty($to_visit)) {
        $current_url = array_pop($to_visit);
        if (!in_array($current_url, $visited)) {
            $html = fetchURL($current_url);
            $urls = extractURLs($html, $base_url);
            $visited[] = $current_url;
            // Add newly found URLs to the list of URLs to visit
            $to_visit = array_merge($to_visit, array_diff($urls, $visited));
        }
    }
    
    return $visited;
}

// Example usage
$start_url = 'https://visitbogota.co/';
$all_urls = crawlWebsite($start_url);

// Output all URLs
foreach ($all_urls as $url) {
    echo $url . "\n";
}

?>