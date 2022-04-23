<?php
session_start();
error_reporting(0);
include('includes/config.php');
require_once('includes/time-functions.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{


?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>RECOVEY EMAILS</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="img/favicon.png" type="img/x-icon">
  <style>

	.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
	background: #dd3d36;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
	background: #5cb85c;
	color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}

		</style>

</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Deleted E-mailes</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">List deleted e-mails</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										       <th>#</th>
												<th>Name</th>
												<th>email</th>
                                                <th>subject</th>
                                                <th>sent date</th>
											    <th>Action</th>
											    <th>seen OR not seen</th>
										</tr>
									</thead>
									
									<tbody>
                                    <?php $sql = "SELECT * from contact order by date DESC";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>
                                            <?php if($result->is_delete == 0)
                                                    {?>

                                             <?php } else {?>
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->name);?></td>
											<td><?php echo htmlentities($result->email);?></td>
                                            <td><?php echo htmlentities($result->subject);?></td>

<?php
	date_default_timezone_set('asia/colombo'); 
	$curenttime=$result->date;
	$time_ago =strtotime($curenttime);
 ?>
                                            <td><?php echo timeAgo($time_ago);?></a></td>
                                            <td>
											<a href="show-contact-mails-recovery.php?email=<?php echo $result->id;?>">&nbsp; <i class="fa fa-eye"></i>&nbsp;view more</a>
											</td>
											<td>
                                            <?php if($result->is_reply == 1)
                                                    {?>
                                                    <div style="color:white;background-color: #4CAF50;text-align: center;">
                                                    	Seen <i class="fa fa-check-circle"></i> 	
                                                    </div>
                                                    <?php } else {?>
                                                    <div style="color:white;background-color: #f44336;text-align: center;">
                                                    	New <i class="fa fa-envelope" aria-hidden="true"></i>
                                                    </div>
                                                    <?php } ?>
											</td>
											
										</tr>
										<?php } ?>
										<?php $cnt=$cnt+1; }} ?>

									</tbody>
								</table>
										<center>
											<div class="col-sm-12 col-sm-offset-0">
												<a href="advanced.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back </button></a>

												<a href="emails-recovery.php"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

											</div>
										</center><br><br>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
		</script>
</body>
</html>
<?php } ?>
