<?php
$bodyClass="rld_home";
include 'includes/head.php';

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
<section class="rld_body">
    <?php include "includes/rld_header.php"; ?>
    <div class="outter rld_banner basic_background" style="background-image:url(<?=$urlGlobal?><?=$route->field_exp_bigbg?>)">
        <div class="container right bottom goldborder centerText" style="height:50vh">
            <aside class="aux1"></aside>
            <aside class="aux2"></aside>
            <div class="content outter maintitle">
                <h2 class="bold uppercase"><?=$route->field_exp_subtitle?></h2>
                <h1 class="uppercase "><?=$route->title?></h1>
            </div>
        </div>
    </div>
    <section class="outter gbackground">
        <section class="bg_left">
            <div class="container left bottom goldborder">
                <aside class="aux1"></aside>
                <aside class="aux2"></aside>
                <div class="content outter ">
                    <?=$route->body?>
                </div>
            </div>
            <div class="container right bottom goldborder basic_background" style="height:auto;">
                <aside class="aux1"></aside>
                <aside class="aux2"></aside>
                <div class="content outter theway clear ">
                    <div class=" moutter">
                        <?=html_entity_decode($route->field_exp_map)?>
                    </div>
                    <div class="moutter map clear">
                        <h1 class="uppercase ">Recorre esta ruta</h1>
                        <ul>
                            <? for($i=0;$i<count($points['titles']);$i++){ ?>
                            <li>
                                <a href="javascript:box(<?=$i?>,<?=$_GET['row']?>);" title="Abrir">
                                    <?=($i+1)?>
                                    <div class="txt">
                                        <span>
                                            <?=$points['titles'][$i]?>
                                        </span>
                                        <b>
                                            <?=$points['locations'][$i]?>
                                        </b>
                                    </div>
                                </a>
                            </li>
                            <? } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php $singleRoute = 1; include "includes/rld_routes.php"; ?>
    </section>

</section>
<?php include 'includes/imports.php'; ?>