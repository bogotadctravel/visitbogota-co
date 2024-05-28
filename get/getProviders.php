<?php
include '../includes/config.php';
$providers = $b->get_mice_provider(
    $_GET['type'] ? explode(',', $_GET['type']) : false,
    $_GET['page'] ? $_GET['page'] : '0'
);
echo json_encode($providers);
