<?php
    include '../includes/config.php';
    $products = $b->products(0, $_GET['productID'], true);
    echo json_encode($products);
?>