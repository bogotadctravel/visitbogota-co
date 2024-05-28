<?php header('Content-Type: application/json; charset=utf-8');
     include "../includes/sdk_import.php";
     include "../includes/restaurants.php";  $restaurants = new Restaurants("es");
    

    $categoria_restaurantes = "all";
    $test_zona = "all";
    $zonas_gastronomicas = "all";
    $rangos_de_precio = "all";
    for($i=0;$i<count($_POST['filters']['checkboxes']);$i++)
    {
        if($_POST['filters']['checkboxes'][$i]['filter']=="categoria_restaurantes"){  $categoria_restaurantes = implode("+",$_POST['filters']['checkboxes'][$i]['value']); };
        if($_POST['filters']['checkboxes'][$i]['filter']=="test_zona"){  $test_zona = implode("+",$_POST['filters']['checkboxes'][$i]['value']); };
        if($_POST['filters']['checkboxes'][$i]['filter']=="zonas_gastronomicas"){    $zonas_gastronomicas = implode("+",$_POST['filters']['checkboxes'][$i]['value']); };
        if($_POST['filters']['checkboxes'][$i]['filter']=="rangos_de_precio"){    $rangos_de_precio = implode("+",$_POST['filters']['checkboxes'][$i]['value']); };
    }

    $result = $restaurants->getRestaurants($categoria_restaurantes,$test_zona,$zonas_gastronomicas,$rangos_de_precio);
    echo json_encode($result);

?>