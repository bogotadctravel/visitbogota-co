<?php
    include '../includes/config.php';
    $tripinfo = $b->tripinfo("all", $_GET['faqCatID']);
    echo json_encode($tripinfo);
?>