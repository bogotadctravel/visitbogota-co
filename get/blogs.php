<?php 
    include '../includes/config.php';
    $blogsRel = $b->blogs("all",$_GET['productID']);
    echo json_encode($blogsRel); 
?>