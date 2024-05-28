<?php
include '../includes/config.php';
$providerid = $_GET['providerid'];
$provider = $b->get_mice_single_provider($providerid);
$galleryImages = explode(',', $provider->field_galery);
echo json_encode($galleryImages);
