<?php $bodyClass="mice-home"; include "includes/head.php";$data = $mice->getData(); ?>
    <div id="mobile"></div>
    <main class="graybg">
      <section class="banner">
        <video
          autobuffer
          autoplay
          muted
          poster=""
          preload="auto"
          loop
          src="<?= "https://files.visitbogota.co".$mice->miceinfo->field_cover; ?>"
        >
          <source
            src="<?= "https://files.visitbogota.co".$mice->miceinfo->field_cover; ?>"
            type="video/mp4"
          />
          Your browser does not support the video tag.
        </video>
      </section>
      <!-- <h1 class="fw900 uppercase center title"><img src="img/btalogo.svg" width="200" alt="bta logo"/><span>¿Por qué bogotá?</span></h1> -->
  <section class="column flex w_100">
      <div class="container">
          <?php for($i=0;$i<count($data);$i++){ ?>
          <article class="w_25 graybg">
              <img src="<?php echo $mice->absoluteURL($data[$i]->field_thumbnail); ?>" alt="<?php echo $data[$i]->title; ?>" />
              <h1 class="fw900 uppercase"><?php echo $data[$i]->field_highlight; ?></h1>
              <p><?php echo $data[$i]->field_title; ?></p>
          </article>
              <?php } ?>
          </div>
      </section>
      <!-- <section class="known loading">
        <h2><?= $mice->miceinfo->field_mice_ui_11; ?></h2>
        <div class="loader"></div>

                <div class="container ">
                        <div class="content flex"></div>
                 </div>
      </section> -->
      <!-- <section class="success-stories loading">
        <h2><?= $mice->miceinfo->field_mice_ui_16; ?></h2>
        <div class="loader"></div>
        <div class="container">
        <div class="content flex"></div>

            </div>
        </div>                  
      </section> -->
    </main>
  <? include 'includes/imports.php'?>
