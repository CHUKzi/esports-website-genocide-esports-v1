<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

	if(isset($_POST['submit']))
  {	

	$list=$_POST['list'];
	$history_type='category createed';
	$sender='Admin';

    $sqlhist="insert history (user,history_type,title) values (:user,:history_type,:title)";
    $queryhist = $dbh->prepare($sqlhist);
	$queryhist-> bindParam(':user', $sender, PDO::PARAM_STR);
	$queryhist-> bindParam(':title',$list, PDO::PARAM_STR);
    $queryhist-> bindParam(':history_type', $history_type, PDO::PARAM_STR);
    $queryhist->execute();

	$sql="insert into category_list (sender, list) values (:user,:list)";

	$query = $dbh->prepare($sql);
	$query-> bindParam(':user', $sender, PDO::PARAM_STR);
	$query-> bindParam(':list', $list, PDO::PARAM_STR);
    $query->execute();
    //echo "<script>alert('new category is Added successfully');</script>";
    //header('Location: upload-project.php');
	//$msg=" your post is upload successfully";
    echo "<script type='text/javascript'>alert('Category is Added successfully!');</script>";
	echo "<script type='text/javascript'> document.location = 'upload-project.php'; </script>";
  }
if(isset($_GET['del']) && isset($_GET['list']))
{
$id=$_GET['del'];
$list=$_GET['list'];

$sender='Admin';
$history_type='category deleted';

$sqlhist="insert history (user,history_type,title) values (:user,:history_type,:title)";
$queryhist = $dbh->prepare($sqlhist);
$queryhist-> bindParam(':user', $sender, PDO::PARAM_STR);
$queryhist-> bindParam(':title',$list, PDO::PARAM_STR);
$queryhist-> bindParam(':history_type', $history_type, PDO::PARAM_STR);
$queryhist->execute();

$sql = "delete from category_list WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();

$msg="Data Deleted successfully";

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
	
	<title>PROJECT CATEGORY</title>

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
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
                            <h2>PROJECT CATEGORY</h2>
								<div class="panel panel-default">
									<div class="panel-heading">PROJECT CATEGORY</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
										<form method="post" class="form-horizontal" enctype="multipart/form-data">

										<div class="form-group">
											<label class="col-sm-2 control-label">Category name<span style="color:red">*</span></label>
											<div class="col-sm-6">
											<input type="text" name="list" placeholder="Do not use more than 100 words" class="form-control" required>
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2">
												<button class="btn btn-primary" name="submit" type="submit">+ADD NOW</button>
											</div>
										</div>
										</form>

										<center>
											<div class="col-sm-12 col-sm-offset-0">
												<a href="upload-project.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back Here</button></a>

												<a href="category.php"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

												<a href="../our-works.php" target="_blank"><button class="btn btn-danger"><i class="fa fa-eye"></i> Preview </button></a>
											</div>
										</center>
									</div>
								</div>
							</div>

							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Category list</div>
									<div class="panel-body">
										<?php $sql = "SELECT * from  category_list ";
										$query = $dbh -> prepare($sql);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
										if($query->rowCount() > 0)
										{
										foreach($results as $result)
										{				?>
										<a href="upload-project.php"><?php echo htmlentities($result->list);?></a>
											<a href="edit-category.php?edit=<?php echo $result->id;?>" onclick="return confirm('Do you want to Edit <?php echo htmlentities($result->list);?>');">&nbsp; <i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
											<a href="category.php?del=<?php echo $result->id;?>&list=<?php echo htmlentities($result->list);?>" onclick="return confirm('Do you want to Delete <?php echo htmlentities($result->list);?>');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;<br>

										<?php $cnt=$cnt+1; }} ?>
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