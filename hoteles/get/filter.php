<?php
include "../includes/sdk_import.php";
include "../includes/hotels.php";

// Obtener el contenido del cuerpo de la solicitud para verificar si es JSON
$requestContent = file_get_contents('php://input');
$data = json_decode($requestContent, true);

// Verificar si los datos vienen como JSON o a través de $_POST
if ($data && isset($data['filter'])) {
    $filter = $data['filter']; // Si es JSON, obtener el filtro desde los datos decodificados
} elseif (isset($_POST['filter'])) {
    $filter = $_POST['filter']; // Si es $_POST, obtener el filtro normalmente
} else {
    // Si no se encuentra el filtro, retornar un error
    echo json_encode(['error' => 'No filter provided']);
    exit;
}

// Obtener el idioma desde la URL o usar "es" como valor predeterminado
$mice = new hotels(isset($_GET["lang"]) ? $_GET["lang"] : "es");

// Obtener los filtros y devolver los resultados en formato JSON
$result = $mice->getfilters($filter);
echo json_encode($result);
?>
