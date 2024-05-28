<?php header('Content-Type: application/json; charset=utf-8');
     include "../includes/sdk_import.php";
     include "../includes/hotels.php";  $mice = new hotels("es");
    

    $tipos_de_hotel = "";
    $servicios_de_hoteles = "";
    $rangos_de_precios_hoteles = "";
    $zones = "";
    for($i=0;$i<count($_POST['filters']['checkboxes']);$i++)
    {
        if($_POST['filters']['checkboxes'][$i]['filter']=="tipos_de_hotel"){  $tipos_de_hotel = implode("+",$_POST['filters']['checkboxes'][$i]['value']); };
        if($_POST['filters']['checkboxes'][$i]['filter']=="servicios_de_hoteles"){  $servicios_de_hoteles = implode("+",$_POST['filters']['checkboxes'][$i]['value']); };
        if($_POST['filters']['checkboxes'][$i]['filter']=="rangos_de_precios_hoteles"){  $rangos_de_precios_hoteles = implode("+",$_POST['filters']['checkboxes'][$i]['value']); };
        if($_POST['filters']['checkboxes'][$i]['filter']=="test_zona"){    $zones = implode("+",$_POST['filters']['checkboxes'][$i]['value']); };
        
    }

    //echo $type."-".$certs."-".$zones;
     $result = $mice->getHotels($zones,"all",$tipos_de_hotel,$servicios_de_hoteles,$rangos_de_precios_hoteles);
    echo json_encode($result);

?>