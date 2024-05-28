<?php
include "../includes/sdk_import.php";
include "../includes/mice.php";

$mice = new mice($_GET["lang"]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtén los datos enviados en el cuerpo de la solicitud
    $postData = json_decode(file_get_contents("php://input"), true);

    if (isset($postData['filter'])) {
        // Procesa el filtro
        $result = $mice->getfilters($postData['filter']);
        echo json_encode($result);
    } else {
       //echo "filtro->".$_POST['filter'];
    $result = $mice->getfilters($_POST['filter']);
    echo json_encode($result);
    }
} else {
    echo json_encode(array("error" => "Solicitud incorrecta"));
}
?>
