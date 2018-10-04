<?php include('header.php'); ?>
<div class="wrapper-l">
  <div class="container-l">
    <?php //include('bar-left.php'); ?>
    <section id="sorteo">
      <div class="loto-col-xs-9">
        <?php
          $sqlc = "select * from content where section=" . intval($_GET['s']);
          $rsc = $conn->Execute($sqlc);
        ?>
          
        <h1><?php echo $rsc->fields('title')?></h1>
      </div> 

        <?php
          echo $rsc->fields('content');
        ?>
      
        <?php 
          $sqlgl = "select * from gallery g where g.section=". intval($_GET['s']);
          $rsgl = $conn->Execute($sqlgl);
          $contador = 1;
          while(! $rsgl->EOF){
            $sqlgd ="select * from gallery_detail d where gallery=". intval($rsgl->fields('id'));
            $rsgd= $conn->Execute($sqlgd);
            if($rsgd->RecordCount() > 0){
        ?>
        
      <div class="loto-col-xs-3 txt_raleway12_gray">      	
        <a href="<?php echo $base_url."/"; ?>images/<?php echo $rsgd->fields('picture')?>" class="sorteogal<?php echo $rsgl->fields('id'); ?>" title="<?php echo $rsgd->fields('comment')?>"><img src="<?php echo $base_url."/"; ?>images/<?php echo $rsgl->fields('gallery_icon');?>" width="220" height="150" alt="<?php echo $rsgl->fields('gallery_name');?>" class="img-rounded img_border0"></a>        
        <?php 
          $rsgd->MoveNext(); 
          while(! $rsgd->EOF){
		    ?>       
        <a href="<?php echo $base_url . "/"; ?>images/<?php echo $rsgd->fields('picture')?>" class="sorteogal<?php echo $rsgl->fields('id'); ?>" title="<?php echo $rsgd->fields('comment')?>"></a>
        <?php
            $rsgd->MoveNext(); 
          }
        ?>
        <br>
        <span class="conteomedia">(<?php echo $rsgd->RecordCount(); ?> im&aacute;genes)</span> 
        <script type="text/javascript">
            var opt = {
            caption: true,
            caption_control: true //Note: don't put comma (,) after the last property
            }
            $('a.sorteogal<?php echo $rsgl->fields('id'); ?>').divbox();
        </script> 
          <br>
        <?php echo $rsgl->fields('gallery_description')?>
      </div>

        <?php 
        }
        ?>
        <?php
          $contador +=1;
          $rsgl->MoveNext();
          }
		    ?>

      <div class="clear"></div>
    </section>
    <?php include('bar-right.php'); ?>
    <div class="clear"></div>
  </div>
  <?php include('footer.php'); ?>
