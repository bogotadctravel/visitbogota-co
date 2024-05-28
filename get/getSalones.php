<?php
include '../includes/config.php';
$venueid = $_GET['venueid'];
$salones = $b->get_mice_salones($venueid);
echo json_encode($salones);
