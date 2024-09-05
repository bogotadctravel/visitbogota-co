<?php
$bodyClass="rld_home";
include 'includes/head.php';
if($_GET['type']=="aprende")
{
    $banner = $b->RLDgeneralInfo->field_rld_learnbg;
    $gtitle = $b->RLDgeneralInfo->field_rld_uiword2;
}else
{
    $banner = $b->RLDgeneralInfo->field_rld_placesbg;
    $gtitle = $b->RLDgeneralInfo->field_rld_uiword3;
}


// IMPERDIBLES
// rld_placesbg
?>

<section class="rld_body">
    <?php include "includes/rld_header.php"; ?>

    <div class="outter rld_banner basic_background" style="background-image: url(<?=$urlGlobal?><?=$banner?>);">
        </video>
        <div class="container left bottom goldborder aprendeBanner" style="height:50vh">
            <aside class="aux1"></aside>
            <aside class="aux2"></aside>
            <div class="content outter">
                <h1 class="landingTitle uppercase ">
                    <?=$gtitle?>
                </h1>
            </div>
        </div>
    </div>
    <section class="outter gbackground">
        <section class="bg_left">
            <div class="container">
                <? 
                    if($_GET['type']=="aprende"){ 
                    $list = $b->get_rld_topics();
                    for($i=0;$i<count($list);$i++){ 
                ?>
                <div class="singleAprende">
                    <section class="right top goldborder singleAprende__title"
                        style="position:relative;min-height: 15vh;background-image: url(<?=$urlGlobal?><?=$list[$i]->field_ejbanner?>);">
                        <aside class="aux1"></aside>
                        <aside class="aux2"></aside>
                        <h1 class="landingTitle uppercase blue bold "><?=$list[$i]->title?></h1>
                    </section>
                    <section class="left top goldborder" style="position:relative;">
                        <aside class="aux1"></aside>
                        <aside class="aux2"></aside>
                        <?if($list[$i]->field_ej_pic != ''){?>
                        <img src="<?=$urlGlobal?><?=$list[$i]->field_ej_pic?>" class="outter" />
                        <?}?>
                        <?=$list[$i]->body?>
                    </section>
                </div>
                <? }} ?>
                <? if($_GET['type']=="imperdibles"){ $list = $b->get_rld_places();for($i=0;$i<count($list);$i++){ ?>

                <div class="singleAprende">
                    <section class="right top goldborder singleAprende__title"
                        style="position:relative;min-height: 15vh;background-image: url(<?=$urlGlobal?><?=$list[$i]->field_imp_banner?>);">
                        <aside class="aux1"></aside>
                        <aside class="aux2"></aside>
                        <h1 class="landingTitle uppercase blue bold "><?=$list[$i]->title?></h1>
                    </section>
                    <section class="left top goldborder" style="position:relative;">
                        <aside class="aux1"></aside>
                        <aside class="aux2"></aside>
                        <?if($list[$i]->field_imp_pic != ''){?>
                        <img src="<?=$urlGlobal?><?=$list[$i]->field_imp_pic?>" class="outter" />
                        <?}?>
                        <?=$list[$i]->body?>
                    </section>
                </div>
                <? }} ?>
            </div>
        </section>
        <? if($_GET['type']=="aprende"){ ?>
        <section class="bg_right">
            <div class="singleCharacter container">
                <section class="right top goldborder singleCharacter__title"
                    style="position:relative;min-height: 15vh;background-image: url(<?=$urlGlobal?><?=$banner?>);">
                    <aside class="aux1"></aside>
                    <aside class="aux2"></aside>
                    <h1 class="landingTitle uppercase blue bold "><?=$b->RLDgeneralInfo->field_rld_uiword9?></h1>
                </section>
                <section class="left top goldborder content outter characters" style="position:relative;">
                    <aside class="aux1"></aside>
                    <aside class="aux2"></aside>
                    <div class="container right bottom goldborder">
                        <div class="content outter characters">
                            <section class="gallery" id="characters_gallery_2">
                                <?php $chars = $b->get_rld_characters();
                                                for($i=0;$i<count($chars);$i++){
                
                                            ?>
                                <div class="clear">
                                    <div class="col1 w_40 m_outter bigcolumn">
                                        <img class="outter" src="<?=$urlGlobal?><?=$chars[$i]->field_car_pic?>" alt="bochica" />
                                    </div>
                                    <div class="col2 w_60 m_outter bigcolumn">
                                        <h1 class="landingTitle uppercase orange bold "><?=$chars[$i]->title?></h1>
                                        <?=$chars[$i]->body?>
                                    </div>
                                </div>
                                <? } ?>

                        </div>
                    </div>

                </section>
            </div>
        </section>
        <? } ?>

    </section>
</section>
<?php include "includes/rdl_routes.php"; ?>
</section>
<?php include 'includes/imports.php'; ?>