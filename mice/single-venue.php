<?php
$bodyClass="internVenue-body graybg font1";
include 'includes/head.php';
$venueid = $_GET['venueid'];
$venue = $mice->get_mice_single_venues($venueid);
?>
<div class="banner-internVenue" style="
    background-image: url(<?= $venue->field_mainimg != "" ? $mice->absoluteURL($venue->field_mainimg) : "../img/noimg.png" ?>);
  ">
  <div class="info">
    <h1 class="uppercase"><?= $venue->title ?></h1>
    <h2>Hotel</h2>
    <div class="info-container">
      <div class="flex">
        <?php if ($venue->field_miceaddress != '') { ?>
          <div class="address">
            <img src="img/address.svg" alt="address" /><span><?= $venue->field_miceaddress ?></span>
          </div>
        <?php } ?>
        <?php if ($venue->field_micephone != '') { ?>
          <div class="phone">
            <img src="img/tel.svg" alt="address" /><span>Tel:<?= $venue->field_micephone ?></span>
          </div>
        <?php } ?>
        <?php if ($venue->field_miceemail != '') { ?>
          <div class="email">
            <img src="img/email.svg" alt="address" /><span><?= $venue->field_miceemail ?></span>
          </div>
        <?php } ?>
        <?php if ($venue->field_mice_venues_url_web != '') { ?>
          <div class="email">
            <a href="<?= $venue->field_mice_venues_url_web ?>" target="_blank">
              <span><?= $venue->field_mice_venues_url_web ?></span>
          </a>
          </div>
        <?php } ?>
      </div>
      <!-- <ul class="infodestacada">
        <?php
        $tableTitle = explode(',', $venue->field_micetabletitles);
        $tableValues = explode(',', $venue->field_micetablevalues);
        for ($venuei = 0; $venuei < count($tableTitle); $venuei++) {
        ?>
          <li>
            <span><?= $tableTitle[$venuei] ?></span>
            <p><?= $tableValues[$venuei] ?></p>
          </li>
        <?php

        }
        ?>
      </ul> -->
    </div>
    <div class="flex infoButtons">
      <?php if($venue->field_mice_venues_ubicacion != ""){ ?>
        <a target="_blank" href="http://maps.google.com/maps?q=<?=$venue->field_mice_venues_ubicacion?>" class="uppercase btn orange"><?=$mice->miceinfo->field_mice_ui_39?></a>
      <?php } ?>
      <a href="#salas" class="uppercase btn blue"><?= $mice->miceinfo->field_mice_ui_9 ?>
        <img src="img/arrowcircle.svg" alt="arrow" width="26" /></a>

    </div>
  </div>
</div>
<main data-venueid="<?= $venueid ?>" data-venuetype="<?= $venue->field_venue_type ?>" data-venuezone="<?= $venue->field_zone_rel ?>" data-aforo="2000">
<div class="introtxt-container">
<div class="intro-txt" data-aos="zoom-in" data-aos-delay="300">
<?=$venue->body?>  
</div>
<small class="recomendacion"><?=$mice->miceinfo->field_mice_ui_40?></small>
<div class="salas" id="salas">
    <h2><?=$mice->miceinfo->field_mice_ui_20?></h2>
    <div class="sections">
      <div class="left">
        <ul>
        </ul>
      </div>
      <div class="right">
        <section class="galleryVenue gallery">
          <div id="salon_principal_img">
          </div>
          <div class="dots">
            <ul class="gallery_dot">
            </ul>
            <small class="imageText"></small>
          </div>
          <div class="disinfo">
            <h2 class="uppercase titledisinfo"><?=$mice->miceinfo->field_mice_ui_24?></h2>
            <ul></ul>
            <div class="colors">
              <small><?=$mice->miceinfo->field_mice_ui_29?></small>
              <ul>
                <li>
                  <div class="lineOrange"></div>
                  <span><?=$mice->miceinfo->field_mice_ui_30?></span>
                </li>
                <li>
                  <div class="lineGreen"></div>
                  <span><?=$mice->miceinfo->field_mice_ui_31?></span>
                </li>
                <li>
                  <div class="lineBlue"></div>
                  <span><?=$mice->miceinfo->field_mice_ui_32?></span>
                </li>
              </ul>
            </div>
            <div class="area">
              <h3><?=$mice->miceinfo->field_mice_ui_25?></h3>
              <span class="metroscuadrados"></span>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <div class="images">
    <h2><?=$mice->miceinfo->field_mice_ui_26?></h2>
 
      <div class="gallery others">
        <div id="principal_img">
        </div>
        <div class="dots">
          <ul class="gallery_dot"></ul>
          <small class="imageText"></small>
        </div>
      </div>
   
  </div>
  <div class="relVenues">
    <h2><?=$mice->miceinfo->field_mice_ui_3?> similares</h2>
    <ul class="grid-venues"></ul>
  </div>
</main>
<? include 'includes/imports.php'?>