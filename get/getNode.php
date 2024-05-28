<?php 
    include '../includes/config.php';
    $node = $b->query("gcontent/206")[0];
    echo json_encode($node);
?>