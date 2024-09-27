<?php
header('Content-Type: application/json; charset=utf-8');
include '../includes/config.php';

// Obtener el contenido del cuerpo de la solicitud para verificar si es JSON
$requestContent = file_get_contents('php://input');
$data = json_decode($requestContent, true);

// Si la solicitud viene en formato JSON
if ($data && isset($data['filters']['selects'])) {
    $filters = $data['filters']['selects'];
} else if (isset($_POST['filters']['checkboxes'])) {
    // Si la solicitud viene como $_POST
    $filters = $_POST['filters']['checkboxes'];
} else {
    // Si no se encuentran filtros, retornar un error
    echo json_encode(['error' => 'No filters provided']);
    exit;
}

$categories = "";
$zones = "";
$agenda = isset($_GET['agenda']) ? $_GET['agenda'] : "148";

// Recorrer los filtros para categorías y zonas
foreach ($filters as $filterGroup) {
    if ($filterGroup['filter'] == "categorias_eventos") {
        $categories = implode("+", $filterGroup['value']);
    }
    if ($filterGroup['filter'] == "test_zona") {
        $zones = implode("+", $filterGroup['value']);
    }
}

// Realizar la consulta con los filtros
$formatosVenues = $b->events(
    "",
    $zones != "" ? $zones : "all",
    $categories != "" ? $categories : "all",
    $agenda
);

// Enviar la respuesta en formato JSON
echo json_encode($formatosVenues);
?>
