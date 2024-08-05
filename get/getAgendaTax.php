<?php
    include '../includes/config.php';
    $agendas = $b->getAgendaTax();
    echo json_encode($agendas);
?>