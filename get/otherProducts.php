<?php
    include '../includes/config.php';
    $othersProducts = $b->otherProducts($_GET['productID']);
    shuffle($othersProducts);
    echo json_encode($othersProducts);
?>