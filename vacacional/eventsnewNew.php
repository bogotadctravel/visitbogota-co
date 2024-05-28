<?php 
    $bodyClass = 'eventsnew';
    include 'includes/head.php';
    // Obtener la fecha actual
    $today = time();
    $agenda = $b->getTaxAgenda($_GET['idAgenda']);
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
<main data-agenda="<?=$_GET['idAgenda']?>">
    <section class="banner"
        style="background-image:url(https://files.visitbogota.co<?= isset($agenda->field_banner_principal_agenda) && $agenda->field_banner_principal_agenda != "" ? $agenda->field_banner_principal_agenda : "
        https://images.pexels.com/photos/2897462/pexels-photo-2897462.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"?>
        );">
        <?= isset($agenda->field_banner_principal_agenda) && $agenda->field_banner_principal_agenda != "" ? "" : "<h1 class='uppercase'>Eventos</h1>"?>
        <aside class="filters">
            <h2 class="ms900">
                <?=$lang == "es" ? "Prográmate con los eventos más destacados":"Find your favorite events"?>
            </h2>
            <div class="filterGroups">
                <div class="filtergroup checkboxes color open" data-filterid="categorias_eventos">
                    <span class="ms700"><span class="arrow"></span>
                        <?=$lang == "es" ? "Categoría de Evento":"Event Category"?>
                    </span>
                    <div class="content"></div>
                </div>
                <div class="filtergroup checkboxes color open" data-filterid="test_zona">
                    <span class="ms700"><span class="arrow"></span>
                        <?=$lang == "es" ? "Zona de la ciudad":"city area"?>
                    </span>
                    <div class="content"></div>
                </div>
            </div>
        </aside>
    </section>
    <section class="agendaInfo">
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
                    <img loading="lazy" class="lazyload" data-src="<?php echo " https://files.visitbogota.co" .$imageURL; ?>"
                    src="https://picsum.photos/20/20" alt="Reserva aquí tu viaje al Festival de la igualdad">
                    <small>
                        <?=$titles[$i]?>
                    </small>
                </a>
            </li>
            <?php } ?>
        </ul>
        <?php } ?>
        <?php } ?>
    </section>
    <div class="events_list">
        <ul class="events_list_grid"></ul>
        <?php if($_GET['idAgenda'] == '149'){ ?>
        <div class="aclaracion">
            <p>
                <?=$lang == "es" ? "El IDT no es el organizador de los eventos aquí publicados.":"The IDT is not the organizer of the events published here."?>
            </p>
        </div>
        <?php } ?>
    </div>
</main>

<?php include 'includes/imports.php'; ?>