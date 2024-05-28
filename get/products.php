<?php
    include '../includes/config.php';
    $category = isset($_GET["category"]) ? $_GET["category"]:"all";
    $products = $b->products($category);
    echo json_encode($products);
?>