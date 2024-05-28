<?php 
    include '../includes/config.php';
    $singlePara = $b->plans($_GET['planID'],true);
    echo json_encode($singlePara);
?>