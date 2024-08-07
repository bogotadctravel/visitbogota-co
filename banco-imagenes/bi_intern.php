<?php
$bodyClass='intern';
$header2 =1; 
include "includes/head.php";
$infoGnrl = $bi->BIgeneralInfo;
$image = $bi->getImages(false, false, $_GET["id"]);
if($image->field_bi_producto_relacionado != "" && $image->field_bi_zona_rel != ""){ 
  $explode1 = explode(", ", $image->field_bi_producto_relacionado);
  $explode2 = explode(", ", $image->field_bi_zona_rel); 
  $imagesRel= $bi->getImages($explode1, $explode2); 
} 
if($image->field_is_video){
  $imagePath = "/banco-imagenes/download/video/" . $image->field_bifilename .'.mp4';
}else{
  $imagePath = "/banco-imagenes/download/1200/" . $bi->replaceSpecialCharactersWithUnderscores($image->field_bifilename) . '.jpg';

}
?>
<main>
  <section class="fullImage">
    <div class="container">
      <a href="javascript:history.back();" class="back"
        ><img
          src="img/arrowback0.svg"
          alt="arrow"
        /><?=$infoGnrl->field_bi_ui_11?></a
      >
    </div>
    <div class="container">
      <div class="imagedata <?= $image->field_is_video == '1' ? "isVideo" : ""?>">
        <? if($image->field_is_video == '1'){ ?>
        <video
          autobuffer
          autoplay
          muted
          preload="auto"
          loop
          src="<?=$imagePath?>"
        >
          <source src="<?=$imagePath?>" />
        </video>
        <? }else{ ?>
        <img
          src="<?=$imagePath?>"
          alt="<?=$image->title?>"
        />
        <? } ?>
        <div class="fixed">
          <p>
            ID de foto de stock :
            <?=$image->nid?>
          </p>
          <p><?=$image->field_bi_autor?></p>
        </div>
      </div>
      <div class="imageinfo">
        <?php 
        if(isset($image->field_bi_atractivo_relacionado_1) && $image->field_bi_atractivo_relacionado_1 != ""){
        ?>
        <span class="title">
          ATRACTIVO:
          <a target="_blank" rel="noopener noreferrer"
            href="https://files.visitbogota.co/es/atractivo/all/<?=$bi->get_alias($image->field_bi_atractivo_relacionado_1)?>-all-<?=$image->field_bi_atractivo_relacionado?>"
            aria-label="Ver detalles del atractivo <?=$image->field_bi_atractivo_relacionado_1?>"
           >
            <?=$image->field_bi_atractivo_relacionado_1?></a>
            </span>
        <?php 
        }
        ?>
        <div class="rules">
          <?=$infoGnrl->field_bi_texto_descarga?>
          <p style="margin-top: 20px">
            Foto / video tomado por: <b><?=$image->field_bi_autor?></b>,
            recuerda darle créditos. El autor recomienda no hacer modificaciones
            extremas a la obra.
          </p>
          <a
            href="javascript:;"
            data-fancybox="dialog"
            data-src="#dialog-content"
            class="green-btn"
          >
            <?= $image->field_is_video == '1' ?
            $infoGnrl->field_bi_ui_14 : $infoGnrl->field_bi_ui_13?></a
          >
        </div>
      </div>
    </div>
  </section>
  <? if( count($imagesRel) >
  0){ ?>
  <section class="rel">
    <h3> Imágenes / videos relacionados</h3>
    <div class="grid-rela">
      <? for ($i=0; $i < count($imagesRel); $i++) { 
         $imagePath = "/banco-imagenes/download/500/" . $bi->replaceSpecialCharactersWithUnderscores($images[$i]->field_bifilename) . ($images[$i]->field_is_video == '1' ? '.mp4' : '.jpg');
         if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath)) {

        ?>
      <a href="/<?=$lang?>/banco-imagenes/interna-<?=$imagesRel[$i]->nid?>">
        <img
          src="<?=$imagePath?>"
          alt="<?=$imagesRel[$i]->title?>"
        />
        <? if($imagesRel[$i]->field_is_video == '1'){ ?>
                  <img src="img/film.png"  alt="video icon" class="video-icon"/>
                <? } ?>
      </a>
      <? } ?>
    </div>
  </section>
  <? }} ?>
</main>

<div
  id="dialog-content"
  class="downloadPhoto"
  style="display: none; max-width: 580px"
>
  <?if(isset($_COOKIE["firstdownload"])){?>
  <form action="set/sendimage.php" method="POST" id="firstdown">
    <h2>¡Ya casi tienes tu <?= $image->field_is_video == '1' ? "video" : "foto" ?>!</h2>
    <? if( $image->field_is_video != '1'){ ?>
      <p>Para descargarla, escoge el tamaño que necesites</p>
      <div class="c-select">
        <select
          name="size"
          id="size"
          onchange="document.querySelector('#downloadbi').href = this.value"
        >
          <option value="">Elige un tamaño de la imagen</option>
          <option
            value="<?="/banco-imagenes/download/impresion/" . $bi->replaceSpecialCharactersWithUnderscores($image->field_bifilename) . ($image->field_is_video == '1' ? '.mp4' : '.jpg')?>"
          >
            Formato impresión
          </option>
          <option
            value="<?="/banco-imagenes/download/2000/" . $bi->replaceSpecialCharactersWithUnderscores($image->field_bifilename) . ($image->field_is_video == '1' ? '.mp4' : '.jpg')?>"
          >
            Formato web grande - 2000px
          </option>
          <option
            value="<?="/banco-imagenes/download/1200/" . $bi->replaceSpecialCharactersWithUnderscores($image->field_bifilename) . ($image->field_is_video == '1' ? '.mp4' : '.jpg')?>"
          >
            Formato web pequeño - 1200px
          </option>
          <option
            value="<?="/banco-imagenes/download/500/" . $bi->replaceSpecialCharactersWithUnderscores($image->field_bifilename) . ($image->field_is_video == '1' ? '.mp4' : '.jpg')?>"
          >
            Miniatura - 500px
          </option>
        </select>
        <div class="c-arrow"></div>
      </div>
    <? } ?>
    <?php
      $imagePathDown = "";
    if($image->field_is_video){
      $imagePathDown = "/banco-imagenes/download/video/" . $image->field_bifilename .'.mp4';
    }else{
      $imagePathDown = "/banco-imagenes/download/1200/" . $bi->replaceSpecialCharactersWithUnderscores($image->field_bifilename) . '.jpg';
    }
    ?>
    <a
      href="<?=$imagePathDown?>"
      download
      target="_blank"
      id="downloadbi"
      class="green-btn uppercase"
    >
    <?= $image->field_is_video == '1' ?
            $infoGnrl->field_bi_ui_14 : $infoGnrl->field_bi_ui_13?></a
    >
  </form>
  <?}else{?>
  <h2> <?= $image->field_is_video == '1' ? "¡Ya casi tienes tu video!" : "¡Ya casi tienes tu foto!" ?> </h2>
  
  <p>
    <?= $image->field_is_video == '1' ? "Para descargarla, escribe tu nombre y
     apellido, el correo al cual llegará el link de descarga, acepta los términos
     y condiciones, y conﬁrma. Recuerda que solo te solicitaremos estos datos la
     primera vez que realices una descarga en un dispositivo nuevo.": "Para descargarla, escoge el tamaño que necesites, escribe tu nombre y
     apellido, el correo al cual llegará el link de descarga, acepta los términos
     y condiciones, y conﬁrma. Recuerda que solo te solicitaremos estos datos la
     primera vez que realices una descarga en un dispositivo nuevo."
    ?>
    
  </p>
  <form action="set/sendimage.php" method="POST" id="firstdown">
    <? if( $image->field_is_video != '1'){ ?>
      <div class="c-select">
        <select name="size" id="size">
          <option value="">Elige un tamaño de la imagen</option>
          <option value="<?="/banco-imagenes/download/impresion/" . $bi->replaceSpecialCharactersWithUnderscores($image->field_bifilename) . ($image->field_is_video == '1' ? '.mp4' : '.jpg')?>">Formato impresión</option>
          <option value="<?="/banco-imagenes/download/2000/" . $bi->replaceSpecialCharactersWithUnderscores($image->field_bifilename) . ($image->field_is_video == '1' ? '.mp4' : '.jpg')?>">Formato web grande - 2000px</option>
          <option value="<?="/banco-imagenes/download/1200/" . $bi->replaceSpecialCharactersWithUnderscores($image->field_bifilename) . ($image->field_is_video == '1' ? '.mp4' : '.jpg')?>">Formato web pequeño - 1200px</option>
          <option value="<?="/banco-imagenes/download/500/" . $bi->replaceSpecialCharactersWithUnderscores($image->field_bifilename) . ($image->field_is_video == '1' ? '.mp4' : '.jpg')?>">Miniatura - 500px</option>
        </select>
        <div class="c-arrow"></div>
      </div>
    <? } ?>

    <input type="text" placeholder="Nombre*" name="name" id="name" />
    <input type="text" placeholder="Apellidos*" name="lastname" id="lastname" />
    <input type="text" placeholder="Cédula*" name="cc" id="cc" />
    <input
      type="text"
      placeholder="Correo electrónico*"
      name="email"
      id="email"
    />

    <input type="hidden" name="imageID" id="imageID" value="<?=$_GET["id"]?>" />
    <input type="hidden" name="size" id="size" value="<?="/banco-imagenes/download/video/" . $image->field_bifilename .'.mp4'?>" />
    <input type="hidden" name="link" id="link"
    value="https://www.bogotadc.travel/es/banco-imagenes/descarga-<?=$_GET["id"]?>"
    />
    <div class="politics_checkbox">
      <input type="checkbox" name="politics" id="politics" checked />
      <span class="politics_checkbox_mark"></span>
      <label for="politics"
        ><strong>He leído y acepto</strong> la
        <a
          href="/es/politica-tratamiento-datos-personales"
          target="_blank"
          rel="noopener"
          >política de tratamiento de datos</a
        ></label
      >
    </div>
    <div class="politics_checkbox">
      <input type="checkbox" name="politics2" id="politics2" checked />
      <span class="politics_checkbox_mark"></span>
      <label for="politics2"
        ><strong>He leído y acepto</strong> las condiciones de uso de la imagen.
        <a
          href="<?= $bi->generalInfo->field_resolucion_239?>"
          target="_blank"
          rel="noopener"
          >Resolución 239 del 5 de noviembre de 2021</a
        ></label
      >
    </div>
    <div class="law">
      <p><strong>Ley de Protección de Datos Personales:</strong></p>
      <small
        >“La autorización suministrada en el presente formulario faculta al
        Instituto Distrital de Turismo para que dé a sus datos aquí recopilados
        el tratamiento señalado en la “Política de Privacidad para el
        Tratamiento de Datos Personales” de la entidad, el cual incluye, entre
        otras, el envío de información, así como la invitación a eventos. El
        titular de los datos podrá, en cualquier momento, solicitar que la
        información sea modiﬁcada, actualizada o retirada de las bases de datos
        del Instituto Distrital de Turismo.</small
      >
    </div>
    <button class="green-btn uppercase">CONFIRMAR DESCARGA</button>
  </form>
  <?}?>
</div>
<div
  id="dialog-content-2"
  class="downloadPhoto"
  style="display: none; max-width: 580px"
>
  <h2><?= $image->field_is_video == '1' ? "¡Tu video ya esta listo!" : "¡Tu foto ya esta lista!" ?></h2>
  <p>
    Haz clic en el link para descargar tu <?= $image->field_is_video == '1' ? "video" : "foto" ?>. Esto solo sucederá en tu primera
    descarga.
  </p>
  <a href="" id="linkdown" target="_blank" class="blue-btn uppercase"
    >Descargar <?= $image->field_is_video == '1' ? "video" : "foto" ?></a
  >
</div>
<?php include 'includes/imports.php'?>

</body>

</html>
