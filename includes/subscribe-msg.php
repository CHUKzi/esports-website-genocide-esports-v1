<?php if($er1 == 1)
{?>
<div class="alert alert-warning alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>GENOCIDE SAYS!</strong><?php if (!empty($errors)) {foreach ($errors as $error) {echo ': ' . $error . '<br>';}} $email = '';?>
</div>
<?php } else {?>
  <!--disabled-->
<?php } ?>

<?php if($subscribe == 1)
{?>
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>GENOCIDE SAYS!</strong> Thank You For Subscribe
</div>
<?php } else {?>
  <!--disabled-->
<?php } ?>

<?php if($er1 == 2)
{?>
<div class="alert alert-danger alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>SYSTEM SAYS!</strong> Subscribe failed
</div>
<?php } else {?>
  <!--disabled-->
<?php } ?>