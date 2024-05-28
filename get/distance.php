<?php
    include '../includes/config.php';
    $currentLocation = explode(',',$_GET['currentLocation']);
    $placeLocation = explode(',',$_GET['placeLocation']);
    $current = array(floatval($currentLocation[0]), floatval($currentLocation[1]));
    $place = array(floatval($placeLocation[0]), floatval($placeLocation[1]));
    $distance = $b->distance($current,$place);
    $final = number_format((float)$distance, 1, '.', '');
    echo $final;
?>