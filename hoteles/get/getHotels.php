<?php
    header('Content-Type: application/json; charset=utf-8');
    include "../includes/sdk_import.php";
    include "../includes/hotels.php";  
    $mice = new hotels("es");
    $hotels = $mice->getHotels("all");
    echo json_encode($hotels);
