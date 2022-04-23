<?php if($err3 == 1)
{?>
<div class="alert alert-warning alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>GENOCIDE SAYS!<br> </strong><?php if (!empty($errorss)) {foreach ($errorss as $error) {echo ': ' . $error . '<br>';}} ?>
</div>
<?php } else {?>
  <!--disabled-->
<?php } ?>

<?php if($suces == 1)
{?>
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>GENOCIDE SAYS!</strong> published Successfully
</div>
<?php } else {?>
  <!--disabled-->
<?php } ?>

<?php if($err3 == 2)
{?>
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>SYSTEM SAYS!</strong> Published failed
</div>
<?php } else {?>
  <!--disabled-->
<?php } ?>