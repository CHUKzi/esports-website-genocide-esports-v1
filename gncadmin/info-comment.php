<?php
session_start();
error_reporting(0);
require_once('includes/time-functions.php');
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_GET['id']))
	{
		$cmtid=$_GET['id'];
	}
if(isset($_GET['del']))
{
$id=$_GET['del'];

$cmt_posted=$_GET['name'];

$is_delete='1';

$sql = "UPDATE comments SET is_delete=(:is_delete) WHERE id=:id";
$query = $dbh->prepare($sql);
$query-> bindParam(':is_delete', $is_delete, PDO::PARAM_STR);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();

	$sender='Admin';
	$history_type=',s comment is temporarily deleted';

	$sqlhist="insert history (user,history_type,title) values (:user,:history_type,:title)";
	$queryhist = $dbh->prepare($sqlhist);
	$queryhist-> bindParam(':user', $sender, PDO::PARAM_STR);
	$queryhist-> bindParam(':title',$cmt_posted, PDO::PARAM_STR);
	$queryhist-> bindParam(':history_type', $history_type, PDO::PARAM_STR);
	$queryhist->execute();

	echo "<script type='text/javascript'>alert('comments Deleted successfully');</script>";
	echo "<script type='text/javascript'> document.location = 'blog-page.php'; </script>";
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
	
	<title>MANAGE WEB POSTS - COMMENT INFO</title>

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
.boxes {
  width: 609px;
  height: 349px;
  padding: 12px;
  border: 2px solid gray;
  margin: 0;
  display: inline-block;
}
		</style>
  <script src="https://cdn.tiny.cloud/1/bv5a14g71ngqfnetpdy42q9a139li5dutndzg3fdpth22wx5/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

</head>

<?php
		$sql = "SELECT * from comments where id = :cmtid";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':cmtid',$cmtid,PDO::PARAM_INT);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;	
?>
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
                            <h2><?php echo htmlentities($result->name);?>'s comment</h2>
								<div class="panel panel-default">
									<div class="panel-heading">:post date <?php echo htmlentities($result->time);?></div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">


<?php 
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
$comment2 = (htmlentities($result->comment));
$comment = str_replace(array("\n","\n"),'<br>', $comment2);

	//date_default_timezone_set('asia/colombo'); 
	$curenttime=$result->time;
	$time_ago =strtotime($curenttime);
?>
        <h5 style="background:#ededed;padding:20px;"><i class="fa fa-user text-primary"></i>&nbsp;&nbsp;<b class="text-primary"><?php echo htmlentities($result->name);?> &nbsp;&nbsp; - Posted: <i><?php echo timeAgo($time_ago);?></i></b>&nbsp;&nbsp;

<a href="info-comment.php?del=<?php echo $result->id;?>&name=<?php echo htmlentities($result->name);?>" onclick="return confirm('Are you sure want to Delete This comment?');"><i class="fa fa-trash" style="color:red"></i></a>
<br><br>
<?php 
if(preg_match($reg_exUrl, $comment, $url)) {
       echo preg_replace($reg_exUrl,'<a href="'. $url[0] .'" target="_blank">'. $url[0] .'</a>', $comment);
} else {
       echo $comment;
}
?>
<br><br><b class="text-warning"><i><?php echo htmlentities($result->email);?></i></b>
</h5>
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