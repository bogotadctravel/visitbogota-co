<?php
    include "../includes/sdk_import.php";
    include "../includes/vacacional.php";  
    $vacacional = new vacacional(isset($_GET["lang"]) ? $_GET["lang"] : "es");

    //echo "filtro->".$_POST['filter'];
    $result = $vacacional->getLastBlogs();
    echo json_encode($result);
?>