<?php
    include "../includes/sdk_import.php";
    include "../includes/bancoImagenes.php";  
    $bi = new bancoImagenes("es");
    $images = $bi->get_allImages();
    echo json_encode($images);
?>