<?php
    include '../includes/config.php';
    $nearbyPlaces = $b->nearbyPlaces(1);
    echo json_encode($nearbyPlaces);
?>