
<header data-aos="fade-down">

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
                    <a href="<?=isset($json_data["menuItems"][$i]["children"][$menuCount][$lang]["link"]) ? $json_data["menuItems"][$i]["children"][$menuCount][$lang]["link"] : '/'?>" class="wait ms700"><?=$json_data["menuItems"][$i]["children"][$menuCount][$lang]["title"]?></a>
                </li>
                <?php } ?>
                </ul>
                </li>

                <? }else{ ?>
                  <li>
                    <a href="<?=isset($json_data["menuItems"][$i][$lang]["link"]) ? $json_data["menuItems"][$i][$lang]["link"] : '/'?>" class="wait ms700"><?=$json_data["menuItems"][$i][$lang]["title"]?></a>

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
                  <? if(count($json_data["menuItems"][$i]["children"]) > 0 && is_array($json_data["menuItems"][$i]["children"]) ){ ?>
                  <li class="ms700 <?=$json_data["menuItems"][$i]["class"]?>">
                  <?=$json_data["menuItems"][$i][$lang]["title"]?>
                  <ul>
                  <? for ($menuCount = 0; $menuCount < count($json_data["menuItems"][$i]["children"]); $menuCount++) { ?>
                  <li class="ms700 <?=$json_data["menuItems"][$i]["class"]?>">
                      <a href="<?=isset($json_data["menuItems"][$i]["children"][$menuCount][$lang]["link"]) ? $json_data["menuItems"][$i]["children"][$menuCount][$lang]["link"]: '/'?>" class="wait ms700"><?=$json_data["menuItems"][$i]["children"][$menuCount][$lang]["title"]?></a>
                  </li>
                  <?php } ?>
                  </ul>
                  </li>
  
                  <? }else{ ?>
                    <li>
                      <a href="<?=isset($json_data["menuItems"][$i][$lang]["link"]) ? $json_data["menuItems"][$i][$lang]["link"] : ''?>" class="wait ms700"><?=$json_data["menuItems"][$i][$lang]["title"]?></a>
                    </li>
                  <? } ?>
            <? }?>          

                </ul>
            </nav>
        <?php } ?>
                <button id="menuBtn">
                    <span></span>
                    <span></span>
                    <small>Menú</small>
                </button>
      </div>
    </div>
    
  </header>