<?php $bodyClass="home"; include "includes/head.php"; $plans = $pb->getRecommendPlans($pb->generalInfo->field_ofertas_recomendadas); ?>
  <body class="home">
    <main>
      <div
        class="home-banner"
        style="
          background-image: url(<?=$pb->absoluteURL($pb->generalInfo->field_home_img)?>);
        "
      >
        <div class="container">
          <form action="/<?=$lang?>/experiencias-turisticas/encuentra-tu-plan" method="GET" onsubmit="return validateForm()" id="searchForm" autocomplete="off">
            <h2 class="ms900"><?=$pb->pb_experiencias[0]?></h2>
            <span>
              <div class="left">
                <div class="input">
                  <img src="../img/lupa_gray.svg" alt="lupa" />
                  <input
                    type="search"
                    aria-label="search"
                    name="search"
                    id="searchInput"
                    placeholder="<?=$pb->pb_experiencias[1]?>"
                  />
                  <small>Este campo no puede estar vacio*</small>
                </div>
              </div>
              <div class="right">
                <div class="c-select">
                  <select name="plan" aria-label="plan" id="plan" class="ms700">
                    <option class="ms700" value=""><?=$pb->pb_experiencias[2]?></option>
                    <option class="ms700" value="1"><?=$pb->pb_experiencias[3]?></option>
                    <option class="ms700" value="2"><?=$pb->pb_experiencias[4]?></option>
                    <option class="ms700" value="3"><?=$pb->pb_experiencias[5]?></option>
                    <option class="ms700" value="4"><?=$pb->pb_experiencias[6]?></option>
                  </select>
                  <div class="c-arrow">
                    <img src="images/arrow-select.svg" alt="arrow-select" />
                  </div>
                </div>

                <button type="submit" id="search-btn" class="ms900 ">
                  <?=$pb->pb_experiencias[1]?>
                </button>
              </div>
            </span>
          </form>
        </div>
        <section class="categoriessection">
          <div class="categories">
          </div>
        </section>
      </div>
      <div class="bg"  style="
          background-image: url(<?=$pb->absoluteURL($pb->generalInfo->field_home_img)?>);
        ">
        <div class="recommendation">
          <div class="container">
            <h3 class="ms900"> <img src="../vacacional/images/atractivo.svg" alt="descubre"><?=$pb->pb_experiencias[13]?></h3>
            <ul class="recommendation-grid">
              <?php for ($i=0; $i < count($plans); $i++) { $plan = $plans[$i]; ?>
                <li class="recommendation-grid__item">
                  <a href="/<?=$lang?>/experiencias-turisticas/plan/<?=$pb->get_alias($plan->title)?>-<?=$plan->nid?>" >
                    <!-- <div class="discount ms900">
                    <svg width="296" height="52" viewBox="0 0 296 52" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 5C0 2.23858 2.23858 0 5 0H290.587C293.842 0 296.23 3.06214 295.436 6.2196L290.767 24.7804C290.566 25.581 290.566 26.419 290.767 27.2196L295.436 45.7804C296.23 48.9379 293.842 52 290.587 52H5C2.23858 52 0 49.7614 0 47V5Z" fill="#35498e"/><path d="M58.8991 23.3351L44.6491 9.08508C44.0791 8.51508 43.2875 8.16675 42.4166 8.16675H31.3333C29.5916 8.16675 28.1666 9.59175 28.1666 11.3334V22.4167C28.1666 23.2876 28.515 24.0792 29.1008 24.6651L43.3508 38.9151C43.9208 39.4851 44.7125 39.8334 45.5833 39.8334C46.4541 39.8334 47.2458 39.4851 47.8158 38.8992L58.8991 27.8159C59.485 27.2459 59.8333 26.4542 59.8333 25.5834C59.8333 24.7126 59.4691 23.9051 58.8991 23.3351ZM45.5833 36.6826L31.3333 22.4167V11.3334H42.4166V11.3176L56.6666 25.5676L45.5833 36.6826Z" fill="white"/><path d="M35.2916 17.6667C36.6033 17.6667 37.6666 16.6034 37.6666 15.2917C37.6666 13.9801 36.6033 12.9167 35.2916 12.9167C33.9799 12.9167 32.9166 13.9801 32.9166 15.2917C32.9166 16.6034 33.9799 17.6667 35.2916 17.6667Z" fill="white"/></svg>
                      <span>
                        <?= $plan->field_percent?>% <small class="ms500">DCTO</small>
                        </span>
                    </div> -->
                  <div class="image">
                    <img
                      src="https://files.visitbogota.co<?= $plan->field_pb_oferta_img_listado?>"
                      alt="<?= $plan->title?>"
                    />
                    <!-- <div class="prices">
                        <p class="prices-discount ms500">$<?= number_format($plan->field_pa,0,",",".")?></p>
                        <p class="prices-total ms900">$<?= number_format($plan->field_pd,0,",",".")?></p>
                      </div> -->
                  </div>
                    <div class="info">
                      
                      <strong class="ms900"
                        ><?= $plan->title?></strong
                      >
                      <p class="ms100">
                      <?= $plan->field_pb_oferta_desc_corta?>
                      
                      </p>
                      <small class="ms900  link"> <?=$pb->pb_experiencias[14]?> </small>
                    </div>
                  </a>
                </li>
                <?php  } ?>
            </ul>
            <a href="/<?=$lang?>/experiencias-turisticas/encuentra-tu-plan" class="btn alloffers  ms900"
              ><?=$pb->pb_experiencias[61]?></a
            >
          </div>
        </div>
      </div>
    </main>
    <?php include 'includes/imports.php'?>
  </body>
</html>
