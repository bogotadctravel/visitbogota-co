<?php
    include '../includes/config.php';
    $featuredSliders = $b->featuredSlider();
    echo json_encode($featuredSliders);
?>