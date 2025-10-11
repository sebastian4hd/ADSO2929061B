<?php
    session_start();
    $title = "30 - Sessions";
    $descripcion = "Learn how to work with sessions in PHP.";

include 'template/header.php';
    echo '<section>';

    if (!isset($_SESSION['views'])) {
        $_SESSION['views'] = 0;
    }
    $_SESSION['views']++;
    echo "Number of views: " . $_SESSION['views'];

    echo '</section>';

include 'template/footer.php'; ?>