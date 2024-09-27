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
<?php if($agenda->field_video_youtube != ''){ ?>
    <script>
        setTimeout(() => {
            Fancybox.show([
      {
        src: "<?=$agenda->field_video_youtube?>",
        width: window.innerWidth > 768 ? 640 : window.innerWidth - 40,
        height: window.innerWidth > 768 ? 360 : window.innerWidth - 40,
      },
    ]);
        }, 2000);
    </script>
<?php }?>
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
    <h2><img src="images/eventos_ic.svg" alt="descubre"><?=$eventos?></h2>
    <div class="events_list">
        <div class="filters-bar">
            <div>
                <label for="searchEvents">Buscar</label>
                <input type="text" name="searchEvents" id="searchEvents">
            </div>
          
            <div class="filtergroup selects checkboxes color open" data-filterid="categorias_eventos">
                <span class="ms700"><span class="arrow"></span><?=$lang == "es" ? "Categoría de Evento":"Event Category"?></span>
                <div class="content"></div>
            </div>
            <div class="filtergroup selects checkboxes color open" data-filterid="test_zona">
                <span class="ms700"><span class="arrow"></span><?=$lang == "es" ? "Zona de la ciudad":"city area"?></span>
                <div class="content"></div>
            </div>
            <div>
                <label for="dateStart">Seleccione fecha desde</label>
                <input type="date" name="dateStart" id="dateStart">
            </div>
            <div>
                <label for="dateStart">Seleccione fecha hasta</label>
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
    <?php 
    if (count($field_blog_rel) > 0 && $field_blog_rel[0] != '') { ?>
		<div class="container_interest container">
			<h2>También te puede interesar</h2>
			<ul class="blog_rel">
				<?php
				for ($countBlogs = 0; $countBlogs < count($field_blog_rel); $countBlogs++) {
					$singleBlog = $b->blogs($field_blog_rel[$countBlogs], "all");
					$singleBlog = $singleBlog[0];
					if ($singleBlog->nid != $_GET['blogID']) {
						$url = "/" . $lang . "/blog/" . $b->get_alias("SAD") . "/" . $b->get_alias($singleBlog->title) . "-all-" . $singleBlog->nid;
						$image = $singleBlog->field_image != "" ? $urlGlobal . $singleBlog->field_image : "/img/noimg.png";
						$cat = $singleBlog->field_nueva_categorizacion1  != '' ? "<small class='tag'><img src='images/mdi_tag.svg' alt='tag'/>".$singleBlog->field_nueva_categorizacion1 . "</small>"  : "";
						echo "
							<li>
							<a href='" . $url . "' data-aos='flip-left blog_item' data-productid='" . $b->products(0, $singleBlog->field_prod_rel)->nid . "'>
								  <div class='img'>
									<img loading='lazy' data-src='" . $image . "'
									alt='" . $singleBlog->title . "'
									class='zone_img lazyload' src='https://placehold.co/400x400.jpg?text=visitbogota' />
								  </div>
								  <div class='desc'>".$cat."<h2 class=''>" . $singleBlog->title . "</h2>
								  </div>
								</a>
							</li>
						";
					}
				}
				?>
			</ul>
		</div>
	<?php } ?>
</main>

<?php include 'includes/imports.php'; ?>