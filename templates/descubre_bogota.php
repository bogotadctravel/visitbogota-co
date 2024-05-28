<?php $planes = $b->secciones_home(); 
usort($planes, function($a, $b) {return strcmp($a->field_orden, $b->field_orden);});
?>
<section class="descubre_bogota" data-aos="fade-right">
    <h2 class="title"><?=$b->generalInfo->field_dlaciudad?></h2>
    
    <?php if(!$isMobile){ ?>
        <div class="bogota_para">
            <?php for ($bogotaParaCount=0; $bogotaParaCount < count($planes); $bogotaParaCount++) { ?>
                <div class="bogota_para_item <?= ($bogotaParaCount + 1) === count($planes) ? 'last_item': '' ?>">
                    <a href="<?=$planes[$bogotaParaCount]->field_link_seccion?>" class="content">
                        <img loading="lazy" data-src="<?= $planes[$bogotaParaCount]->field_imagen_seccion != NULL ? $urlGlobal.$planes[$bogotaParaCount]->field_imagen_seccion
          : "img/noimg.png" ?>" alt="imagen_alt" class="bogota_para_item_img lazyload" src="https://picsum.photos/20/20">
                        <h2 class="bogota_para_item_title"><?=$planes[$bogotaParaCount]->title?></h2>
                    </a>
                </div>
            <?php } ?>
        </div>
    <?php }else{ ?>
        <div class="bogota_para_isMobile">
            <ul>
            <?php for ($bogotaParaCountMob=0; $bogotaParaCountMob < count($planes); $bogotaParaCountMob++) { ?>
                <li>
                    <a href="<?=$planes[$bogotaParaCountMob]->field_link_seccion?>" >
                        <img src="img/color-curve<?=($bogotaParaCountMob + 1)?>.png" alt="curvecolor">
                        <span><?=$planes[$bogotaParaCountMob]->title?></span>
                    </a>
                </li>
            <?php } ?>
            </ul>
        </div>
    <?php } ?>
</section>