<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{


if(isset($_GET['email']))
	{
		$editid=$_GET['email'];

		$is_reply='1';

		$sql="UPDATE contact SET is_reply='$is_reply' WHERE id='$editid'";
		$query = $dbh->prepare($sql);
		$query->execute();
	}
if(isset($_POST['submit2']))
  {
	$idedit=$_POST['idedit'];

	$name2=$_POST['name2'];

	$is_delete='1';

	$sender='Admin';
	$history_type=',s E-mail is deleted';

	$sqlhist="insert history (user,history_type,title) values (:user,:history_type,:title)";
	$queryhist = $dbh->prepare($sqlhist);
	$queryhist-> bindParam(':user', $sender, PDO::PARAM_STR);
	$queryhist-> bindParam(':title',$name2, PDO::PARAM_STR);
	$queryhist-> bindParam(':history_type', $history_type, PDO::PARAM_STR);
	$queryhist->execute();

	$sql="UPDATE contact SET is_delete=(:is_delete) WHERE id=(:idedit)";

	$query = $dbh->prepare($sql);
	$query-> bindParam(':is_delete', $is_delete, PDO::PARAM_STR);
	$query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
    $query->execute();
    header('Location: emails.php?result=Deleted Successfully..');
}    
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
	
	<title>MANAGE E-MAIL MESSAGE</title>

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

	<script type= "text/javascript" src="../vendor/countries.js"></script>
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
<?php
		$sql = "SELECT * from contact where id = :emailid";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':emailid',$editid,PDO::PARAM_INT);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;	
?>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h3 class="page-title"><font color="#FF7355"><b> <?php echo htmlentities($result->email);?></b></font></h3>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading"><?php echo htmlentities($result->date);?></div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

<div class="panel-body">
	<div class="form-horizontal">

<div class="form-group">
	<label class="col-sm-2 control-label">Name<span style="color:red">*</span></label>
	<div class="col-sm-8">
	<input class="form-control" value="<?php echo htmlentities($result->name);?>" disabled="">
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">E-mail<span style="color:red">*</span></label>
	<div class="col-sm-8">
	<input class="form-control" value="<?php echo htmlentities($result->email);?>" disabled="">
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Subject<span style="color:red">*</span></label>
	<div class="col-sm-8">
	<input class="form-control" value="<?php echo htmlentities($result->subject);?>" disabled="">
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Message<span style="color:red">*</span></label>
	<div class="col-sm-8">
	<textarea class="form-control" cols="30" rows="10" disabled=""><?php echo htmlentities($result->message);?></textarea>
	</div>
</div>
<form method="post" enctype="multipart/form-data" name="imgform">

<input type="hidden" name="idedit" value="<?php echo htmlentities($result->id);?>" >
<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<input type="hidden" name="name2" value="<?php echo htmlentities($result->name);?>">
		<button class="btn btn-danger" name="submit2" type="submit"onclick="return confirm('Are you sure you want to delete <?php echo htmlentities($result->name);?> s message?');"> <i class="fa fa-trash"></i>&nbsp;Delete</button>
	</div>
</div>
</form>
<a href="emails.php"><button class="btn btn-brand"><i class="fa fa-mail-reply"></i>&nbsp;Back To Mail list</button></a>
<a href="dashboard.php"><button class="btn btn-brand"><i class="fa fa-home"></i>&nbsp;Dashboard</button></a>

									</div>
								</div>
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