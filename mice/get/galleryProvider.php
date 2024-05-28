<?php
include "../includes/sdk_import.php";
include "../includes/mice.php";  $mice = new mice($_GET["lang"]);
$providerid = $_GET['providerid'];
$provider = $mice->get_mice_single_provider($providerid);
$galleryImages = explode(',', $provider->field_galery);
echo json_encode($galleryImages);
