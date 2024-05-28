<?php header('Content-Type: application/json; charset=utf-8');
     include "../includes/sdk_import.php";
     include "../includes/mice.php";  $mice = new mice($_GET["lang"]);
    
    // print_r($_POST['filters']['checkboxes']);
    $type = "";
    $certs = "";
    $sliders = array();
    for($i=0;$i<count($_POST['filters']['checkboxes']);$i++)
    {
        if($_POST['filters']['checkboxes'][$i]['filter']=="criterios_venues"){  $type = implode("+",$_POST['filters']['checkboxes'][$i]['value']); };
        if($_POST['filters']['checkboxes'][$i]['filter']=="certificaciones_de_venues"){  $certs = implode("+",$_POST['filters']['checkboxes'][$i]['value']); };
    }
    if(isset($_POST['filters']['sliders']))
    {
        $sliders = $_POST['filters']['sliders'];
    }
     $result = $mice->getVenues($type,$certs,$sliders);
    echo json_encode($result);

?>