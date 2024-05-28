<?php
    include '../includes/config.php';
    if($_GET['zoneID']){
        $zones = $b->zones($_GET['zoneID'], true);
        echo json_encode($zones);
    }else {
        $zones = $b->zones();
        echo json_encode($zones);
    }
?>