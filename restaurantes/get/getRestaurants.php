<?php
 header('Content-Type: application/json; charset=utf-8');
 include "../includes/sdk_import.php";
 include "../includes/restaurants.php";  $mice = new Restaurants("es");

$restaurants = $mice->getRestaurants(
    "all","all","all","all","all"
);
echo json_encode($restaurants);
