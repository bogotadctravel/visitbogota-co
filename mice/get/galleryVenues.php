<?php
include "../includes/sdk_import.php";
include "../includes/mice.php";  $mice = new mice($_GET["lang"]);
$venueid = $_GET['venueid'];
$provider = $mice->get_mice_single_venues($venueid);;
$galleryImages = explode(',', $provider->field_galery);
echo json_encode($galleryImages);
