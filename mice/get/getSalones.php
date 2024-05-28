<?php
include "../includes/sdk_import.php";
include "../includes/mice.php";  $mice = new mice($_GET["lang"]);
$venueid = $_GET['venueid'];
$salones = $mice->get_mice_salones($venueid);
echo json_encode($salones);
