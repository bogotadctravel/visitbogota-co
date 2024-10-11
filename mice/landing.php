<?php 
$bodyClass="fullpage";
include "includes/head.php";
include "includes/header.php";
$landing = $mice->getLanding($_GET['id']);
 ?>
  <div id="mobile"></div>
    <main
      style="
        background-image: url( <?php echo $mice->absoluteURL($landing->field_mainimg); ?>);
      "
    >
      <div class="txt">
        <h1 class="uppercase"><?php echo $landing->title; ?></h1>
      </div>
      <div class="description">
      <?php echo $landing->body; ?>
      </div>
    </main>

    <? include 'includes/footer.php'?>