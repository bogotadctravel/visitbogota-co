<?php
include "../includes/sdk_import.php";
include "../includes/mice.php";  $mice = new mice($_GET["lang"]);
$providers = $mice->get_mice_provider(
    $_GET['type'] ? explode(',', $_GET['type']) : false,
    isset($_GET['page']) ? $_GET['page'] : '0'
);
echo json_encode($providers);
