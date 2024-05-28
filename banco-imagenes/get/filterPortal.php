<?php 
    include "../includes/sdk_import.php";
    include "../includes/bancoImagenes.php";  
    $bi = new bancoImagenes("es");
    $images = $bi->getImages(
        $_GET['product'] ? explode(',',$_GET['product']) : false,
        $_GET['zone'] ? explode(',',$_GET['zone']) : false
    );
    echo json_encode($images);
?>