<?php
include '../includes/config.php';
$venueid = $_GET['venueid'];
$provider = $b->get_mice_single_venues($venueid);;
$galleryImages = explode(',', $provider->field_galery);
echo json_encode($galleryImages);
