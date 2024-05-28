<?php
include '../includes/config.php';
$providerType = $b->criteriosProvider();
echo json_encode($providerType);
