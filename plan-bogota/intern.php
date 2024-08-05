<?php $bodyClass="intern"; include "includes/head.php"; $plan = $pb->getPlans($_GET["planid"]); $company =  $pb->getCompany($plan->field_pb_oferta_empresa); 
?>
<body class="intern">
  <script>
    const date = new Date();
    function SendInfoHook(){
      const myHeaders = new Headers();
      myHeaders.append("Content-Type", "application/json");
      const raw = JSON.stringify({
        "cod_rep": 0,
        "serviceid_rep": <?=$plan->nid ?>,
        "service_rep": "<?=$plan->title ?>",
        "companyid_rep": <?=$plan->field_pb_oferta_empresa ?>,
        "company_rep": "<?=$company->field_pb_empresa_titulo ?>",
        "price_rep": "<?=$plan->field_pd ?>",
        "catid_rep": <?=$plan->field_segment ?>,
        "cat_rep": "<?=$plan->field_segment_1 ?>",
        "fec_crea": new Date().toLocaleDateString('en-GB'),
        "fec_modif": new Date().toLocaleDateString('en-GB'),
        "usu_acce": 5,
        "reg_eli": 0
      });
      const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
      };

      fetch("https://hook.us1.make.com/1vc7glalx2cu82m50ej38qvromsjbw4p", requestOptions)
        .then((response) => response.json())
        .then((result) => {
          if(result.message){
            gtag('event', 'form_start', {
              'event_category': 'bookings', 
              'event_label': '<?= $plan->nid ?>',
              'value': "<?= $plan->field_pd ?>",
              'event_company':'<?=$company->field_pb_empresa_titulo?>',
              'event_exp':'<?=$plan->title?>'
            });
              window.location.href = '/g/booklink/?url=<?= $company->field_pb_empresa_direccion ?>&id=<?= $_GET['planid'] ?>&price=<?= $plan->field_pd ?>';
          }
        })
        .catch((error) => console.error(error));
    }
  </script>
  <main>
    <img src="https://files.visitbogota.co<?=$plan->field_img != "" ? $plan->field_img : $plan->field_pb_oferta_img_listado?>" alt="Imagen Banner" id="mi-imagen" style="display:none;">
    <div
    id="container"
      class="intern-banner"
      style="
        background-image: url(https://files.visitbogota.co<?=$plan->field_img != "" ? $plan->field_img : $plan->field_pb_oferta_img_listado?>);
      "
    >
      <div class="content">
        <a href="" class="ms900  btn-back btn"
          ><img src="<?=$project_base?>images/arrow_back.svg" alt="arrow_back" />  <?=$pb->pb_experiencias[23]?>
        </a>
        <div class="info">
         
          <strong class="ms900"
            ><?=$plan->title?></strong
          >
          <!-- <div class="prices">
            <p class="prices-discount ms500">$<?=number_format($plan->field_pa,0,",",".")?></p>
            <p class="prices-total ms900">$<?=number_format($plan->field_pd,0,",",".")?></p>
          </div> -->
          <a href="#moreInfo" class="ms900 ">  <?=$pb->pb_experiencias[22]?> </a>
        </div>
      </div>
    </div>
    }
    <div class="container">
      <a href="/<?=$_GET['lang']?><?=$project_base?>encuentra-tu-plan" class="ms900  btn-back btn"
        ><img src="<?=$project_base?>images/arrow_back_green.svg" alt="arrow_back" />  <?=$pb->pb_experiencias[23]?>
      </a>
      <div class="all-info" id="moreInfo">
        <div class="gallery">
          <img
            loading="lazy"
            src="https://picsum.photos/20/20"
            data-src="https://files.visitbogota.co<?=$plan->field_gal_1 ? $plan->field_gal_1 : $plan->field_gal_2?>"
            alt="<?=$plan->{"field_gal_". $i . "_1"}?>"
            class="lazyload"
            id="principal_img"
          />
          <span class="alt-text"><?=$plan->{"field_gal_". $i . "_1"}?></span>
          <ul class="gallery_dot">
            <?php for ($i=1; $i < 6; $i++) { if($plan->{"field_gal_". $i} != ""){ ?>
              <li class="active">
                <img
                  loading="lazy"
                  src="https://picsum.photos/20/20"
                  data-src="https://files.visitbogota.co<?=$plan->{"field_gal_". $i}?>"
                  alt="<?=$plan->{"field_gal_". $i . "_1"}?>"
                  class="lazyload"
                />
              </li>
              <?php }} ?>
          </ul>
        </div>
        <div class="description">
        <?php if($plan->field_nueva_categorizacion_1 != ""){?>
          <h3 class="categorie ms700"><img src="../vacacional/images/mdi_tag.svg" alt="tag"><?=$plan->field_nueva_categorizacion_1?></h3>
        <?php }?>
          <h2 class="ms900">
          <?=$plan->title?>
          </h2>
          <div class="companyCont">
           
            <?= $company->field_featuredcompany == 1 ? '<img src="images/star.png" alt="stars" />': "" ?>
          
            <?=$company->field_pb_empresa_logo != "" ? '<img src="https://files.visitbogota.co/'.$company->field_pb_empresa_logo.'" alt="'.$company->field_pb_empresa_titulo.'" class="logoCompany"/>' : "" ?>
            <div class="fxcol">
              <span class="company ms500"><?=$company->field_pb_empresa_titulo ?></span>
              <small> <?=$pb->pb_experiencias[57]?></small>
            </div>

          </div>
         
          <!-- <p class="title-certificates ms900"> <?=$pb->pb_experiencias[58]?></p> -->
          <!-- <ul class="certificates">
            <li>
              <img src="<?=$project_base?>images/cer1.png" alt="cer1" />
            </li>
            <li>
              <img src="<?=$project_base?>images/cer2.png" alt="cer2" />
            </li>
            <li>
              <img src="<?=$project_base?>images/cer3.png" alt="cer3" />
            </li>
            <li>
              <img src="<?=$project_base?>images/cer4.png" alt="cer4" />
            </li>
          </ul> -->
          <p class="address ms900">
            <img src="<?=$project_base?>images/map.svg" alt="map" /><?=$plan->field_pb_oferta_direccion?>
          </p>
          <!-- <div class="ranking">
            <span> <?=$pb->pb_experiencias[59]?></span>
            <ul>
              <li class="ranking-val1"></li>
              <li class="ranking-val2"></li>
              <li class="ranking-val3"></li>
              <li class="ranking-val4"></li>
              <li class="ranking-val5 active"></li>
            </ul>
          </div> -->
          <div class="texto">
            <p>
              <?=$plan->field_pb_oferta_desc_corta?>
            </p>
          <br />
          <br />
          <?=$plan->body?>
        </div>
          <!-- <p class="persons"><span>578</span>  <?=$pb->pb_experiencias[25]?></p>
          
          <div class="reserva ms900">
          <?=$pb->pb_experiencias[24]?>
          </div> -->
          <!-- <div class="prices">
            <p class="prices-discount ms700">$<?=number_format($plan->field_pa,0,",",".")?></p>
            <p class="prices-total ms900">$<?=number_format($plan->field_pd,0,",",".")?></p>
          </div> -->
          <div class="flex">
            <p> <?=$pb->pb_experiencias[26]?></p>
            <div class="c-select">
              <select name="plan" id="plan" class="ms700" onchange="priceSet(this.value, <?=$plan->field_pd?>)">
              <?php 
              for ($i=isset($plan->field_min_people) && $plan->field_min_people != "" ? intval($plan->field_min_people) : 1; $i <= intval($plan->field_maxpeople); $i++) { ?>
                <option class="ms700" value="<?=$i?>"><?=$i?></option>
              <?php } ?>
              </select>
              <div class="c-arrow">
                <img src="<?=$project_base?>images/arrow-select.svg" alt="arrow-select" />
              </div>
            </div>
          </div>
          <a href="javascript:void(0);" 
            onclick="SendInfoHook()" 
            class="btn btn-reserva ms900 "> 
            <?= $pb->pb_experiencias[27] ?>
          </a>
        </div>
      </div>
    </div>
    <div class="boxes form" id="reservar">
        <div class="right" style="background-image: url(https://files.visitbogota.co<?=$plan->field_img != "" ? $plan->field_img : $plan->field_pb_oferta_img_listado?>);"></div>
      <div class="left">
        <!-- <div class="discount ms900">
          <svg width="296" height="52" viewBox="0 0 296 52" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 5C0 2.23858 2.23858 0 5 0H290.587C293.842 0 296.23 3.06214 295.436 6.2196L290.767 24.7804C290.566 25.581 290.566 26.419 290.767 27.2196L295.436 45.7804C296.23 48.9379 293.842 52 290.587 52H5C2.23858 52 0 49.7614 0 47V5Z" fill="#35498e"/><path d="M58.8991 23.3351L44.6491 9.08508C44.0791 8.51508 43.2875 8.16675 42.4166 8.16675H31.3333C29.5916 8.16675 28.1666 9.59175 28.1666 11.3334V22.4167C28.1666 23.2876 28.515 24.0792 29.1008 24.6651L43.3508 38.9151C43.9208 39.4851 44.7125 39.8334 45.5833 39.8334C46.4541 39.8334 47.2458 39.4851 47.8158 38.8992L58.8991 27.8159C59.485 27.2459 59.8333 26.4542 59.8333 25.5834C59.8333 24.7126 59.4691 23.9051 58.8991 23.3351ZM45.5833 36.6826L31.3333 22.4167V11.3334H42.4166V11.3176L56.6666 25.5676L45.5833 36.6826Z" fill="white"/><path d="M35.2916 17.6667C36.6033 17.6667 37.6666 16.6034 37.6666 15.2917C37.6666 13.9801 36.6033 12.9167 35.2916 12.9167C33.9799 12.9167 32.9166 13.9801 32.9166 15.2917C32.9166 16.6034 33.9799 17.6667 35.2916 17.6667Z" fill="white"/></svg>
          <span>
            <?=$plan->field_percent?>% <small class="ms500">DCTO</small>
          </span> 
        </div> -->
        <h2 class="ms500"> <?=$pb->pb_experiencias[30]?></h2>
        <h1 class="ms900"><?=$plan->title?></h1>
        <!-- <p class="ms700">
        <?=$pb->pb_experiencias[31]?>
        </p> -->
        <!-- <div class="prices">
          <p class="prices-discount ms500">$<?=number_format($plan->field_pa,0,",",".")?></p>
          <p class="prices-total ms900">$<?=number_format($plan->field_pd,0,",",".")?></p>
        </div> -->
        <form action="/experiencias-turisticas/s/restPost/" method="POST" id="planForm">
          <input type="text" placeholder="Nombre" class="ms500" id="uname" name="uname"  />
          <input type="email" placeholder="Correo" class="ms500" id="uemail" name="uemail" />
          <input type="tel" placeholder="Celular" class="ms500" id="uphone" name="uphone" />
          <input type="hidden" class="ms500" id="uprice" name="uprice" value="<?=$plan->field_pd?>" />
          <input type="hidden" class="ms500" id="uofertaid" name="uofertaid" value="<?=$plan->nid?>" />
          <input type="hidden" class="ms500" id="uoferta" name="uoferta" value="<?=$plan->title?>" />
          <input type="hidden" class="ms500" id="ucompanyid" name="ucompanyid" value="<?=$plan->field_pb_oferta_empresa?>" />
          <input type="hidden" class="ms500" id="ucompanyname" name="ucompanyname" value="<?=$company->field_pb_empresa_titulo?>" />

          <input type="hidden" class="ms500" id="ucompanyemail" name="ucompanyemail" value="<?=$company->field_pb_empresa_email?>" />
          <input type="hidden" class="ms500" id="ucompanyphone" name="ucompanyphone" value="<?=$company->field_pb_empresa_telefono?>" />
          <input type="hidden" class="ms500" id="ucompanylink" name="ucompanylink" value="<?=$company->field_pb_empresa_direccion?>" />

          <input type="hidden" class="ms500" id="ocategoryid" name="ocategoryid" value="<?=$plan->field_segment != "" ? $plan->field_segment : 0?>" />
          <input type="hidden" class="ms500" id="ocategory" name="ocategory" value="<?=$plan->field_segment_1?>" />
          <input type="hidden" class="ms500" id="ccategoryid" name="ccategoryid" value="<?=$company->field_segment != "" ? $company->field_segment : 0 ?>" />
          <input type="hidden" class="ms500" id="ccategory" name="ccategory" value="<?=$company->field_segment_1?>" />
          <input type="hidden" class="ms500" id="numberPersons" name="numberPersons" value="1" />
          <input type="hidden" class="ms500" id="background" name="background" value="<?=$plan->field_img != "" ? $plan->field_img : $plan->field_pb_oferta_img_listado?>" />
          <div class="politics_checkbox">
            <input type="checkbox" name="politics" id="politics" checked />
            <span class="politics_checkbox_mark"></span>
            <label for="politics"
              ><?=$pb->pb_experiencias[35]?>
              <a href="/<?=$lang?>/experiencias-turisticas/politica-tratamiento-datos-personales" target="_blank"><?=$pb->pb_experiencias[62]?></a></label
            >
          </div>
          <button type="submit" class="ms900"><?=$pb->pb_experiencias[27]?></button>
        </form>
      </div>
    </div>
    <!-- <div class="reviews">
      <div class="container">
        <div class="title">
          <h3 class="ms900">¿Qué dicen otras personas sobre esta oferta?</h3>
          <div class="stars">
            <img src="<?=$project_base?>images/star.png" alt="stars" />
            <img src="<?=$project_base?>images/star.png" alt="stars" />
            <img src="<?=$project_base?>images/star.png" alt="stars" />
            <img src="<?=$project_base?>images/star.png" alt="stars" />
            <img src="<?=$project_base?>images/star.png" alt="stars" />
          </div>
        </div>
        <div class="c-select">
          <select name="plan" id="plan" class="ms700">
            <option class="ms700" value="1">Filtrar por puntuación</option>
            <option class="ms700" value="1">1</option>
            <option class="ms700" value="2">2</option>
            <option class="ms700" value="3">3</option>
            <option class="ms700" value="4">4</option>
          </select>
          <div class="c-arrow">
            <img src="<?=$project_base?>images/arrow-select.svg" alt="arrow-select" />
          </div>
        </div>
        <ul class="reviews-grid">
          <li class="reviews-grid__item">
            <div class="stars">
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
            </div>
            <h5 class="ms900">Lorem ipsum dolor sit amet.</h5>
            <p>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis
              ipsum voluptatibus perspiciatis esse consequuntur commodi iure?
              Nulla possimus alias vel dicta, libero, expedita, nihil assumenda
              minus corporis magni officiis ab. Lorem ipsum, dolor sit amet
              consectetur adipisicing elit. Ipsum, perferendis illum, corrupti
              eveniet vero tempore cumque quis nesciunt soluta temporibus enim.
              Ipsum ullam nulla hic dolor eaque laboriosam aperiam excepturi!
            </p>
          </li>
          <li class="reviews-grid__item">
            <div class="stars">
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
            </div>
            <h5 class="ms900">Lorem ipsum dolor sit amet.</h5>
            <p>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis
              ipsum voluptatibus perspiciatis esse consequuntur commodi iure?
              Nulla possimus alias vel dicta, libero, expedita, nihil assumenda
              minus corporis magni officiis ab. Lorem ipsum, dolor sit amet
              consectetur adipisicing elit. Ipsum, perferendis illum, corrupti
              eveniet vero tempore cumque quis nesciunt soluta temporibus enim.
              Ipsum ullam nulla hic dolor eaque laboriosam aperiam excepturi!
            </p>
          </li>
          <li class="reviews-grid__item">
            <div class="stars">
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
            </div>
            <h5 class="ms900">Lorem ipsum dolor sit amet.</h5>
            <p>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis
              ipsum voluptatibus perspiciatis esse consequuntur commodi iure?
              Nulla possimus alias vel dicta, libero, expedita, nihil assumenda
              minus corporis magni officiis ab. Lorem ipsum, dolor sit amet
              consectetur adipisicing elit. Ipsum, perferendis illum, corrupti
              eveniet vero tempore cumque quis nesciunt soluta temporibus enim.
              Ipsum ullam nulla hic dolor eaque laboriosam aperiam excepturi!
            </p>
          </li>
          <li class="reviews-grid__item">
            <div class="stars">
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
              <img src="<?=$project_base?>images/star.png" alt="stars" />
            </div>
            <h5 class="ms900">Lorem ipsum dolor sit amet.</h5>
            <p>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis
              ipsum voluptatibus perspiciatis esse consequuntur commodi iure?
              Nulla possimus alias vel dicta, libero, expedita, nihil assumenda
              minus corporis magni officiis ab. Lorem ipsum, dolor sit amet
              consectetur adipisicing elit. Ipsum, perferendis illum, corrupti
              eveniet vero tempore cumque quis nesciunt soluta temporibus enim.
              Ipsum ullam nulla hic dolor eaque laboriosam aperiam excepturi!
            </p>
          </li>
        </ul>
        <button id="loadmore" type="button">
          <img src="<?=$project_base?>images/more.svg" alt="more" />
        </button>
      </div>
    </div> -->
  </main>

  <?php include 'includes/imports.php'?>
<script>
  function priceSet(value, pd){
    document.querySelector('#numberPersons').value = value; 
    document.querySelector('#uprice').value = pd * value; 
    document.querySelectorAll('.prices-total').forEach(element => {
      element.innerHTML = `$${number_format(pd * value,0,'.','.')}`
    });
  }
  const container = document.getElementById("container");
  const imagen = document.getElementById("mi-imagen");
  if(imagen.width <1600){
    container.style.backgroundImage = "";
  }

  // Cargar imagen
  imagen.onload = function () {
    // Crear un canvas
    const canvas = document.createElement("canvas");
    const ctx = canvas.getContext("2d");
    
    canvas.width = imagen.width;
    canvas.height = imagen.height;

    // Dibujar imagen en el canvas
    ctx.drawImage(imagen, 0, 0);

    // Obtener los datos de píxeles del canvas
    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const pixels = imageData.data;

    // Calcular el color predominante
    let r = 0,
      g = 0,
      b = 0;
    for (let i = 0; i < pixels.length; i += 4) {
      r += pixels[i];
      g += pixels[i + 1];
      b += pixels[i + 2];
    }
    const promedioR = Math.round(r / (pixels.length / 4));
    const promedioG = Math.round(g / (pixels.length / 4));
    const promedioB = Math.round(b / (pixels.length / 4));
    const colorPredominante = `rgb(${promedioR}, ${promedioG}, ${promedioB})`;

    // Establecer el color de fondo
    container.style.backgroundColor = colorPredominante;
  };

  // Cargar la imagen
  imagen.src = "<?=$plan->field_img != "" ? $plan->field_img : $plan->field_pb_oferta_img_listado?>";
</script>
</body>
