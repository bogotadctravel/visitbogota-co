<?php
$urlGlobal = 'https://files.visitbogota.co';
$include_level = "../";
$project_base = "/banco-imagenes/";
$project_folder = "banco-imagenes";
include "../includes/header.php";
$bogota = new bogota($_GET["lang"] ? $_GET["lang"]  : 'es' );
include "includes/bancoImagenes.php";
$bi = new bancoImagenes($_GET["lang"] ? $_GET["lang"]  : 'es' );
?>
