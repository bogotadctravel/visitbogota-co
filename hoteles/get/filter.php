<?php
    include "../includes/sdk_import.php";
    include "../includes/hotels.php";  
    $mice = new hotels(isset($_GET["lang"]) ? $_GET["lang"] : "es");
    //echo "filtro->".$_POST['filter'];
    $result = $mice->getfilters($_POST['filter']);
    echo json_encode($result);
?>