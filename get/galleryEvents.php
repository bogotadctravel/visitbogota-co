<?php 

    include '../includes/config.php';

    $eventID = $_GET['eventID'];

    $event = $b->events($eventID);

    $galleryImages = explode(',', $event->field_galery);

    echo json_encode($galleryImages);

?>