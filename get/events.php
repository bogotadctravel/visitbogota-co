<?php
 header('Content-Type: application/json; charset=utf-8');
include '../includes/config.php';
$categories = "";
$zones = "";
$agenda = isset($_GET['agenda']) ? $_GET['agenda'] : "148";
for($i=0;$i<count($_POST['filters']['checkboxes']);$i++)
{
    if($_POST['filters']['checkboxes'][$i]['filter']=="categorias_eventos"){    $categories = implode("+",$_POST['filters']['checkboxes'][$i]['value']); };
    if($_POST['filters']['checkboxes'][$i]['filter']=="test_zona"){    $zones = implode("+",$_POST['filters']['checkboxes'][$i]['value']); };
}

$formatosVenues = $b->events("", $zones != "" ? $zones : "all" , $categories != "" ? $categories : "all" , $agenda);
echo json_encode($formatosVenues);
