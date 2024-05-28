<section class="outter basic_background" style="background-image:<?=$urlGlobal?><?=$b->RLDgeneralInfo->field_rld_routesbg?>)">
    <div class="container">
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
    <div class="container">
        <div class="content outter routes_list">
            <ul>
                <?php $routes = $b->get_rld_routes();
                                    for($i=0;$i<count($routes);$i++){
                                        $thealias = $b->get_alias($routes[$i]->title);
    
                                ?>
                <li class="total_link uppercase basic_background"
                    style="background-image:url(<?=$urlGlobal?><?=$routes[$i]->field__exp_smallbg?>)">
                    <a href="/<?=$lang?>/ruta-leyenda-el-dorado/ruta/<?=$thealias?>-<?=$routes[$i]->nid?>">
                        <div class="text">
                            <h1 class="carambola uppercase">
                                <?=$routes[$i]->title?>
                            </h1>
                            <h2 class="bold uppercase"><?=$routes[$i]->field_exp_subtitle?></h2>
                            <div class="revealDesc">
                                <?= $routes[$i]->field_exp_shortdesc ?>
                            </div>
                        </div>
                    </a>
                </li>
                <? } ?>
            </ul>

        </div>
    </div>
    </div>
</section>