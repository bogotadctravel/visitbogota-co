  <? 
  $bodyClass='search';
  $header2 =1; 
  include "includes/head.php";
  $infoGnrl = $bi->BIgeneralInfo; 
  $products = $bogota->products();  ?>
  <?
  $searchWord = $_GET['searchbi'];
  $searchWord = str_replace(' ', '+', $searchWord);
  function atractivos($var){return $var->type == 'Atractivos';}
  if( isset($searchWord) && !isset($_GET['imagenes']) && !isset($_GET['videos'])){
    $images = $bi->searchByWord($searchWord);
  }
  else if( isset($searchWord) && isset($_GET['imagenes']) && isset($_GET['videos'])){
    $busqueda = $bi->searchContent($searchWord);
    $filterBusqueda = array_filter($busqueda, "atractivos");
    $images = $bi->searchByWord($searchWord);
  }else if(isset($_GET['imagenes'])){
    $images = $bi->searchByWord($searchWord, true, false);
  }else if(isset($_GET['videos'])){
    $images = $bi->searchByWord($searchWord, false, true);
  }
  if(isset($_GET['productid'])){
    $images = $bi->getImages(array($_GET['productid']));
    $product = $bogota->products(0,$_GET['productid']);
    $busqueda = $bi->searchContent($product->title);
    $filterBusqueda = array_filter($busqueda, "atractivos");
  }
?>
<? 
// if(isset($searchWord) && count($images) > 0){
//   $fileToOpen = "search.json";
//   $myfile = fopen($fileToOpen , "r") or die("Unable to open file!");
// 	$content = json_decode(fread($myfile, filesize($fileToOpen)));
// 		array_push($content, $_GET['search']);
// $content2 = json_encode($content);
// 	$myfile2 = fopen($fileToOpen , "w") or die("Unable to open file!");
// 	fwrite($myfile2, $content2);
// 	fclose($myfile2);
// }
?>
<script>
  async function getInfo(url){
    let url_explode = url.split('/upload/');
    url_explode = `${url_explode[0]}/upload/fl_getinfo/${url_explode[1]}`;
    var requestOptions = {
      method: 'GET',
      redirect: 'follow'
    };

    const resp = await fetch(url_explode, requestOptions)
    .then(response => response.json())
    .then(result => {
      let object =  {width: result.output.width, height: result.output.height};
      return object;
    })
    .catch(error => console.log('error', error));
    return resp;
  }
  
  async function printFiles() {
    const files = document.querySelectorAll('.right .grid-imagenes li');
    for (const [i, v] of files.entries()) {
      const sizes = await getInfo(v.dataset.image)
      document.querySelector(`.right .grid-imagenes li:nth-of-type(${i+1}) .info small`).innerHTML = `${sizes.width} x ${sizes.height}`;
    }
  
  }
  window.addEventListener('DOMContentLoaded', (event) => {
    printFiles()
});
</script>
  <main>
    <section class="titleResult">
      <h2><?=$infoGnrl->field_bi_ui_06?> <b> “<?=$_GET["searchbi"] ? $_GET["searchbi"] : $product->title?>”</b></h2>     
    </section>
    <section class="portal_list">
      <div class="left">
        <div class="filterContainer">
          <button type="button" id="openFilters" onClick="document.querySelector('.left').classList.toggle('active')">
            <img src="img/arrowFliters.svg" alt="arrow" />
            <small>Filtrar</small>
          </button>
          <div class="filters">
            <h4>PRODUCTO</h4>
            <ul class="filters_products">
              <li>
                <input
                  type="checkbox"
                  name="Gastronomía"
                  id="Gastronomía"
                /><label for="">Gastronomía</label>
              </li>
              <li>
                <input
                  type="checkbox"
                  name="Museos"
                  id="Museos"
                /><label for="">Museos</label>
              </li>
              <li>
                <input
                  type="checkbox"
                  name="Aviturismo"
                  id="Aviturismo"
                /><label for="">Aviturismo</label>
              </li>
              <li>
                <input
                  type="checkbox"
                  name="Termales"
                  id="Termales"
                /><label for="">Termales</label>
              </li>
              <li>
                <input
                  type="checkbox"
                  name="Rutacolonial"
                  id="Rutacolonial"
                /><label for="">Ruta colonial</label>
              </li>
            </ul>
            <h4>LOCALIDAD</h4>
            <ul class="filters_zone">
              <li>
                <input
                  type="checkbox"
                  name="Usaquén"
                  id="Usaquén"
                /><label for="">Usaquén</label>
              </li>
              <li>
                <input
                  type="checkbox"
                  name="Chapinero"
                  id="Chapinero"
                /><label for="">Chapinero</label>
              </li>
              <li>
                <input
                  type="checkbox"
                  name="La Candelaria"
                  id="La Candelaria"
                /><label for="">La Candelaria</label>
              </li>
              <li>
                <input
                  type="checkbox"
                  name="Usme"
                  id="Usme"
                /><label for="">Usme</label>
              </li>
              <li>
                <input
                  type="checkbox"
                  name="Bosa"
                  id="Bosa"
                /><label for="">Bosa</label>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="right">
        <?
        if($images){?>
          <ul class="grid-imagenes">
            <? 
              $imagePath = "";
            for ($i=0; $i < count($images); $i++) {
              if($images[$i]->field_is_video){
                $imagePath = "/banco-imagenes/download/video/" . $images[$i]->field_bifilename .".mp4";
              }else{
                $imagePath = "/banco-imagenes/download/500/" . $bi->replaceSpecialCharactersWithUnderscores($images[$i]->field_bifilename).'.jpg';
              }
              if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath)) {
           ?>
            <li data-image="<?= $imagePath ?>">
            
              <a href="/<?=$lang?>/banco-imagenes/interna-<?=$images[$i]->nid?>"
                >
                <? 
                if($images[$i]->field_is_video){ ?>
                <video
                autobuffer
                autoplay
                muted
                preload="metadata"
                loop
                src="<?=$imagePath?>"
                >
                <source src="<?=$imagePath?>" />
                </video>
                <? }else{ ?>
                  <img
                  src="<?=$imagePath?>"
                  alt="<?=$images[$i]->title?>"
                  />
                  <? } ?>
                <div class="info">
                  <div class="green-btn"><?= $images[$i]->field_is_video == '1' ? "Ver video" : "Ver Imagen" ?></div>
                  <small></small>
                </div>
                <? if($images[$i]->field_is_video == '1'){ ?>
                  <img src="img/film.png"  alt="video icon" class="video-icon"/>
                <? } ?>
                </a
              >
            </li>
            <?}}?>
          </ul>
        <?}?>
      </div>
    </section>

    <section class="grid">
      <h3><?=$infoGnrl->field_bi_ui_10?> </h3>
      <div class="grid-layout">
          <div class="row-1">
            <a class="size1" href="/<?=$lang?>/banco-imagenes/resultados/?productid=<?=$products[0]->nid?>"
              ><strong class="uppercase"><?=$products[0]->title?></strong
              ><img
                src="https://bogotadc.travel<?=$products[0]->field_cover_image?>"
                alt="resultados"
            /></a>
            <a class="size2" href="/<?=$lang?>/banco-imagenes/resultados/?productid=<?=$products[1]->nid?>"
              ><strong class="uppercase"><?=$products[1]->title?></strong
              ><img
                src="https://bogotadc.travel<?=$products[1]->field_cover_image?>"
                alt="resultados"
            /></a>
            <a class="size1" href="/<?=$lang?>/banco-imagenes/resultados/?productid=<?=$products[2]->nid?>"
              ><strong class="uppercase"><?=$products[2]->title?></strong
              ><img
                src="https://bogotadc.travel<?=$products[2]->field_cover_image?>"
                alt="resultados"
            /></a>
          </div>
          <div class="row-2">
            <div class="col-1">
              <div class="col-1__row-1">
                <a class="size3" href="/<?=$lang?>/banco-imagenes/resultados/?productid=<?=$products[3]->nid?>"
                  ><strong class="uppercase"><?=$products[3]->title?></strong
                  ><img
                    src="https://bogotadc.travel<?=$products[3]->field_cover_image?>"
                    alt="resultados"
                /></a>
                <a class="size4" href="/<?=$lang?>/banco-imagenes/resultados/?productid=<?=$products[4]->nid?>"
                  ><strong class="uppercase"><?=$products[4]->title?></strong
                  ><img
                    src="https://bogotadc.travel<?=$products[4]->field_cover_image?>"
                    alt="resultados"
                /></a>
                <a class="size4" href="/<?=$lang?>/banco-imagenes/resultados/?productid=<?=$products[6]->nid?>"
                  ><strong class="uppercase"><?=$products[6]->title?></strong
                  ><img
                    src="https://bogotadc.travel<?=$products[6]->field_cover_image?>"
                    alt="resultados"
                /></a>
              </div>
              <div class="col-1__row-2">
                <a href="/<?=$lang?>/banco-imagenes/resultados/?productid=<?=$products[7]->nid?>"
                  ><strong class="uppercase"><?=$products[7]->title?></strong
                  ><img
                    src="https://bogotadc.travel<?=$products[7]->field_cover_image?>"
                    alt="resultados"
                /></a>
                <a href="/<?=$lang?>/banco-imagenes/resultados/?productid=<?=$products[8]->nid?>"
                  ><strong class="uppercase"><?=$products[8]->title?></strong
                  ><img
                    src="https://bogotadc.travel<?=$products[8]->field_cover_image?>"
                    alt="resultados"
                /></a>
              </div>
            </div>
            <div class="col-2">
              <a class="size5" href="/<?=$lang?>/banco-imagenes/resultados/?productid=<?=$products[9]->nid?>"
                ><strong class="uppercase"><?=$products[9]->title?></strong
                ><img
                  src="https://bogotadc.travel<?=$products[9]->field_cover_image?>"
                  alt="resultados"
              /></a>
              <a class="size5" href="/<?=$lang?>/banco-imagenes/resultados/?productid=<?=$products[11]->nid?>"
                ><strong class="uppercase"><?=$products[11]->title?></strong
                ><img
                  src="https://bogotadc.travel<?=$products[11]->field_cover_image?>"
                  alt="resultados"
              /></a>
            </div>
          </div>
        </div>
      <!-- <a href="" class="blue-btn uppercase"><?=$infoGnrl->field_bi_texto_vertodas?></a> -->
    </section>
  </main>
  <?php include 'includes/imports.php'?>

</body>

</html>