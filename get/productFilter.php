<?php
    include '../includes/config.php';
    $filters = $b->productFilters($_GET['catRel'],$_GET['productID']);
    echo json_encode($filters);
?>