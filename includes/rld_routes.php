<section class="outter basic_background" style="background-image:url(<?=$b->RLDgeneralInfo->field_rld_routesbg?>)">
    <div class="container right bottom goldborder">
        <aside class="aux1"></aside>
        <aside class="aux2"></aside>
        <div class="content outter bigtitle">
            <?php if ($singleRoute != 1) { ?>
                <h1 class="uppercase carambola"><?=$b->RLDgeneralInfo->field_rld_uiword5?></h1>
            <? } else { ?>
                <h1 class="uppercase carambola long"><?=$b->RLDgeneralInfo->field_rld_uiword6?></h1>
            <? } ?>

        </div>
    </div>
    </div>

</section>
<section class="bg_left">
    <div class="container left bottom goldborder">
        <aside class="aux1"></aside>
        <aside class="aux2"></aside>
        <div class="content outter routes_list">
            <ul>
            <?php $routes = $b->get_rld_routes();
                                    for($i=0;$i<count($routes);$i++){
                                        $thealias = $b->get_alias($routes[$i]->title);
    
                                ?>
                <li class="total_link uppercase basic_background" style="background-image:url(<?=$routes[$i]->field__exp_smallbg?>)">
                <div class="text">
                    <h2 class="bold uppercase"><?=$routes[$i]->field_exp_subtitle?></h2>
                    <h1 class="carambola uppercase"><a href="/<?=$lang?>/ruta-leyenda-el-dorado/ruta/<?=$thealias?>-<?=$routes[$i]->nid?>"><?=$routes[$i]->title?></a></h1>
                </div>
                <div class="arrow">
                    <img src="img/arrow_r_slide.svg" alt="arrow">
                    <img src="img/arrow_r_slide_yell.svg" alt="arrow">
                </div>
                <div class="txtAbsolute">
                <?= $routes[$i]->field_exp_shortdesc ?>
                </div>
                </li>
                <? } ?>
            </ul>
    
        </div>
    </div>
    </div>
</section>