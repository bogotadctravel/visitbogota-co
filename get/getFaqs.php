<?php
    include '../includes/config.php';
    $faqs = $b->getFaqs($_GET['faqCatID']);
    echo json_encode($faqs);
?>