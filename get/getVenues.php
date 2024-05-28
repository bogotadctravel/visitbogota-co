<?php
include '../includes/config.php';


$venues = $b->get_mice_venues(
    $_GET['type'] ? explode(',', $_GET['type']) : false,
    $_GET['format'] ? explode(',', $_GET['format']) : false,
    explode(',', $_GET['aforo'])
);
echo json_encode($venues);
