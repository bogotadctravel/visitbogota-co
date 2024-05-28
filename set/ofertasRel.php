<?php
// Incluir el archivo de configuración
include '../includes/config.php';

// Obtener los valores de los parámetros o establecer valores por defecto "all" si no están presentes
$atractivo = isset($_GET["atractivo"]) ? $_GET["atractivo"] : "all";
$localidad = isset($_GET["localidad"]) ? $_GET["localidad"] : "all";
$zona = isset($_GET["zona"]) ? $_GET["zona"] : "all";
$alojamiento = isset($_GET["alojamiento"]) ? $_GET["alojamiento"] : "all";

// Convertir los parámetros en cadenas separadas por "+"
$atractivo_str = is_array($atractivo) ? implode("+", $atractivo) : $atractivo;
$localidad_str = is_array($localidad) ? implode("+", $localidad) : $localidad;
$zona_str = is_array($zona) ? implode("+", $zona) : $zona;
$alojamiento_str = is_array($alojamiento) ? implode("+", $alojamiento) : $alojamiento;

// Obtener las ofertas usando los parámetros
$response = $b->getOfertasBy($atractivo_str, $localidad_str, $zona_str, $alojamiento_str);

// Devolver la respuesta como JSON
echo json_encode($response);
?>
