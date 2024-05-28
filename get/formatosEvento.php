<?php
include '../includes/config.php';
$formatosVenues = $b->eventformatVenues();
echo json_encode($formatosVenues);
