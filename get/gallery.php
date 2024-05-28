<?php 
    include '../includes/config.php';
    $placeID = $_GET['placeID'];
    $place = $b->singlePlace($placeID)[0];
    $galleryImages = explode(',', $place->field_galery);
    echo json_encode($galleryImages);
?>