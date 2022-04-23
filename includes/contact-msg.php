<?php if($err4 == 1)
{?>

<div class="alert alert-warning alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>GENOCIDE SAYS!<br> </strong><?php if (!empty($errors4)) {foreach ($errors4 as $error) {echo ': ' . $error . '<br>';}} ?>
</div>
<?php } else {?>
  <!--disabled-->
<?php } ?>

<?php if($suces == 1)
{?>
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>GENOCIDE SAYS!</strong> Your message sent successfully
</div>
<?php } else {?>
  <!--disabled-->
<?php } ?>

<?php if($err4 == 2)
{?>
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>SYSTEM SAYS!</strong> message sent failed
</div>
<?php } else {?>
  <!--disabled-->
<?php } ?>