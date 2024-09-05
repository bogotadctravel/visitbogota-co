<?php
 header('Content-Type: application/json; charset=utf-8');
 include "../includes/sdk_import.php";
 include "../includes/vacacional.php";  
 $vacacional = new vacacional(isset($_GET['lang'])? $_GET['lang']:"es");
 $restaurants = $vacacional->getRestaurants("all","all",$_GET['termID'],"all","all");
 echo json_encode($restaurants);
