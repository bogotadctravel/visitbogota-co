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
        <button type="button" id="toggleFiltersEvents"><svg width="38" height="42" viewBox="0 0 38 42" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19 5.8335L36.3334 5.8335M1.66671 36.1668L8.16671 36.1668M1.66671 5.83349L10.3334 5.83349M16.8334 36.1668L36.3334 36.1668M29.8334 21.0002L36.3334 21.0002M1.66671 21.0002L21.1667 21.0002" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><path d="M10.3333 5.83333C10.3333 8.22657 12.2734 10.1667 14.6667 10.1667C17.0599 10.1667 19 8.22657 19 5.83333C19 3.4401 17.0599 1.5 14.6667 1.5C12.2734 1.5 10.3333 3.4401 10.3333 5.83333Z" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><path d="M21.1667 20.9998C21.1667 23.3931 23.1068 25.3332 25.5 25.3332C27.8933 25.3332 29.8334 23.3931 29.8334 20.9998C29.8334 18.6066 27.8933 16.6665 25.5 16.6665C23.1068 16.6665 21.1667 18.6066 21.1667 20.9998Z" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/><path d="M8.16671 36.1668C8.16671 38.5601 10.1068 40.5002 12.5 40.5002C14.8933 40.5002 16.8334 38.5601 16.8334 36.1668C16.8334 33.7736 14.8933 31.8335 12.5 31.8335C10.1068 31.8335 8.16671 33.7736 8.16671 36.1668Z" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg></button>
        <aside class="filters">
        <button type="button" id="closeFilters"><img src="/img/close_search_box.svg" alt="close box"></button>
            <!-- <div class="container-switch">
                <label class="switch" for="closeMe">
                    <input type="checkbox" id="closeMe">
                    <span class="slider round"></span>
                </label>
                <small>Cerca de mí</small>
            </div> -->
            <h2 class="ms900"><?=$lang == "es" ? "Prográmate con los eventos más destacados":"Find your favorite events"?></h2>
            <div class="filtergroup checkboxes color open" data-filterid="categorias_eventos">
                <span class="ms700"><span class="arrow"></span><?=$lang == "es" ? "Categoría de Evento":"Event Category"?></span>
                <div class="content"></div>
            </div>
            <div class="filtergroup checkboxes color open" data-filterid="test_zona">
                <span class="ms700"><span class="arrow"></span><?=$lang == "es" ? "Zona de la ciudad":"city area"?></span>
                <div class="content"></div>
            </div>
        </aside>
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