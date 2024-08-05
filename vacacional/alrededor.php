<?php 
    $bodyClass = 'alrededor';
    include 'includes/head.php';
    $placeID = $_GET['placeID'];
    $place = $b->nearbyPlaces(1,$placeID);
    $place = $place[0];
    $placeCords = explode(',',$place->field_location);
?>
<main id="mainInternPlace" data-productid="<?=$_GET['productID']?>" data-productname="<?=$_GET['productname']?>" data-placeid="<?=$placeID?>" data-placecoords="<?=$place->field_location?>" class="backLinkN">
    <section class="banner">
        <div class="banner_img">
            <?php if($place->field_cover_image && !$place->field_cover_video){ ?>
                <img loading="lazy" src="https://picsum.photos/20/20" data-src="<?=$urlGlobal?><?=$place->field_cover_image?>" alt="monserrate" class="lazyload">
            <?php }else if($place->field_cover_image && $place->field_cover_video || !$place->field_cover_image && $place->field_cover_video){ ?>
                <video autoplay muted playsinline loop preload="yes" poster="<?=$place->field_cover_image?>" class="videoBanner">
                    <source src="<?=$place->field_cover_video?>" type="video/mp4">
                </video>
            <?php } ?>
        </div>
        <div class="banner_info">
            <h2 class=""><?=$place->title?></h2>
            <div class="me"  style="display:none;"><img src="/img/cerca_icon.svg" alt="cerca"><span>A menos de 20 km.</span></div>
        </div>
    </section>
    <div class="desc">
        <div class="txt" data-aos="fade-up">
            <?=$place->body?>
            <a href="http://maps.google.com/maps?q=<?=$place->field_location?>" class="map" target="_blank" rel="noopener">
                <div class="map_lupa"><img src="../img/lupa_blue.svg" alt="lupa"><small><?=$b->generalInfo->field_texto_como_llegar?></small></div>
                <img src="../img/map.jpg" alt="map">
            </a>
            <div class="recomendacion">
        <small><?=$b->generalInfo->field_legal_place?></small>
    </div>
        </div>
    </div>
    <?php 
        $galleryImages = explode(',', $place->field_galery);
        if(count($galleryImages) > 0 && $galleryImages[0] != ''){
    ?>
    <div class="gallery">
        <img loading="lazy" src="https://picsum.photos/20/20" data-src="<?=$urlGlobal?><?=$galleryImages[0]?>" alt="Sitio web oficial de turismo de Bogotá" class="lazyload" id="principal_img">
        <ul class="gallery_dot">
            <?php 
                for ($imageCount=0; $imageCount < count($galleryImages); $imageCount++) { 
            ?>
                <li <?= $imageCount == 0 ? 'class="active"': '' ?>>
                    <img loading="lazy" src="https://picsum.photos/20/20" data-src="<?=$urlGlobal?><?=$galleryImages[$imageCount]?>" alt="Sitio web oficial de turismo de Bogotá" class="lazyload">
                </li>
            <?php } ?>
        </ul>
    </div>

  
    
    <?php } ?>
</main>
<?php include '../templates/articles_rel.php'; include 'includes/imports.php'; ?>