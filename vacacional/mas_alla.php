<?php 
    $bodyClass = 'mas_alla';
    include 'includes/head.php';
    $banners = $b->generalInfo->field_field_banners;
    $arrayBanners = explode(", ", $banners);
    $bannerAlrededor = $arrayBanners[3];
?>
<main>
    <section class="banner" style="background-image:url(<?=$bannerAlrededor ? $urlGlobal . $bannerAlrededor : 'img/noimg.png' ?>);">
        <h2 class="uppercase"><?=$b->generalInfo->field_titulo_mas_alla?></h2>
        <div class="intro-txt">
            <?= $b->generalInfo->field_desc_mas_alla_1 ?>
        </div>
    </section>
    <div class="intro-txt">
        <div data-aos="zoom-in" data-aos-delay="300">
            <?= $b->generalInfo->field_desc_mas_alla_1 ?>
        </div>
    </div>
    <div class="alrededores_list">
        <ul class="alrededores_list_grid"></ul>
        <button type="button" id="moreItems"><img src="../img/more_items.svg" alt="more"></button>
    </div>
    <?php include '../templates/articles_rel.php'; ?>

</main>
<?php include 'includes/imports.php'; ?>