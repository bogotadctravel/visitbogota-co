<?php
include '../includes/config.php';
$imperdibles = $b->get_mice_imperdibles();
echo json_encode($imperdibles);
