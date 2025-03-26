<?php 
    $bodyClass = 'eventsnew';
    include 'includes/head.php';
    // Obtener la fecha actual
    $today = time();
    $agenda = $b->getTaxAgenda($_GET['idAgenda']);
    $field_blog_rel = explode(", ", $agenda->field_blog_rel);
    switch ($lang) {
        case 'es':
            // Set the locale to Spanish (ES)
            setlocale(LC_TIME, 'es_ES');
            
            break;
        case 'pt':
            // Set the locale to Portuguese (PT)
            setlocale(LC_TIME, 'pt_PT');
            
            break;
        case 'fr':
            // Set the locale to French (FR)
            setlocale(LC_TIME, 'fr_FR');
            
            break;
        
        default:
            
            break;
    }
?>

<main data-agenda="<?=$_GET['idAgenda']?>" class="<?=isset($agenda->field_banner_principal_agenda) && $agenda->field_banner_principal_agenda != "" ? '':'ptevents'?>">
    <?php if(isset($agenda->field_banner_principal_agenda) && $agenda->field_banner_principal_agenda != ""){ ?>
        <section class="banner"
            style="background-image:url(https://files.visitbogota.co<?= isset($agenda->field_banner_principal_agenda) && $agenda->field_banner_principal_agenda != "" ? $agenda->field_banner_principal_agenda : "https://images.pexels.com/photos/2897462/pexels-photo-2897462.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"?>);">
            <?= isset($agenda->field_banner_principal_agenda) && $agenda->field_banner_principal_agenda != "" ? "" : "<h1 class=''>Eventos</h1>"?>
        </section>
    <?php } ?>
        <section class="agendaInfo ">
        <?php if(isset($_GET['idAgenda'])){?>
        <p><?=$agenda->description__value?></p>
        <?php 
        $titles = explode(',', $agenda->field_titulos_agenda); 
        $links = explode(',', $agenda->field_links_agenda); 
        
        if($titles[0] != ""){
          
            ?>
            <ul class="linksAgenda">
                <?php 
                    $images = array(
                        "field_imagenes_agenda",
                        "field_imagen_2_agenda",
                        "field_imagen_3_agenda",
                        "field_imagen_4_agenda"
                    );
                    for ($i=0; $i < count($titles); $i++) { 
                        $imageVariable = $images[$i];
                        $imageURL = $agenda->$imageVariable;
                ?>
                    <li>
                        <a href="<?=$links[$i]?>">
                            <img loading="lazy" class="lazyload" data-src="<?php echo "https://files.visitbogota.co" .$imageURL; ?>" src="https://picsum.photos/20/20" alt="Reserva aquí tu viaje al Festival de la igualdad">
                            <small><?=$titles[$i]?></small>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
        <?php } ?>
    </section>
   
	<?php 
    $titles = explode("|",$agenda->field_tit_rel);
    ?>
      <section class="rel_rutas container">
        <h3><?=$titles[1]?></h3>
        <div id="rel_rutas">
        <section class="splide relRutasSplide" aria-label="Basic Structure Example">
            <div class="splide__track">
                <ul class="splide__list">
                
                </ul>
            </div>
        </section>
        </div>
    </section>
    <?php if($agenda->field_video_youtube != ''){ ?>
        <iframe width="560" height="315" src="<?=$agenda->field_video_youtube?>&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    <?php }?>
     <section class="rel_ofertas container">
        <h3><?=$titles[2]?></h3>
        <ul id="rel_ofertas"></ul>
    </section>
    <section class="rel_atractivos container">
        <h3><?=$titles[0]?></h3>
        <div id="rel_atractivos"></div>
    </section>
    <section class="rel_article container ">
        <h3><?=$titles[3]?></h3>
        <div id="rel_article" class="grid-blogs"></div>
    </section>
    <h2><img src="images/eventos_ic.svg" alt="descubre"><?=$eventos?></h2>
    <div class="events_list">
        <div class="filters-bar">
            <div>
                <label for="searchEvents"><?=$pi_bogota[7]?></label>
                <input type="text" name="searchEvents" id="searchEvents">
            </div>
          
            <div class="filtergroup selects checkboxes color open" data-filterid="categorias_eventos">
                <span class="ms700"><span class="arrow"></span><?=$pi_bogota[51]?></span>
                <div class="content"></div>
            </div>
            <div class="filtergroup selects checkboxes color open" data-filterid="test_zona">
                <span class="ms700"><span class="arrow"></span><?=$pi_bogota[58]?></span>
                <div class="content"></div>
            </div>
            <div>
                <label for="dateStart"><?=$pi_bogota[109]?></label>
                <input type="date" name="dateStart" id="dateStart">
            </div>
            <div>
                <label for="dateStart"><?=$pi_bogota[110]?></label>
                <input type="date" name="dateEnd" id="dateEnd">
            </div>
        </div>
        <ul class="events_list_grid"></ul>
        <?php if($_GET['idAgenda'] == '149'){ ?>
            <div class="aclaracion">
                <p><?=$lang == "es" ? "El IDT no es el organizador de los eventos aquí publicados.":"The IDT is not the organizer of the events published here."?></p>
            </div>
        <?php } ?>
    </div>
   
   
<?php if(isset($agenda->field_banner_final)){ ?>
    <img src="<?= $urlGlobal . $agenda->field_banner_final?>" alt="<?=$agenda->field_banner_final?>" class="banner_final">
<?php } ?>
</main>

<?php include 'includes/imports.php'; ?>