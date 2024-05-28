<?php
$bodyClass="rld_home";
include 'includes/head.php';
$thetitles = explode("/*-",$b->RLDgeneralInfo->field_rdl_introtitles);
$thepars = explode("/*-",$b->RLDgeneralInfo->field_rdl_introps);
?>
<section class="rld_body">
    <?php include "includes/rld_header.php"; ?>
    <div class="outter rld_banner basic_background">
        <video muted autoplay loop>
            <source src="<?=$urlGlobal?><?=$b->RLDgeneralInfo->field_rld_mainvideo?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        </video>
        <div class="container ">


            <div class="content outter">

            </div>
        </div>
    </div>
    <section class="outter gbackground">
        <section>
            <div class="container ">
                <div class="content outter ">
                    <h1 class="landingTitle uppercase blue black ">
                        <?=$thetitles[0]?>
                    </h1>
                    <p>
                        <?=$thepars[0]?>
                    </p>
                </div>
            </div>
            <div class="container  basic_background"
                style="background-image:url(<?=$urlGlobal?><?=$b->RLDgeneralInfo->field_rdl_promoimg1?>); background-position:center top; height:50vh;">
                <div class="content outter titlebanner">
                    <h1 class="landingTitle uppercase carambola"><?=$b->RLDgeneralInfo->field_rld_promotext1?></h1>

                </div>
            </div>
            <div class="container ">
                <div class="content outter ">
                    <h1 class="landingTitle uppercase yellow black ">
                        <?=$thetitles[1]?>
                    </h1>
                    <p>
                        <?=$thepars[1]?>
                    </p>
                </div>
            </div>
        </section>
        <section>
            <div class="container  basic_background"
                style="background-image:url(<?=$urlGlobal?><?=$b->RLDgeneralInfo->field_rdl_promoimg2?>); height:50vh; background-position:center top !important;">
                <div class="content outter titlebanner">
                    <h1 class="landingTitle uppercase carambola"><?=$b->RLDgeneralInfo->field_rld_promotext2?></h1>
                </div>
            </div>
            <div class="container">
                <div class="content outter mapa">
                    <img src="img/mapaCol.png" alt="mapaCol" class="mapColImg">
                    <div class="mapCol">
                        <h1 class="landingTitle uppercase green black ">
                            <?=$thetitles[2]?>
                        </h1>
                        <p>
                            <?=$thepars[2]?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="container ">
                <div class="content outter characters ">
                    <h3 class="carambola uppercase"><?=$b->RLDgeneralInfo->field_rld_uiword3?></h3>
                    <section class="gallery" id="characters_gallery">
                        <?php $rldplaces = $b->get_rld_places();
                                    for($i=0;$i<count($rldplaces);$i++){
                                        $thealias = $b->get_alias($rldplaces[$i]->title);
                                ?>
                        <div class="clear">
                            <?if($rldplaces[$i]->field_imp_pic != ''){?>
                            <div class="col1 w_40 bigcolumn m_outter">
                                <img class="outter" src="<?=$urlGlobal?><?=$rldplaces[$i]->field_imp_pic?>"
                                    alt="<?=$rldplaces[$i]->title?>" />
                            </div>
                            <?}?>

                            <div class="col2 w_60 bigcolumn m_outter">
                                <h1 class="landingTitle uppercase orange bold "><?=$rldplaces[$i]->title?></h1>
                                <p><?=$rldplaces[$i]->field_imp_desc?></p>
                                <a href="/<?=$lang?>/ruta-leyenda-el-dorado/imperdibles/"
                                    class="orangebutton uppercase bold"><?=$b->RLDgeneralInfo->field_rld_uiword4?></a>
                            </div>
                        </div>
                        <? } ?>

                </div>
            </div>

            </div>
        </section>
        <?php include "includes/rld_routes.php"; ?>
    </section>
</section>
<?php include 'includes/imports.php'; ?>