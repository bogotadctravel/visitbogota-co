<?php
    include "../includes/sdk_import.php";
    include "../includes/mice.php";  $mice = new mice($_GET["lang"]);

    echo json_encode($mice->miceinfo);
?>