<?php

    include '../includes/config.php';
    $zones = $b->zonesTax();
    echo json_encode($zones);
?>