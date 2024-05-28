<?php
$bodyClass="graybg font1 internprovider-body";
include "includes/head.php"; 
$providerid = $_GET['providerid'];
$provider = $mice->get_mice_single_provider($providerid);

?>

<div class="banner-internVenue" style="
        background-image: url(<?=$provider->field_mainimg != "" ? $mice->absoluteURL($provider->field_mainimg) : "../img/noimg.png" ?>);
      ">
  <div class="info">
    <h1 class="uppercase"><?= $provider->title ?></h1>
    <h2>Fotografía de Eventos</h2>
    <div class="info-container">
      <div class="flex">
        <?php if ($provider->field_miceaddress != '') { ?>
          <div class="address">
            <img src="img/address.svg" alt="address" /><span><?= $provider->field_miceaddress ?></span>
          </div>
        <?php } ?>
        <?php if ($provider->field_micephone != '') { ?>
          <div class="phone">
            <img src="img/tel.svg" alt="address" /><span>Tel:<?= $provider->field_micephone ?></span>
          </div>
        <?php } ?>
        <?php if ($provider->field_miceemail != '') { ?>
          <div class="email">
            <img src="img/email.svg" alt="address" /><span><?= $provider->field_miceemail ?></span>
          </div>
        <?php } ?>
        <?php if ($provider->field_mice_prove_web != '') { ?>
          <div class="email">
            <a href="<?= $provider->field_mice_prove_web ?>" target="_blank">
              <span><?= $provider->field_mice_prove_web ?></span>
          </a>
          </div>
        <?php } ?>
      </div>
    </div>
    <a href="#gallery" class="uppercase btn blue"><?= $mice->miceinfo->field_mice_ui_9 ?>
      <img src="img/arrowcircle.svg" alt="arrow" width="26" /></a>
  </div>
</div>
<main data-providerid="<?= $providerid ?>" data-providertype="<?= $provider->field_miceprovsubcat ?>">
<?php if($provider->field_mice_prove_descrip != ''){?>
  <div class="introtxt-container">
  <div class="intro-txt" data-aos="zoom-in" data-aos-delay="300">
  <p><?=$provider->field_mice_prove_descrip?></p>  
  </div>
  </div>
<?php }?>
<small class="recomendacion"><?=$mice->miceinfo->field_mice_ui_40?></small>
  <h2 class="imagesTitle">Imágenes</h2>
  <div class="gallery others" id="gallery">
    <div id="principal_img">
    </div>
    <div class="dots">
      <ul class="gallery_dot">
      </ul>
      <small class="imageText"></small>
    </div>
  </div>
  <div class="relProviders">
    <h2>Proveedores similares</h2>
    <ul class="grid-providers">
    </ul>
  </div>
</main>

<? include 'includes/imports.php'?>