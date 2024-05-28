<?php
$bodyClass = 'intern_blog';
include "includes/head.php";
$blog = $b->blogs($_GET['blogID'], $_GET['productID']);
$blog = $blog[0];
$prodRel = $b->products(0, $blog->field_prod_rel)->title;
$blogsRel = $b->blogs("all", ($_GET['productID'] ? $_GET['productID'] : 'all'), 4, 0, 1);

?>
<main>
	<div class="banner" style="background-image:url(<?= ($blog->field_cover_image ? $urlGlobal . $blog->field_cover_image : '/img/noimg.png') ?>)">
		<div class="txt">
			<h3 class="uppercase tag"><img src='images/mdi_tag.svg' alt='tag'/><?= $prodRel ?> </h3>
			<h1 class="uppercase"><?= $blog->title ?></h1>
			<div class="intro"><?= $blog->field_intro_blog ?></div>
			<h3 class="uppercase"><?= $blog->field_date ?></h3>
		</div>
	</div>
	<div class="content">
		<div class="blog_content">
			<?php
				// Reemplazar las rutas de las imágenes
				$body = preg_replace('/src="\/([^"]*)"/', 'src="https://bogotadc.travel/$1"', $blog->body);
				echo $body;
			  ?>
		</div>
	</div>
	<?php if (count($blogsRel) > 0) { ?>
		<div class="container_interest container">
			<h2>También te puede interesar</h2>
			<ul class="blog_rel">
				<?php
				for ($countBlogs = 0; $countBlogs < count($blogsRel); $countBlogs++) {
					$singleBlog = $blogsRel[$countBlogs];
					if ($singleBlog->nid != $_GET['blogID']) {
						$singleProdNameRel = $b->products(0, $singleBlog->field_prod_rel)->title != "" ? $b->products(0, $singleBlog->field_prod_rel)->title : 'all';
						$url = "/" . $lang . "/blog/" . $b->get_alias($singleProdNameRel) . "/" . $b->get_alias($singleBlog->title) . "-all-" . $singleBlog->nid;
						$image = $singleBlog->field_image != "" ? $urlGlobal . $singleBlog->field_image : "/img/noimg.png";
						echo "
							<li>
							<a href='" . $url . "' data-aos='flip-left blog_item' data-productid='" . $b->products(0, $singleBlog->field_prod_rel)->nid . "'>
								  <div class='img'>
									<img loading='lazy' data-src='" . $image . "'
									alt='" . $singleBlog->title . "'
									class='zone_img lazyload' src='https://placehold.co/400x400.jpg?text=visitbogota' />
								  </div>
								  <div class='desc'>
								  <small class='tag'>
								  <img src='images/mdi_tag.svg' alt='tag'/>" . $b->products(0, $singleBlog->field_prod_rel)->title . "</small>
									<h2 class='uppercase'>" . $singleBlog->title . "</h2>
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
<? include 'includes/imports.php' ?>