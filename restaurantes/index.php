<?php
$bodyClass = 'hotelesnew';
include "includes/head.php"; ?>
<section class="banner" style="background-image:url(https://files.visitbogota.co/drpl/sites/default/files/2023-08/d68ff673-2fb0-4820-995f-7092f7920053.JPG );">
    <div class="container">
        <div class="intro-txt">
            <h3 class="uppercase">¿Dónde comer en Bogotá?</h3>
            <div>
                <h2 class="uppercase"><img src="../img/Restaurantes_Flag.svg" alt="restaurantes">Restaurantes</h2>
                <hr>
            </div>
            <p>Ya sea que esté buscando una experiencia gastronómica tradicional colombiana, una cocina internacional de alta gama o algo intermedio, seguro que encontrará el restaurante perfecto en Bogotá.<br>
                &nbsp;</p>
        </div>
    </div>
</section>
<div class="container">
    <div class="opciones">
        <ul>
            <li><a href="/<?= $lang ?>/donde-dormir" class="opcion"><img src="../img/Hospedajes-icon.svg" alt="hospedajes">Hospedajes</a></li>
            <li><a href="#" class="opcion active"><img src="../img/Restaurantes_icon.svg" alt="restaurantes">Restaurantes</a></li>
        </ul>
    </div>
    <div class="card-list providers graybg font1">
        <div class="column flex w_100">
            <aside class="column w_25 filters graybg m_outter">
                <button class="fw500" id="resetfilters">Limpiar filtros</button>
                <h3 class="fw900">
                    <img src="../vacacional/images/lets-icons_filter.svg" alt="filtros">
                    Filtros
                </h3>
                <div class="filtergroup checkboxes color open" data-filterid="categoria_restaurantes">
                    <h4 class="fw700"><span class="arrow"></span>Categorías</h4>
                    <div class="loader"></div>
                    <div class="content">
                    </div>
                </div>
                <div class="filtergroup checkboxes color open" data-filterid="test_zona">
                    <h4 class="fw700"><span class="arrow"></span>Zona de la ciudad</h4>
                    <div class="loader"></div>
                    <div class="content">
                    </div>
                </div>
                <div class="filtergroup checkboxes color open" data-filterid="zonas_gastronomicas">
                    <h4 class="fw700"><span class="arrow"></span>Zona Gastronómica</h4>
                    <div class="loader"></div>
                    <div class="content">
                    </div>
                </div>
                <!-- <div class="filtergroup checkboxes color open" data-filterid="rangos_de_precio">
                        <h4 class="fw700"><span class="arrow"></span>Rangos de precio</h4>
                        <div class="loader"></div>
                        <div class="content">
                        </div>
                    </div> -->
            </aside>
            <section class="cards flex loading m_outter">
                <!-- <h1 class="fw700 title">
                    <img src="/../vacacional/images/restaurantes.svg" alt="restaurantes">
                    Dónde Comer En Bogotá</h1> -->

                <hr>
                <div class="loader big"></div>
                <div class="content flex"></div>

            </section>
        </div>
    </div>
</div>
<?php if($lang == "es"){?>
    <section class="exp container">
        <h2><img src="../vacacional/images/exp_tur.svg" alt="descubre">Experiencias Turísticas</h2>
        <div class="exp-content">
            <h3>Experiencias turísticas que te pueden interesar</h3>
            <ul class="grid-experiencias">
                <?php
                $pbInfo = $mice->getInfoGnrlPB();
                $plans = $mice->getRecommendPlans($pbInfo->field_ofertas_recomendadas);
                for ($i = 0; $i < 3; $i++) {
                    $plan = $plans[$i]; ?>
                    <li>
                        <a href="/<?= $lang ?><?= $project_base ?>plan/<?= $mice->get_alias($plan->title) ?>-<?= $plan->nid ?>" class="plansSplide__item">
                        <div class="discount ms900">
                      <svg width="296" height="52" viewBox="0 0 296 52" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 5C0 2.23858 2.23858 0 5 0H290.587C293.842 0 296.23 3.06214 295.436 6.2196L290.767 24.7804C290.566 25.581 290.566 26.419 290.767 27.2196L295.436 45.7804C296.23 48.9379 293.842 52 290.587 52H5C2.23858 52 0 49.7614 0 47V5Z" fill="#35498e"/><path d="M58.8991 23.3351L44.6491 9.08508C44.0791 8.51508 43.2875 8.16675 42.4166 8.16675H31.3333C29.5916 8.16675 28.1666 9.59175 28.1666 11.3334V22.4167C28.1666 23.2876 28.515 24.0792 29.1008 24.6651L43.3508 38.9151C43.9208 39.4851 44.7125 39.8334 45.5833 39.8334C46.4541 39.8334 47.2458 39.4851 47.8158 38.8992L58.8991 27.8159C59.485 27.2459 59.8333 26.4542 59.8333 25.5834C59.8333 24.7126 59.4691 23.9051 58.8991 23.3351ZM45.5833 36.6826L31.3333 22.4167V11.3334H42.4166V11.3176L56.6666 25.5676L45.5833 36.6826Z" fill="white"/><path d="M35.2916 17.6667C36.6033 17.6667 37.6666 16.6034 37.6666 15.2917C37.6666 13.9801 36.6033 12.9167 35.2916 12.9167C33.9799 12.9167 32.9166 13.9801 32.9166 15.2917C32.9166 16.6034 33.9799 17.6667 35.2916 17.6667Z" fill="white"/></svg>
                      <span>
                        <?= $plan->field_percent?>% <small class="ms500">DCTO</small>
                      </span>
                      </div>
                            <div class="image">
                                <img src="https://files.visitbogota.co<?= $plan->field_pb_oferta_img_listado ?>" alt="<?= $plan->title ?>" />
                                <div class="prices">
                                    <p class="prices-discount ms500">$
                                        <?= number_format($plan->field_pa, 0, ",", ".") ?>
                                    </p>
                                    <p class="prices-total ms900">$
                                        <?= number_format($plan->field_pd, 0, ",", ".") ?>
                                    </p>
                                </div>
                            </div>
                            <div class="info">
                                <strong class="ms900">
                                    <?= $plan->title ?>
                                </strong>
                                <p class="ms100">
                                    <?= $plan->field_pb_oferta_desc_corta ?>
                                </p>
                                <small class="ms900 uppercase link"> Ver experiencia </small>
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </section>
<?php }?>
<? include 'includes/imports.php' ?>