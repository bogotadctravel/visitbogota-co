<?php
$bodyClass = 'blog';
include "includes/head.php";

$allBlogs = $b->blogs("all", "all"); $categories = array(); for ($blogi = 0;
$blogi < count($allBlogs); $blogi++) { if (!in_array($b->products(0,
$allBlogs[$blogi]->field_prod_rel), $categories)) { array_push($categories,
$b->products(0, $allBlogs[$blogi]->field_prod_rel)); } }


$filteredCategories = array_map(function ($category) {
  return [
      'ID' => $category->nid,
      'name' => $category->title,
  ];
}, $categories);
?>
<main>
  <h1 class="">
    <img src="images/blogic.svg" alt="blog">
    Blog
  </h1>
  <section class="blog_list container">
    <div class="filters-bar">
        <div>
            <label for="searchEvents"><?=$pi_bogota[7]?></label>
            <input type="text" name="searchEvents" id="searchEvents">
          </div>
          
          <div>
          <label for="searchEvents"><?=$pi_bogota[63]?></label>
        <div id="categorias_blog">
          <select name="categorias_blog"><option value="">CATEGORÍA</option></select>
        </div>
        </div>
        <div>
            <label for="dateStart"><?=$pi_bogota[112]?></label>
            <input type="date" name="dateStart" id="dateStart">
        </div>
        <div>
            <label for="dateStart"><?=$pi_bogota[113]?></label>
            <input type="date" name="dateEnd" id="dateEnd">
        </div>
    </div>
    <?php if (count($allBlogs) >
    0) { ?>
    <div class="repeater">
      <?php for ($i=0; $i < count($allBlogs); $i++) { ?>
        <a
              href="/<?= $lang ?>/blog/all/<?= $b->get_alias($allBlogs[$i]->title) ?>-all-<?= $allBlogs[$i]->nid ?>"
              data-aos="flip-left"
              data-date="<?= $allBlogs[$i]->field_date_1 ?>"
              class="big blog_item"
              data-productid="<?= $allBlogs[$i]->field_nueva_categorizacion1_1 ?>"
            >
              <div class="img">
                <img
                  loading="lazy"
                  data-src="<?= ($urlGlobal . $allBlogs[$i]->field_cover_image) ?>"
                  alt="<?= $b->get_alias($allBlogs[$i]->title) ?>"
                  class="zone_img lazyload"
                  src="https://picsum.photos/20/20"
                />
              </div>
              <div class="desc">
                <?php if($allBlogs[$i]->field_nueva_categorizacion1 != ""){ ?>
                  <small class="tag">
                    <img src="images/mdi_tag.svg" alt="tag"/>
                    <?=$allBlogs[$i]->field_nueva_categorizacion1 ?>
                  </small>
                <?php } ?>
                <h2 class=""><?=$allBlogs[$i]->title?></h2>
                <small class="date"><?= $allBlogs[$i]->field_date ?></small>
              </div>
            </a>
      <?php } ?>
    </div>
    <?php } ?>
  </section>
</main>
<? include 'includes/imports.php'?>
