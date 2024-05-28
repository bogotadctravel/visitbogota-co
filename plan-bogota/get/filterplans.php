

<?php 
    include "../includes/sdk_import.php";
    include "../includes/plan-bogota.php";
    // Retrieve the search parameter from the URL
    $search = $_GET["search"];
    // Replace spaces with the plus symbol
    $search = str_replace(" ", "+", $search);

    $pb = new planbogota(isset($_GET["lang"]) ? $_GET["lang"]  : 'es' );
    $filtered = $pb->filterPlans(isset($_GET["zones"]) && $_GET["zones"] != "" ? $_GET["zones"] : "all", isset($_GET["persons"]) && $_GET["persons"] != "" ? $_GET["persons"] : "all", isset($_GET["segments"]) && $_GET["segments"] != "" ? $_GET["segments"] : "all", isset($_GET["price"]) ? "?field_pd_value=".$_GET["price"] : "", isset($search ) ? $search  : "all" , isset($_GET["max"]) ? "?field_maxpeople_value=".$_GET["max"] : "");
    echo json_encode($filtered);
?>