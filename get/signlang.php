<?php
include '../includes/config.php';
$sign = $b->get_signlang_byID($_GET["id"]);
echo json_encode($sign[0]);
