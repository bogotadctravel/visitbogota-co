<?php 
    include "../includes/sdk_import.php";
    include "../includes/bancoImagenes.php";  
    $bi = new bancoImagenes("es");
    $array = array();
    //Client Message
    extract($_POST);
    $to = $email;
    $params = "{\"BILINK\":\"$size\"}";
    $emailSended = $bi->setFirstImage($to, $params, $size);
    $array['emailSended'] = $emailSended;
    $array['message'] = 1;
    echo json_encode($array);
?>