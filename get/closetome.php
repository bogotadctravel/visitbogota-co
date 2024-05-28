<?php
include '../includes/config.php';
$closetoArray = explode(',', $_GET['closeto']);

$closetoArray[0] = floatval($closetoArray[0]);
$closetoArray[1] = floatval($closetoArray[1]);

$products = $b->places(
    false,
    false,
    false,
    $_GET['closeto'] ? array($closetoArray[0], $closetoArray[1]) : false
);

echo json_encode($products);
