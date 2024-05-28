<?php 
    include '../includes/config.php';
    $blogsRel = $b->blogs("all", $_GET["productID"], 50);
    echo json_encode($blogsRel); 
?>