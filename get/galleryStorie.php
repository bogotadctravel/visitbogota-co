<?php
include '../includes/config.php';
$storieid = $_GET['storieid'];
$provider = $b->get_single_mice_casos($storieid);
$galleryImages = explode(',', $provider->field_galery);
echo json_encode($galleryImages);
