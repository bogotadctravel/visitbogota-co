<?php 
    session_start();
    include "bogota.php";
    $lang = isset($_GET['lang']) ? $_GET['lang'] : 'es';
    $b = new bogota($lang); //Idiomas disponibles: es, en, pt
    $pi_bogota = explode("|",$b->pi_Bogotadc[0]->field_palabras);
?>