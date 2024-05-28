<?php
include "../includes/sdk_import.php";
include "../includes/mice.php";  $mice = new mice($_GET["lang"]);
    $formats = $mice->formatosSalas();
    echo json_encode($formats);
