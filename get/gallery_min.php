<?php 
    include '../includes/config.php';
    $placeID = $_GET['placeID'];
    $place = $b->singlePlace($placeID)[0];
    $galleryImagesMiniature = explode(',', $place->field_gal_min);
    echo json_encode($galleryImagesMiniature);
