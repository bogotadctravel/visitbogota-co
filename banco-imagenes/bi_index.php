<?php
  $bodyClass='home';
  include "includes/head.php";
  $products = $bi->products();
  shuffle($products);
  $infoGnrl = $bi->BIgeneralInfo; 
  $images = $bi->getImages();
?>
<main>
  <section
    class="banner"
    style="background-image: url(https://files.visitbogota.co<?=$infoGnrl->field_bi_imagen_banner?>)"
  >
    <div class="search-form">
      <?=$infoGnrl->field_bi_texto_banner?>
      <form action="/<?=$lang?>/banco-imagenes/resultados/" id="searchForm">
        <div class="autocompleteForm">
          <div class="autocomplete">
            <input
              type="search"
              aria-label="searchbi"
              name="searchbi"
              id="searchbi"
              autocomplete="off"
              placeholder="<?=$infoGnrl->field_bi_placesearch?>"
              onkeydown="if(event.keyCode == 13) document.getElementById('searchForm').submit()"
            />
            <button type="submit">
              <img src="img/lupaBlack.svg" alt="lupa" />
            </button>
          </div>
          <div class="types-checks">
            <div class="politics_checkbox">
              <input type="checkbox" name="imagenes" id="imagenes" />
              <span class="politics_checkbox_mark"></span>
              <label for="imagenes">Imágenes</label>
            </div>
            <div class="politics_checkbox">
              <input type="checkbox" name="videos" id="videos" />
              <span class="politics_checkbox_mark"></span>
              <label for="videos">Videos</label>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
  <section class="grid">
    <?=$infoGnrl->field_bi_texto_categorias?>
    <div class="grid-layout"></div>
    <!-- <a href="" class="blue-btn uppercase"><?=$infoGnrl->field_bi_texto_vertodas?></a> -->
  </section>
  <section class="counter">
    <div class="container">
      <div class="counter-left">
        <h4>+<span id="0101"></span></h4>
        <h5><?=$infoGnrl->field_bi_ui_01?></h5>
      </div>
      <div class="counter-center">
        <h4>+<span id="0102"></span></h4>
        <h5><?=$infoGnrl->field_bi_ui_02?></h5>
      </div>
      <div class="counter-right">
        <h4>+<span id="0103"></span></h4>
        <h5><?=$infoGnrl->field_bi_ui_03?></h5>
      </div>
    </div>
  </section>
  <section class="lastphotos">
    <h2><?=$infoGnrl->field_bi_ui_04?></h2>
    <div class="container">
      <div class="splide_lastphotos">
        <div class="splide__track">
          <ul class="splide__list">
            <? for ($i=0; $i < 4; $i++) { ?>
            <li class="splide__slide">
              <a href="/<?=$lang?>/banco-imagenes/interna-<?=$images[$i]->nid?>">
                <img
                  src="/banco-imagenes/download/500/<?=$bi->replaceSpecialCharactersWithUnderscores($images[$i]->field_bifilename)?>.jpg"
                  alt="<?=$images[$i]->title?>"
                />
              </a>
            </li>
            <? } ?>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <section class="downloaded">
    <h2><?=$infoGnrl->field_bi_ui_05?></h2>
    <div class="container">
      <div class="splide_downloaded">
        <div class="splide__track">
          <ul class="splide__list">
            <? for ($i=0; $i < 7; $i++) { ?>
            <li class="splide__slide">
              <a href="/<?=$lang?>/banco-imagenes/interna-<?=$images[$i]->nid?>">
                <img
                  src="/banco-imagenes/download/500/<?=$bi->replaceSpecialCharactersWithUnderscores($images[$i]->field_bifilename)?>.jpg"
                  alt="<?=$images[$i]->title?>"
                />
              </a>
            </li>
            <? } ?>
          </ul>
        </div>
      </div>
    </div>
  </section>
</main>



<?php include 'includes/imports.php'?>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById("0101")) {
       animate(text1, 0, <?=$infoGnrl->field_bi_numero_fotos?>, 2000);
     }
     if (document.getElementById("0102")) {
       animate(text2, 0, <?=$infoGnrl->field_bi_numero_categorias?>, 2000);
     }
     if (document.getElementById("0103")) {
       animate(text3, 0, <?=$infoGnrl->field_bi_numero_atractivos?>, 2000);
     }
});
</script>
</body>

</html>