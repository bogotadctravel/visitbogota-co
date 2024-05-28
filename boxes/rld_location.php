<?php
    include '../includes/config.php';
    $route = $b->get_rld_routes($_GET['row']);
    $route = $route[0];
    //print_r($route);
    $titles = $route->field_exp_attitles;
    $locations = $route->field_exp_atubi;
    $pictures = $route->field_exp_atpic;
    $descriptions = $route->field_exp_atdesc;
    $latlongs = $route->field_exp_atlatlong;

    $points = $b->route_places_order($titles,$locations,$pictures,$descriptions,$latlongs);

?>
<div class="rld_box">
    <a href="javascript:$.fancybox.close();" class="close">X</a>
        <h1 class="landingTitle uppercase bold carambola"><?=$points['locations'][$_GET['i']]?> – <?=$points['titles'][$_GET['i']]?>: </h1>
        <?=$points['descriptions'][$_GET['i']]?>
</div>