<?php
  include "../includes/sdk_import.php";
  include "../includes/mice.php";  $mice = new mice($_GET["lang"]);


$venues = $mice->get_mice_venues(
    isset($_GET['type']) ? explode(',', $_GET['type']) : false,
    isset($_GET['format']) ? explode(',', $_GET['format']) : false,
    isset($_GET['format']) ? explode(',', $_GET['aforo']) : false
);
echo json_encode($venues);
