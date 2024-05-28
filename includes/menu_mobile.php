<div id="menu_mobile">
    <button id="close_menu"><img src="<?=$include_level?>img/close_menu_mobile.svg" alt="close Menu" width="25"
            height="25"></button>
    <img src="<?=$include_level?>img/logo.svg" alt="menuMobile" class="logo_menu_mobile" width="80" height="40">

    <a href="/<?= $lang ?>" class="homeLink wait"><img src="<?=$include_level?>img/home_menu_ico.svg" alt="home"
            width="20" height="20"></a>
    <div class="accordions">
        <?php
$json = file_get_contents("../menu.json");
$json_data = json_decode($json,true);
?>

        <?php for ($i=0; $i < count($json_data["menuItems"]); $i++) { 
    ?>

        <? if(is_array($json_data["menuItems"][$i]["children"]) && count($json_data["menuItems"][$i]["children"]) > 0){ ?>
        <h3>
            <?=$json_data["menuItems"][$i][$lang]["title"]?>
        </h3>
        <div>
            <ul class="<?= $json_data["menuItems"][$i]["class"] ?>">
                <?php for ($menuCount = 0; $menuCount < count($json_data["menuItems"][$i]["children"]); $menuCount++) { ?>
                <li>
                    <a href="<?=$json_data["menuItems"][$i]["children"][$menuCount][$lang]["link"]?>" class="wait">
                        <?=$json_data["menuItems"][$i]["children"][$menuCount][$lang]["title"]?>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <? }else{ ?>
        <a href="<?=$json_data["menuItems"][$i][$lang]["link"]?>" class="wait">
            <?=$json_data["menuItems"][$i][$lang]["title"]?>
        </a>
        <? } ?>
        <?php }?>
        <a href="/<?=$lang?>/banco-imagenes/" class="uppercase ms700"><?=$bancoMultimedia?></a>
        <a href="/<?=$lang?>/ruta-leyenda-el-dorado/inicio" class="uppercase ms700">Ruta leyenda el dorado</a>
        <a href="https://eldorado.aero" class="uppercase ms700" target="_blank"><?=$aeropuerto?></a>
    </div>
    <ul class="socials_mob">
        <li><a href="https://www.facebook.com/visitbogota.co/"><img src="<?=$include_level?>img/facebook_mob.svg" alt="facebook" width="30" height="30"></a></li>
        <li><a href="https://www.youtube.com/channel/UC_qgv3BFpK3EhqBPL0iR2IQ"><img src="<?=$include_level?>img/youtube_mob.svg" alt="youtube" width="30" height="30"></a></li>
        <li><a href="https://www.instagram.com/visitbogota.co"><img src="<?=$include_level?>img/ins_mob.svg" alt="instagram" width="30" height="30"></a></li>
        <li><a href="https://twitter.com/visitbogotaco"><img src="<?=$include_level?>img/twitter_mob.svg" alt="twitter" width="30" height="30"></a></li>
        <li><a href="https://www.threads.net/@visitbogota.co"><img src="<?=$include_level?>img/threads_mob.svg" alt="threads" width="30" height="30"></a></li>
    </ul>
</div>
</div>