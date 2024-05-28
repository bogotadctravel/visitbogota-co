<?php
    include "../includes/sdk_import.php";
    include "../includes/mice.php";  $mice = new hotels("es");

    echo json_encode($mice->miceinfo);
?>