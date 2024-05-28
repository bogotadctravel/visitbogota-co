<?php 
    include '../includes/config.php';
    $array = array();
    $response = $b->setSubscriber($_POST['emailSub']);
    $array['response'] = $response;
    $array['message'] = 1;
    echo json_encode($array);
?>