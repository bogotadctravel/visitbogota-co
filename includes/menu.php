<div id="menu">
<button id="close_menu_"><img src="<?=$include_level?>img/close_menu.svg" alt="close Menu"></button>
<form action="buscador" id="menu_search" class="menu_search" autocomplete="off">
        <img src="<?=$include_level?>img/lupa.svg" alt="lupa">
        <label for="menu_search_input">
            <input type="search" aria-label="menu_search_input" name="menu_search_input" id="menu_search_input" placeholder="<?= $b->generalInfo->field_search_txt ?>">
        </label>
    </form>
 <div class="accordions">

<?php
if(isset($project_folder) && file_exists("menu.json")){
$json = file_get_contents("menu.json");
$json_data = json_decode($json,true);
?>

<?php for ($i=0; $i < count($json_data["menuItems"]); $i++) { 
    ?>

    <? if(count($json_data["menuItems"][$i]["children"]) > 0 && is_array($json_data["menuItems"][$i]["children"])){ ?>
        <h3><?=$json_data["menuItems"][$i][$lang]["title"]?></h3>
        <div>
            <ul>
                <?php for ($menuCount = 0; $menuCount < count($json_data["menuItems"][$i]["children"]); $menuCount++) { ?>
                    <li>
                        <a href="<?=$json_data["menuItems"][$i]["children"][$menuCount][$lang]["link"]?>" class="wait"><?=$json_data["menuItems"][$i]["children"][$menuCount][$lang]["title"]?></a>
                    </li>
                <?php } ?>
                <li><a href="/<?=$lang?>/banco-imagenes/" class="uppercase ms700"><?=$bancoMultimedia?></a></li>
                <li><a href="/<?=$lang?>/ruta-leyenda-el-dorado/inicio" class="uppercase ms700">Ruta leyenda el dorado</a></li>
                <li><a href="https://eldorado.aero" class="uppercase ms700" target="_blank"><?=$aeropuerto?></a></li>
            </ul>
        </div>
    <? }else{ ?>
        <a href="<?=$json_data["menuItems"][$i][$lang]["link"]?>" class="wait"><?=$json_data["menuItems"][$i][$lang]["title"]?></a>
    <? } ?>
<?php }?>

<?}
else{
    if (!$planesMenu) {
        $planesMenu = $b->plans();
    }
    if (!$zones) {
        $zones = $b->zones();
    }
    $productsHeader = $b->productmenu('footer');
?>
        <a href="/<?= $lang ?>" class="wait">
            <?php
            switch ($lang) {
                case 'es':
                    echo 'Inicio';
                    break;
                case 'en':
                    echo 'Home';
                    break;
                case 'pt':
                    echo 'Início';
                    break;
            }
            ?>
        </a>
        <h3><?= $b->generalInfo->field_titulo_explora_bogota ?></h3>
        <div>
            <ul>
                <?php for ($explorafoot = 0; $explorafoot < count($productsHeader); $explorafoot++) {
                    echo '<li><a href="' . $lang . '/explora/' . $b->get_alias($productsHeader[$explorafoot]->title) . '/' . $productsHeader[$explorafoot]->nid . '" class="wait">' . $productsHeader[$explorafoot]->title . '</a></li>';
                } ?>
            </ul>
        </div>
        <h3><?= $b->generalInfo->field_titulo_bogota_por_zonas ?></h3>
        <div>
            <ul>
                <?php for ($zoneCount = 0; $zoneCount < count($zones); $zoneCount++) { ?>
                    <?php if ($zones[$zoneCount]->field_on_menu == "1") { ?>
                        <li>
                            <a href="<?= $lang ?>/zona/<?= $b->get_alias($zones[$zoneCount]->title) ?>/<?= $zones[$zoneCount]->nid ?>" class="wait"><?= $zones[$zoneCount]->title ?></a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <h3><?= $b->generalInfo->field_dlaciudad ?></h3>
        <div>
            <ul>
                <?php for ($menuCount = 0; $menuCount < count($planesMenu); $menuCount++) { ?>
                    <li>
                        <a href="<?= $lang ?>/descubre-bogota/<?= $b->get_alias($planesMenu[$menuCount]->title) ?>/<?= $planesMenu[$menuCount]->nid ?>" class="wait"><?= $planesMenu[$menuCount]->title ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <a href="<?= $lang ?>/informacion-al-viajero" class="wait"><?= $b->generalInfo->field_info_txt ?></a>
        <a href="<?= $lang ?>/blog" class="wait">Blog</a>
        <a href="<?= $lang ?>/mice" class="wait">Turismo de reuniones - MICE</a>
        <a href="<?= $lang ?>/ruta-leyenda-el-dorado/inicio" class="wait">Ruta leyenda el dorado</a>
        <a href="/<?=$lang?>/experiencias-turisticas" target="_blank">Plan Bogotá</a>
        <a href="/<?=$lang?>/banco-imagenes/" target="_blank">Banco de imágenes</a>
        <!-- <h3><?= $b->generalInfo->field_titulo_mas_alla ?></h3> -->
        <!-- <div>
            <ul>
                <?php
                $nearbyPlaces = $b->nearbyPlaces(1);
                for ($nearbyCount = 0; $nearbyCount < count($nearbyPlaces); $nearbyCount++) {
                    echo '<li><a href="' . $lang . 'alrededor/' . $b->get_alias($nearbyPlaces[$nearbyCount]->title) . '/' . $nearbyPlaces[$nearbyCount]->nid . '">' . $nearbyPlaces[$nearbyCount]->title . '</a></li>';
                }
                ?>
            </ul>
        </div> -->

<?
    }
?>

</div>
</div>