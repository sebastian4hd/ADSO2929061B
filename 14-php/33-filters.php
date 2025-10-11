<?php

    $title = "33 - Filters";
    $descripcion = "Learn how to use filters in PHP.";

include 'template/header.php';
    echo '<section>';

    $email = "user@example.com";
    $url = "http://example.com";

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Valid email address.";
    } else {
        echo "Invalid email address.";
    }
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        echo "Valid URL.";
    } else {
        echo "Invalid URL.";
    }


    echo '</section>';

include 'template/footer.php'; ?>