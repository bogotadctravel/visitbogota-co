<?php
header('Content-Type: application/json; charset=utf-8');
    include "../includes/sdk_import.php";
    include "../includes/mice.php";  $mice = new mice($_GET["lang"]);

    echo json_encode($mice->getCases());
?>