<?php 
    $bodyClass = 'intern_event';
    include 'includes/head.php';
    $event = $b->events($_GET["id"] , "all", "all", "all");
?>
<main style="background-image: url(https://files.visitbogota.co<?=$event->field_cover_image?>);" data-eventid="<?=$_GET[" id"]?>">
    <div class="container">
        <h1 class="uppercase"><?=$event->title?></h1>
        <?php 
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
        $date = new DateTime($event->field_date);
        $dateString = strftime('%B %d DE %Y', $date->getTimestamp());
        if(!$event->field_end_date){
            echo '<h2 class="uppercase">' . $dateString . '</h2>'; // JULIO
        }else{
            $dateEnd = new DateTime($event->field_end_date);
            $dateStringEnd = strftime('%B %d DE %Y', $dateEnd->getTimestamp());
            echo '<h2 class="uppercase">Desde ' . $dateString . ' - '.$dateStringEnd.'</h2>'; // JULIO

        }
        ?>

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
            <div class="disclaimer">
                <p><?=$pi_bogota[99]?></p>
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
