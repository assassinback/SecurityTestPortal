<?php
if (isset($_POST['website_link'])) {
    require("config.php");

    $websiteLink = trim($_POST["website_link"]); // Trim leading and trailing spaces

    // Normalize the input to include 'https://' if not provided
    if (!preg_match('#^https?://#', $websiteLink)) {
        $websiteLink = 'http://' . $websiteLink;
    }

    $parsedUrl = parse_url($websiteLink);

    if (isset($parsedUrl['host'])) {
        $site = $parsedUrl['host'];

        // Remove "www" subdomain if present
        $site = preg_replace('/^www\./', '', $site);

        $count = selectCount("website_info", "website LIKE '%$site%'");

        if ($count <= 0) {
            echo json_encode(" Website Not Tested! Go Ahead :) ");
        } else {
            echo json_encode(" This Website Is Already Tested! :( ");
        }
    }
}
?>