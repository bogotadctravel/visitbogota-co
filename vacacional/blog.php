<?php
$bodyClass = 'blog';
include "includes/head.php";

$allBlogs = $b->blogs("all", "all"); $categories = array(); for ($blogi = 0;
$blogi < count($allBlogs); $blogi++) { if (!in_array($b->products(0,
$allBlogs[$blogi]->field_prod_rel), $categories)) { array_push($categories,
$b->products(0, $allBlogs[$blogi]->field_prod_rel)); } }

?>
<main>
  <h1 class="">
    <img src="images/blogic.svg" alt="blog">
    Blog
  </h1>
  <!-- <div class="container custom-select-container">
    <div class="custom-select" id="categorias_blog"><select ><option value="">CATEGORÍA</option></select></div>
  </div> -->
  <section class="blog_list container">
    <?php if (count($allBlogs) >
    0) { ?>
    <div class="repeater">
      <?php for ($i=0; $i < count($allBlogs); $i++) { ?>
        <a
              href="/<?= $lang ?>/blog/all/<?= $b->get_alias($allBlogs[$i]->title) ?>-all-<?= $allBlogs[$i]->nid ?>"
              data-aos="flip-left"
              class="big blog_item"
              data-productid="<?= $b->products(0, $allBlogs[$i]->field_prod_rel)->nid ?>"
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
