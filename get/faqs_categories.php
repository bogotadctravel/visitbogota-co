<?php
    include '../includes/config.php';
    $faqCat = $b->tripinfoCats('faq');
    echo json_encode($faqCat);
?>