<?php include('header.php'); ?>
<div class="wrapper-l">
  <div class="container-l">
    <?php //include('bar-left.php'); ?>
    <section id="contenido">
      <div class="loto-col-xs-9 txt_raleway12_gray">
        <?php
	$sqlc = "select * from content where section=" . intval($_GET['s']);
	$rsc = $conn->Execute($sqlc);
    ?>
        <h1><?php echo $rsc->fields('title')?></h1>
        <?php
	  echo $rsc->fields('content');
      ?>
      </div>
      <div class="clear"></div>
    </section>
    <?php include('bar-right.php'); ?>
    <div class="clear"></div>
  </div>
  <?php include('footer.php'); ?>
