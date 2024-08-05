<?php 
    $bodyClass = 'intern_event';
    include 'includes/head.php';
    $event = $b->events($_GET["id"] , "all", "all", "all");
    function setMidnight($dateString) {
        $date = new DateTime($dateString);
        $date->setTime(0, 0, 0);
        return $date;
    }
    
    function formatDate($date, $lang = 'es') {
        $months = [
            'es' => [
                1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril', 
                5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto', 
                9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
            ]
        ];
    
        $month = $months[$lang][intval($date->format('n'))];
        return $date->format('j') . ' de ' . $month . ' de ' . $date->format('Y');
    }
    
    function formatEventDate($evento, $actualLang) {
        $dateStart = setMidnight($evento->field_date);
    
        // Manejar la fecha de fin de manera diferente si no incluye una hora
        $dateEnd = null;
        if (strlen($evento->field_end_date) === 10) {
            // Verificar si el formato es solo de fecha (YYYY-MM-DD)
            $dateEnd = setMidnight($evento->field_end_date);
        } else {
            $dateEnd = setMidnight($evento->field_end_date);
        }
    
        $dateFormattedStart = formatDate($dateStart, $actualLang);
        $dateFormattedEnd = formatDate($dateEnd, $actualLang);
        $alText = $actualLang === 'es' ? 'al' : 'to';
        $hastaElText = $actualLang === 'es' ? 'Hasta el' : 'Until';
    
        // Obtener la fecha actual
        $today = new DateTime();
        $today->setTime(0, 0, 0);
    
        $dateText = '';
    
        // Condicionales
        if (empty($evento->field_end_date)) {
            // 1. No tiene fecha final -> Tomar la fecha de inicio.
            $dateText = $dateFormattedStart;
        } elseif ($dateStart == $dateEnd) {
            // 2. Fecha de inicio es igual a la fecha final, solo mostrar la fecha final.
            $dateText = $dateFormattedEnd;
        } elseif ($dateStart < $today) {
            // 3. Si la fecha de inicio es menor a la fecha actual, quitar la fecha de inicio y colocar al principio "Hasta el".
            $dateText = "$hastaElText $dateFormattedEnd";
        } else {
            // 4. Si la fecha de inicio es superior a la fecha actual, colocar así Fecha 1 al Fecha 2
            $dateText = "$dateFormattedStart $alText $dateFormattedEnd";
        }
    
        return $dateText;
    }
?>
<main style="background-image: url(https://files.visitbogota.co<?=$event->field_cover_image?>);" data-eventid="<?=$_GET[" id"]?>">
    <div class="container">
        <h1 class=""><?=$event->title?></h1>
        <h2><?=formatEventDate($event, $lang)?></h2>
        <section>
            <?php
            if($event->field_videoyt != ""){
            ?>
            <div class="video">
                <iframe title="Video del evento" src="<?=$event->field_videoyt?>"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"></iframe>
            </div>
            <?php
            }
            ?>
            <div class="desc">
                <?=$event->body?>
            </div>
            <div class="event_info">
                <div class="place">
                    <img src="/img/place_event.svg" alt="lugar del evento">
                    <small><?=$event->field_place?></small>
                </div>
                <?php 
                if($event->field_phone){
                ?>
                <div class="phone">
                    <img src="/img/phone_event.svg" alt="Teléfono del evento">
                    <small><?=$event->field_phone?></small>
                </div>
                <?php 
                }
                ?>
            </div>
           
        </section>
        <?php if($venue->field_galery != ""){ ?>
            <div class="gallery">
                <section class="splide" aria-label="Basic Structure Example">
                    <div class="splide__arrows splide__arrows--ltr">
                        <button class="splide__arrow splide__arrow--prev" type="button" aria-label="Previous slide"
                            aria-controls="splide01-track">
                            <img src="/img/arrowleftnew.svg" alt="arrowleftnew">
                        </button>
                        <button class="splide__arrow splide__arrow--next" type="button" aria-label="Next slide"
                            aria-controls="splide01-track">
                            <img src="/img/arrowrightnew.svg" alt="arrowrightnew">
                        </button>
                    </div>
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php 
                                $galItems = explode(",", $venue->field_galery);
                                for ($i=0; $i < count($galItems) ; $i++) { 
                                $galItem = $galItems[$i];
                            ?>
                            <li class="splide__slide"><img src="<?=$galItem?>" alt=""></li>
                            <?php 
                                }
                            ?>
                        </ul>
                    </div>
                </section>
            </div>
        <?php } ?>
        <a href="http://maps.google.com/maps?q=<?=$event->field_location?>" class="map">
            <div class="map_lupa"><img src="/img/lupa_gray.svg"
                    alt="lupa"><small><?=$b->generalInfo->field_texto_como_llegar?></small></div>
            <img src="/img/map.jpg" alt="map">
        </a>
    </div>
    <section class="container">
    <div class="disclaimer">
                <p><?=$pi_bogota[99]?></p>
            </div>
    </section>
</main>
<?php include 'includes/imports.php'; ?>
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
