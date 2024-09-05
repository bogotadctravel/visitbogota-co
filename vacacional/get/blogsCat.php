<?php
    include "../includes/sdk_import.php";
    include "../includes/vacacional.php";  
    $vacacional = new vacacional(isset($_GET["lang"]) ? $_GET["lang"] : "es");
    $result = $vacacional->getBlogsCat($_GET['cat']);
    echo json_encode($result);
?>