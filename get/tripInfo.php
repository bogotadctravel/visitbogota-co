<?php
    include '../includes/config.php';
    $tripinfo = $b->tripinfo("all",$_GET['boxID']);
    echo json_encode($tripinfo);
?>