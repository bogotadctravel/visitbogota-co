<?php
    include "../includes/sdk_import.php";
    include "../includes/restaurants.php";  $mice = new Restaurants("es");

    //echo "filtro->".$_POST['filter'];
    $result = $mice->getfilters($_POST['filter']);
    echo json_encode($result);
?>