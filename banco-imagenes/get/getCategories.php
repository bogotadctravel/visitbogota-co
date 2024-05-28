<?php 
     include "../includes/sdk_import.php";
     include "../includes/bancoImagenes.php";  
    $bi = new bancoImagenes("es");
     $product = $bi->get_products_byID($_GET['id']);
     echo json_encode($product);
?>