<?php
    include '../includes/config.php';
    $products = $b->getMenuTaxCategories();
    echo json_encode($products);
?>