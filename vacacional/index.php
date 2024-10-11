<?php 
$bodyClass = 'home';
include "includes/head.php";
$sliders = $vacacional->getSlidersHome();
$banners = $vacacional->getBannersHome();
?>
<a href="<?=$lang?>/blog/all/-vienes-la-cop-16--bogota-tu-casa--te-recibe-con-un-tesoro-natural-inexplorado--all-4460" id="parallax-container">
  <div class="logos">
    <img src="https://bogotadc.travel/drpl/sites/default/files/2024-07/Logo%20Tu%20Casa_Mesa%20de%20trabajo%201.png" alt="Logo" class="parallaxLogo">
  
  </div>
  <div style="-webkit-animation: slide-in-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;animation: slide-in-top 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;" class="titleParallax">
    <h2 >¿Vienes a la COP 16? Bogotá, tu casa, te recibe con un tesoro natural inexplorado.</h2>
    <img src="images/logocop.png?v=<?=time()?>" alt="Logo COP 16">
  </div>
  <div style="-webkit-animation: kenburns-top-left 1s ease-out .5s both;animation: kenburns-top-left 1s ease-out .5s both;">
    <div class="parallax-layer" style="background-image: url(images/parallax/4.webp);" alt="4.png"></div>
  </div>
  <div style="-webkit-animation: slide-in-blurred-bottom 0.6s cubic-bezier(0.230, 1.000, 0.320, 1.000) .5s both;animation: slide-in-blurred-bottom 0.6s cubic-bezier(0.230, 1.000, 0.320, 1.000) .5s both;">
    <div class="parallax-layer" style="background-image: url(images/parallax/3.webp?v=<?=time()?>);" alt="3.png"></div>
  </div>
  <div style="-webkit-animation: slide-in-left 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) .5s both;animation: slide-in-left 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) .5s both;">
    <div class="parallax-layer" style="background-image: url(images/parallax/2.webp);" alt="2.png"></div>
  </div>
  <div style="-webkit-animation: slide-in-right 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) .5s both;animation: slide-in-right 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) .5s both;">
    <div class="parallax-layer" style="background-image: url(images/parallax/1.webp);" alt="1.png"></div>
  </div>
  <div class="arrow"><svg width="278" height="486" viewBox="0 0 278 486" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M267.14 217.43L60.01 10.3C46.28 -3.43 24.02 -3.43 10.3 10.3C-3.42 24.03 -3.43 46.28 10.3 60.01L193.29 243L10.3 425.99C-3.43 439.72 -3.43 461.97 10.3 475.7C24.03 489.43 46.28 489.43 60.01 475.7L267.14 268.57C274.19 261.52 277.59 252.23 277.4 243C277.59 233.77 274.18 224.47 267.14 217.43Z" fill="white"/></svg></div>
  <div class="downArrow"><svg width="278" height="278" viewBox="0 0 278 278" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M164.275 267.435L371.405 60.305C385.135 46.575 385.135 24.315 371.405 10.595C357.675 -3.12499 335.425 -3.13499 321.695 10.595L138.705 193.585L-44.2849 10.595C-58.0149 -3.135 -80.265 -3.135 -93.995 10.595C-107.725 24.325 -107.725 46.575 -93.995 60.305L113.135 267.435C120.185 274.485 129.475 277.885 138.705 277.695C147.935 277.885 157.235 274.475 164.275 267.435Z" fill="white"/></svg></div>
</a>
<main>
  <div class="flexbanner">
    <video src="video/video.mp4" loop autoplay muted></video>
  </div>
 
  <!-- <div class="banners_home">
    <a target="_blank" href="<?=$os == "iOS" || $browser == "Safari" ? "https://apps.apple.com/app/visit-bogot%C3%A1/id1478036261" : "https://play.google.com/store/apps/details?id=com.servinf.test.bogotadctravel"?>">
      <img src="images/appbanner.jpg" alt="app Banner">
    </a>
  </div> -->
    <section class="descubre container">
      <h2><img src="images/descubre_bogotaic.svg" alt="descubre"><?=$descubre_bogota?></h2>
      <section class="splide" id="bogota-natural" aria-label="Basic Structure Example">
        <div class="splide__arrows">
          <button class="splide__arrow splide__arrow--prev">
            <img src="images/ep_arrow-left-bold.svg" alt="left">
          </button>
          <button class="splide__arrow splide__arrow--next">
            <img src="images/ep_arrow-right-bold.svg" alt="right">
          </button>
        </div>
        <div class="splide__track">
          <ul class="splide__list">
          </ul>
        </div>
      </section>
    </section>
    <?php if($banners[0]->field_image != ""){ ?>
      <div class="banners_home">
      <video src="video/colibri.webm" muted autoplay class="img-naturaleza"></video>
        <a href="<?=$banners[0]->field_link?>">
          <img src="https://bogotadc.travel<?=$banners[0]->field_image?>" alt="<?=$banners[0]->title?>">
        </a>
      </div>
    <?php } ?>
  <div class="bg-noche" style="background-image: url(images/bog_noche.png);">
  <section class="rutas container">
  <h2 ><img src="images/rutas.svg" alt="RT"><?=$pi_bogota[103]?><a href="/<?=$lang?>/rutas-turisticas" class="wait all"><?=$ver_rutas?></a></h2>
    <div class="container grid-rutas"></div>
  </section>
  <section class="evento container">
    <h2><img src="images/eventos_icW.svg" alt="descubre"><?=$eventos?><a href="/<?=$lang?>/eventos/agenda-general-148" class="wait all"><?=$ver_eventos?></a></h2>
    <div class="container grid-eventos"></div>
  </section>
    <!-- <section class="exp-home container">
      <h2><img src="images/exp_tur.svg" alt="descubre"><?=$experiencias_turisticas?></h2>
      <div class="exp-content">
        <article class="category">
          <div class="tagFlag">
          <svg width="543" height="52" viewBox="0 0 543 52" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 5C0 2.23858 2.23858 0 5 0H537.185C540.834 0 543.254 3.78219 541.725 7.09529L533.967 23.9047C533.353 25.2342 533.353 26.7658 533.967 28.0953L541.725 44.9047C543.254 48.2178 540.834 52 537.185 52H4.99999C2.23856 52 0 49.7614 0 47V5Z" fill="#35498e"/><path d="M29.375 13.75L32 16.375L37.25 11.125M29.375 26L32 28.625L37.25 23.375M29.375 38.25L32 40.875L37.25 35.625M43.375 26H62.625M43.375 38.25H62.625M43.375 13.75H62.625" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
          <span><?=$Porcategoría?></span>
          </div>
          <section class="splide" id="porcategoria" aria-label="Basic Structure Example">
        <div class="splide__arrows">
          <button class="splide__arrow splide__arrow--prev">
            <img src="images/ep_arrow-left-bold.svg" alt="left">
          </button>
          <button class="splide__arrow splide__arrow--next">
            <img src="images/ep_arrow-right-bold.svg" alt="right">
          </button>
        </div>
        <div class="splide__track">
          <ul class="splide__list">
          </ul>
        </div>
      </section>
        </article>
        <article class="zone">
        <div class="tagFlag">
          <svg width="543" height="52" viewBox="0 0 543 52" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 5C0 2.23858 2.23858 0 5 0H537.185C540.834 0 543.254 3.78219 541.725 7.09529L533.967 23.9047C533.353 25.2342 533.353 26.7658 533.967 28.0953L541.725 44.9047C543.254 48.2178 540.834 52 537.185 52H4.99999C2.23856 52 0 49.7614 0 47V5Z" fill="#35498e"/><path d="M29.375 13.75L32 16.375L37.25 11.125M29.375 26L32 28.625L37.25 23.375M29.375 38.25L32 40.875L37.25 35.625M43.375 26H62.625M43.375 38.25H62.625M43.375 13.75H62.625" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
          <span><?=$Porzona?></span>
          </div>
          <section class="splide" id="porzona" aria-label="Basic Structure Example">
        <div class="splide__arrows">
          <button class="splide__arrow splide__arrow--prev">
            <img src="images/ep_arrow-left-bold.svg" alt="left">
          </button>
          <button class="splide__arrow splide__arrow--next">
            <img src="images/ep_arrow-right-bold.svg" alt="right">
          </button>
        </div>
        <div class="splide__track">
          <ul class="splide__list">
          </ul>
        </div>
      </section>
        </article>
      </div>
    </section> -->
    <!-- <section class="mice container">
      <h4><img src="images/mice.svg" alt="descubre"><?=$turismo_mice_en_bogota?></h4>
      <div class="mice-articles">
        <article>
          <a href="/<?=$lang?>/mice/por-que-bogota">
            <img src="images/porqueBog.png" alt="¿Porqué Bogotá?">
            <span><?=$porque_bogota?></span>
          </a>
        </article>
        <article>
          <a href="/<?=$lang?>/mice/aeropuerto-1351">
            <img src="images/lugar.png" alt="Encuentra un lugar para tu evento">
            <span>Aeropuerto</span>
          </a>
        </article>
        <article>
          <a href="/<?=$lang?>/mice/movilidad-1352">
            <img src="images/proveedores.png" alt="Encuentra proveedores para tu evento">
            <span>Movilidad</span>
          </a>
        </article>
      </div>
    </section> -->
  </div>
  <section class="blog container">
    <h2><img src="images/blogic.svg" alt="descubre"><?=$blog_y_multimedia?></h2>
    <h3><?=$publicaciones_recientes?> <a href="/<?=$lang?>/blog" class="wait all"><?=$ver_blog?></a></h3>
    <div class="container grid-blogs"></div>
  </section>
</main>
 <!-- GSAP -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <!-- ScrollTrigger Plugin -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
  
<? include 'includes/imports.php'?>

</body>

</html>