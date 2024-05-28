<?php
include '../includes/config.php';
$criteriosVenues = $b->criteriosVenues();
echo json_encode($criteriosVenues);
