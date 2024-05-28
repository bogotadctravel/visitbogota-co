<?php
include 'head.php';
if($lang == "es"){
  $restaurantes = "Restaurantes";
  $hospedajes = "Hospedajes";
  $blog_y_multimedia = "Blog";
  $eventos = "Eventos";
  $turismoMICE = "Turismo MICE";
  $bancoMultimedia = "Banco multimedia";
  $aeropuerto = "Aeropuerto el Dorado";
  $ver_eventos = "Ver eventos";
  $ver_rutas = "Ver rutas";
  $ver_blog = "Ver blog";
}else{
  $restaurantes = "Restaurants";
  $hospedajes = "Accommodations";
  $blog_y_multimedia = "Blog";
  $ver_rutas = "View routes";
  $eventos = "Events";
  $turismoMICE = "MICE Tourism"; // MICE Tourism
  $bancoMultimedia = "Multimedia Bank"; // Multimedia Bank
  $aeropuerto = "EL DORADO AIRPORT";
  $ver_eventos = "View events";
  $ver_blog = "View blog";
}
include 'menu_mobile.php';
include 'menu.php';
?>
<script>
  const shareData = {
  title: "Sitio web oficial de turismo de Bogotá",
  url: window.location.href,
};
const shareWeb = async () => {
  try {
    await navigator.share(shareData);
  } catch (err) {
    console.error(`Error: ${err}`);
  }
}
</script>
<header data-aos="fade-down">
    <div class="top">
      <div class="container">
        <div class="links">
          <!-- <button type="button" onclick="shareWeb()"><svg width="25" height="26" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.9688 16.1635C17.384 16.1664 16.8073 16.3006 16.2813 16.5562C15.7553 16.8118 15.2934 17.1821 14.9297 17.6401L9.21876 14.0697C9.4269 13.398 9.4269 12.679 9.21876 12.0072L14.9297 8.43693C15.5093 9.15467 16.3243 9.6441 17.2303 9.8185C18.1362 9.9929 19.0746 9.84102 19.8793 9.38976C20.684 8.9385 21.303 8.217 21.6267 7.35306C21.9503 6.48912 21.9577 5.5385 21.6476 4.66961C21.3375 3.80072 20.7299 3.06963 19.9323 2.60586C19.1348 2.14208 18.1988 1.97556 17.2903 2.13578C16.3817 2.29601 15.5592 2.77264 14.9684 3.48124C14.3776 4.18984 14.0567 5.08468 14.0625 6.00724C14.0662 6.3566 14.1188 6.70372 14.2188 7.03849L8.50782 10.6088C8.00364 9.9741 7.31449 9.51197 6.53591 9.28646C5.75732 9.06095 4.92787 9.08323 4.16252 9.35022C3.39716 9.61721 2.73383 10.1157 2.26445 10.7765C1.79507 11.4374 1.54291 12.2279 1.54291 13.0385C1.54291 13.8491 1.79507 14.6396 2.26445 15.3004C2.73383 15.9613 3.39716 16.4598 4.16252 16.7268C4.92787 16.9938 5.75732 17.016 6.53591 16.7905C7.31449 16.565 8.00364 16.1029 8.50782 15.4682L14.2188 19.0385C14.1188 19.3733 14.0662 19.7204 14.0625 20.0697C14.0625 20.8423 14.2916 21.5976 14.7208 22.2399C15.1501 22.8823 15.7601 23.383 16.4739 23.6786C17.1877 23.9743 17.9731 24.0517 18.7308 23.9009C19.4886 23.7502 20.1846 23.3782 20.7309 22.8319C21.2772 22.2856 21.6492 21.5896 21.7999 20.8318C21.9507 20.0741 21.8733 19.2887 21.5777 18.5749C21.282 17.8611 20.7813 17.251 20.139 16.8218C19.4966 16.3926 18.7413 16.1635 17.9688 16.1635ZM17.9688 3.66349C18.4323 3.66349 18.8854 3.80095 19.2709 4.05848C19.6563 4.31602 19.9567 4.68206 20.1341 5.11033C20.3115 5.53859 20.3579 6.00984 20.2675 6.46448C20.177 6.91913 19.9538 7.33674 19.626 7.66452C19.2983 7.9923 18.8806 8.21552 18.426 8.30596C17.9714 8.39639 17.5001 8.34998 17.0718 8.17258C16.6436 7.99519 16.2775 7.69479 16.02 7.30936C15.7625 6.92393 15.625 6.47079 15.625 6.00724C15.625 5.38564 15.8719 4.7895 16.3115 4.34996C16.751 3.91042 17.3472 3.66349 17.9688 3.66349ZM5.46876 15.3822C5.00521 15.3822 4.55207 15.2448 4.16664 14.9872C3.78121 14.7297 3.48081 14.3637 3.30341 13.9354C3.12602 13.5071 3.07961 13.0359 3.17004 12.5812C3.26048 12.1266 3.4837 11.709 3.81148 11.3812C4.13925 11.0534 4.55687 10.8302 5.01151 10.7398C5.46616 10.6493 5.93741 10.6958 6.36567 10.8731C6.79394 11.0505 7.15998 11.3509 7.41751 11.7364C7.67505 12.1218 7.81251 12.5749 7.81251 13.0385C7.81251 13.6601 7.56558 14.2562 7.12604 14.6958C6.6865 15.1353 6.09036 15.3822 5.46876 15.3822ZM17.9688 22.4135C17.5052 22.4135 17.0521 22.276 16.6666 22.0185C16.2812 21.761 15.9808 21.3949 15.8034 20.9667C15.626 20.5384 15.5796 20.0671 15.67 19.6125C15.7605 19.1579 15.9837 18.7402 16.3115 18.4125C16.6393 18.0847 17.0569 17.8615 17.5115 17.771C17.9662 17.6806 18.4374 17.727 18.8657 17.9044C19.2939 18.0818 19.66 18.3822 19.9175 18.7676C20.175 19.1531 20.3125 19.6062 20.3125 20.0697C20.3125 20.6913 20.0656 21.2875 19.626 21.727C19.1865 22.1666 18.5904 22.4135 17.9688 22.4135Z" fill="#373737"/></svg></button> -->
          <a href="https://eldorado.aero" class="uppercase ms700" target="_blank"><?=$aeropuerto?></a>
          <!-- <a href="/<?=$lang?>/mice" class="uppercase ms700"><?=$turismoMICE?></a> -->
          <a href="/<?=$lang?>/banco-imagenes/" class="uppercase ms700"><?=$bancoMultimedia?></a>
          <a href="/<?=$lang?>/ruta-leyenda-el-dorado/inicio" class="uppercase ms700">Ruta leyenda el dorado</a>
        </div>
          <div class="right">
            <?php 
              if (isset($project_folder) && file_exists("menu.json")) {
                $json = file_get_contents("menu.json");
                $json_data = json_decode($json, true);
              } else {
                $json = file_get_contents("../menu.json");
                $json_data = json_decode($json, true);
              }
            if($json_data["enableTranslates"]){ ?>
              <ul class="languages">
                <li class="uppercase">
                  <img src="<?=$include_level?>img/flag_<?= $lang ?>.svg" alt="<?= $lang ?>"> <?= $lang ?>
                  <ul>
                    <?php 
                      for ($i=0; $i < count($json_data["enableTranslates"]); $i++) {
                    ?>
                      <li><a href="javascript:changeLang('<?=$json_data["enableTranslates"][$i]?>');" class="uppercase"><img src="<?=$include_level?>img/flag_<?=$json_data["enableTranslates"][$i]?>.svg" alt="<?=$json_data["enableTranslates"][$i]?>"> <?=$json_data["enableTranslates"][$i]?></a></li>
                    <?php } ?>
                      <!-- <li><a href="/<?= $lang ?>/informacion-al-viajero#lsc">LSC</a></li> -->
                  </ul>
                </li>
              </ul>
            <?php } ?>
          
        </div>
      </div>
    </div>
    <div class="bottom">
      <div class="container">
        <a href="/<?=$lang?>/">
          <img src="<?=$include_level?>img/logo_bog.svg" alt="BogotaDCTravel" class="logo" />
      </a>
      <div class="right">

        <?php
          if (isset($project_folder) && file_exists("menu.json")) {
              $json = file_get_contents("menu.json");
              $json_data = json_decode($json, true);
          ?>
              <nav>
                  <ul>
                      <?php
                      for ($i = 0; $i < count($json_data["menuItems"]); $i++) {
                      ?>
                          <?php if (count($json_data["menuItems"][$i]["children"]) > 0 && is_array($json_data["menuItems"][$i]["children"])) { ?>
                              <li class="ms700 <?= $json_data["menuItems"][$i]["class"] ?>">
                                  <?= $json_data["menuItems"][$i][$lang]["title"] ?>
                                  <ul>
                                      <?php for ($menuCount = 0; $menuCount < count($json_data["menuItems"][$i]["children"]); $menuCount++) { ?>
                                          <li class="ms700 <?= $json_data["menuItems"][$i]["class"] ?>">
                                              <a href="<?= isset($json_data["menuItems"][$i]["children"][$menuCount][$lang]["link"]) ? $json_data["menuItems"][$i]["children"][$menuCount][$lang]["link"] : '/' ?>" class="wait ms700"><?= $json_data["menuItems"][$i]["children"][$menuCount][$lang]["title"] ?></a>
                                          </li>
                                      <?php } ?>
                                  </ul>
                              </li>
                          <?php } else { ?>
                              <li>
                                  <a href="<?= isset($json_data["menuItems"][$i][$lang]["link"]) ? $json_data["menuItems"][$i][$lang]["link"] : '/' ?>" class="wait ms700"><?= $json_data["menuItems"][$i][$lang]["title"] ?></a>
                              </li>
                          <?php } ?>
                      <?php } ?>
  
                  </ul>
              </nav>
          <?php } else {
             $json = file_get_contents("../menu.json");
             $json_data = json_decode($json, true);
            ?>
              <nav>
                  <ul>
                      <?php
                      for ($i = 0; $i < count($json_data["menuItems"]); $i++) {
                      ?>
                          <?php if (is_array($json_data["menuItems"][$i]["children"]) && count($json_data["menuItems"][$i]["children"]) > 0 ) { ?>
                              <li class="ms700 <?= $json_data["menuItems"][$i]["class"] ?>">
                                  <?= $json_data["menuItems"][$i][$lang]["title"] ?>
                                  <ul>
                                      <?php for ($menuCount = 0; $menuCount < count($json_data["menuItems"][$i]["children"]); $menuCount++) { ?>
                                          <li class="ms700 <?= $json_data["menuItems"][$i]["class"] ?>">
                                              <a href="<?= isset($json_data["menuItems"][$i]["children"][$menuCount][$lang]["link"]) ? $json_data["menuItems"][$i]["children"][$menuCount][$lang]["link"] : '/' ?>" class="wait ms700"><?= $json_data["menuItems"][$i]["children"][$menuCount][$lang]["title"] ?></a>
                                          </li>
                                      <?php } ?>
                                  </ul>
                              </li>
                          <?php } else { ?>
                              <li>
                                  <a href="<?= isset($json_data["menuItems"][$i][$lang]["link"]) ? $json_data["menuItems"][$i][$lang]["link"] : '' ?>" class="wait ms700"><?= $json_data["menuItems"][$i][$lang]["title"] ?></a>
                              </li>
                          <?php } ?>
                      <?php } ?>
  
                  </ul>
              </nav>
          <?php } ?>
          <button id="menuBtn">
              <span></span>
              <span></span>
              <small>Menú</small>
          </button>
          <form action="/<?= $lang ?>/buscador" id="search_form" class="search_form" autocomplete="off">
            <span>
            <input type="search" aria-label="search" name="search" id="search" />
              <span class="op">
                <img src="<?=$include_level?>img/lupa_gray.svg" alt="lupa" />
                <!-- <label for="search">Buscar</label> -->
              </span>
            </span>
          </form>
      </div>
      </div>
    </div>
    
  </header>