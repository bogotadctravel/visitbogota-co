<?php

include 'head.php';
include 'menu_mobile.php';
include 'menu.php';
?>
<header data-aos="fade-down">
  <div class="top">
    <div class="container">
      <div class="links">
        <a href="/<?=$lang?>/mice" class="uppercase ms700">MICE</a>
        <a href="/<?=$lang?>/banco-imagenes/" class="uppercase ms700">profesionales</a>
      </div>
      <div class="right">
        <?php if($json_data["enableTranslates"]){ ?>
        <ul class="languages">
          <li class="uppercase">
            <img src="<?=$include_level?>img/flag_<?= $lang ?>.svg" alt="<?= $lang ?>">
            <?= $lang ?>
            <ul>
              <?php 
                      $json = file_get_contents("menu.json");
                      $json_data = json_decode($json,true);
                      for ($i=0; $i < count($json_data["enableTranslates"]); $i++) {
                    ?>
              <li><a href="javascript:changeLang('<?=$json_data["enableTranslates"][$i]?>');" class="uppercase"><img
                    src="<?=$include_level?>img/flag_<?=$json_data["enableTranslates"][$i]?>.svg" alt="
                  <?=$json_data["enableTranslates"][$i]?>">
                  <?=$json_data["enableTranslates"][$i]?>
                </a></li>
              <?php } ?>
              <li><a href="/es/preguntas-frecuentes#lsc">LSC</a></li>
            </ul>
          </li>
        </ul>
        <?php } ?>
        <form action="/<?= $lang ?>/buscador" id="search_form" class="search_form" autocomplete="off">
          <span>
            <input type="search" aria-label="search" name="search" id="search_" />
            <span class="op">
              <img src="<?=$include_level?>img/lupa.svg" alt="lupa" />
              <!-- <label for="search">Buscar</label> -->
            </span>
          </span>
        </form>
        <button type="button" id="openCart"><img src="img/flash_cards.svg" alt="flash_cards"></button>
      </div>
    </div>
  </div>
  <div class="bottom">
    <div class="container">
      <a href="/<?=$lang?>/">
        <img src="<?=$include_level?>img/logo.svg" alt="BogotaDCTravel" class="logo" />
      </a>
      <?php
        if(isset($project_folder) && file_exists("menu.json")){
        $json = file_get_contents("menu.json");
        $json_data = json_decode($json,true);
        ?>
      <nav>
        <ul>
          <?php 
            for ($i=0; $i < count($json_data["menuItems"]); $i++) { 
            ?>
          <? if(count($json_data["menuItems"][$i]["children"]) > 0 && is_array($json_data["menuItems"][$i]["children"])){ ?>
          <li class="ms700 <?=$json_data["menuItems"][$i]["class"]?>">
            <?=$json_data["menuItems"][$i][$lang]["title"]?>
            <ul>
              <? for ($menuCount = 0; $menuCount < count($json_data["menuItems"][$i]["children"]); $menuCount++) { ?>
              <li class="ms700 <?=$json_data["menuItems"][$i]["class"]?>">
                <a href="<?=$json_data["menuItems"][$i]["children"][$menuCount][$lang]["link"]?>" class="wait ms700">
                  <?=$json_data["menuItems"][$i]["children"][$menuCount][$lang]["title"]?>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>

          <? }else{ ?>
          <li>
            <a href="<?=$json_data["menuItems"][$i][$lang]["link"]?>" class="wait ms700">
              <?=$json_data["menuItems"][$i][$lang]["title"]?>
            </a>

          </li>
          <? } ?>
          <? }?>

        </ul>
      </nav>
      <?php }else{ ?>
      <?php
        $json = file_get_contents("menu.json");
        $json_data = json_decode($json,true);
        ?>
      <nav>
        <ul>
          <?php 
            for ($i=0; $i < count($json_data["menuItems"]); $i++) { 
            ?>
          <? if(count($json_data["menuItems"][$i]["children"]) > 0 && is_array($json_data["menuItems"][$i]["children"])){ ?>
          <li class="ms700 <?=$json_data["menuItems"][$i]["class"]?>">
            <?=$json_data["menuItems"][$i][$lang]["title"]?>
            <ul>
              <? for ($menuCount = 0; $menuCount < count($json_data["menuItems"][$i]["children"]); $menuCount++) { ?>
              <li class="ms700 <?=$json_data["menuItems"][$i]["class"]?>">
                <a href="<?=$json_data["menuItems"][$i]["children"][$menuCount][$lang]["link"]?>" class="wait ms700">
                  <?=$json_data["menuItems"][$i]["children"][$menuCount][$lang]["title"]?>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>

          <? }else{ ?>
          <li>
            <a href="<?=$json_data["menuItems"][$i][$lang]["link"]?>" class="wait ms700">
              <?=$json_data["menuItems"][$i][$lang]["title"]?>
            </a>
          </li>
          <? } ?>
          <? }?>

        </ul>
      </nav>
      <?php } ?>
      <button id="menuBtn">
        <span></span>
        <span></span>
        <small>
          <?= $b->generalInfo->field_texto_menu_ ?>
        </small>
      </button>
    </div>
  </div>
  <aside class="cart" id="cart">
  <button type="button" onclick="document.querySelector('#cart').classList.remove('active')"><img src="/img/close_menu.svg" alt="close Menu" width="25" height="25"></button>
  <img src="/tarjeta-ciudad/img/logo_w.svg" alt="logo" class="logoCart">
  <div class="cart-content">
    <div class="cart-item" data-quantity="1" data-unit-price="150000">
      <div class="flex">
        <h3>Plan Bogotá card</h3>
        <div class="quantity-container">
          <button class="quantity-button" onclick="decrementQuantity(this)">-</button>
          <span class="quantity">1</span>
          <button class="quantity-button" onclick="incrementQuantity(this)">+</button>
        </div>
        <button type="button" onclick="removeItem(this)"><img src="/tarjeta-ciudad/img/delete.svg" alt="delete"></button>
      </div>
      <h4 class="unit-price">COP $150.000</h4>
    </div>
    <!-- Agrega más cart-items aquí con los precios unitarios correspondientes -->
  </div>
  <a href="/<?=$lang?>/tarjeta-ciudad/checkout" class="payCart ms900">FINALIZAR COMPRA</a>
</aside>

</header>