<?php
$bodyClass="internVenue-body intern-hotelnew font1";
include 'includes/head.php';
$hotelID = $_GET['restaurantid'];
$venue = $mice->getRestaurants("all","all","all","all",$hotelID);
$venue = $venue[0];
?>
<div class="banner-internVenue" style="
    background-image: url(<?= $venue->field_img != "" ? $mice->absoluteURL($venue->field_img) : " /img/noimg.png" ?>);
  ">
  <div class="info">
    <h1 class="uppercase">
      <?= $venue->title ?>
    </h1>
  </div>
</div>
<main data-venueid="<?= $hotelID ?>">
  <div class="info-container">
    <?php if ($venue->field_hadress != '') { ?>
    <div class="address">
      <img src="/../vacacional/images/descubre.svg" alt="address" /><span>
        <?= $venue->field_hadress ?>
      </span>
    </div>
    <?php } ?>
    <?php if ($venue->field_htel != '') { ?>
    <div class="phone">
      <img src="../img/whatsapp.svg" alt="phone" /><span>Tel:
        <?= $venue->field_htel ?>
      </span>
    </div>
    <?php } ?>
    <?php if ($venue->field_hweb != '') { ?>

    <div class="email">
      <a href="<?= $venue->field_hweb ?>" target="_blank" rel="noopener noreferrer">
        <span>
          Ir al sitio web del restaurante
        </span>
      </a>
    </div>
    <?php } ?>
  </div>
  <div class="introtxt-container">
    <div class="intro-txt" data-aos="zoom-in" data-aos-delay="300">
      <?=$venue->field_desc?>
    </div>
    <?php 
              $galItems = explode(",", $venue->field_galery);
    if($galItems[0] != ''){
    ?>
    <div class="gallery-container">
      <div class="gallery-slider">
        <section class="splide" aria-label="Basic Structure Example">
          <div class="splide__arrows splide__arrows--ltr">
            <button class="splide__arrow splide__arrow--prev" type="button" aria-label="Previous slide"
              aria-controls="splide01-track">
              <img src="img/arrowleftnew.svg" alt="arrowleftnew">
            </button>
            <button class="splide__arrow splide__arrow--next" type="button" aria-label="Next slide"
              aria-controls="splide01-track">
              <img src="img/arrowrightnew.svg" alt="arrowrightnew">
            </button>
          </div>
          <div class="splide__track">
            <ul class="splide__list">
              <?php 
              for ($i=0; $i < count($galItems) ; $i++) { 
                $galItem = $galItems[$i];
              ?>
              <li class="splide__slide"><img src="https://files.visitbogota.co<?=$galItem?>" alt=""></li>
              <?php 
              }
              ?>
            </ul>
          </div>
        </section>
      </div>
    </div>
    <?php } ?>

    <div class="recomendacion">
      <small>El contenido de este sitio web es de carácter informativo, su propósito es integrar las diferentes ofertas, tanto hoteles como restaurantes en Bogotá. Los trámites relacionados con compras, reservas, cancelaciones y cualquier negociación en general son adelantados directamente entre usuarios y empresarios sin intervención de la entidad. Las solicitudes y quejas relacionadas con los productos y servicios publicados en esta plataforma, son responsabilidad exclusiva de los empresarios y usuarios como partes de la relación comercial.</small>
    </div>
    <div class="relHotels">
      <h2>
      <img src="../img/Restaurantes_Flag.svg" alt="restaurantes">
        Más Restaurantes En Bogotá
      </h2>
      <ul class="grid-hotels"></ul>
    </div>
</main>
<script src="
https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css
" rel="stylesheet">
<script>
  new Splide('.splide', {
    classes: {
      arrows: 'splide__arrows your-class-arrows',
      arrow: 'splide__arrow your-class-arrow',
      prev: 'splide__arrow--prev your-class-prev',
      next: 'splide__arrow--next your-class-next',
    },
  }).mount();
</script>
<? include 'includes/imports.php'?>