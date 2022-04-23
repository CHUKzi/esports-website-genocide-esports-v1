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
		$blogid=$_GET['id'];
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
	
	<title>MANAGE BLOG COMMENTS</title>

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
		$sql = "SELECT * from blogs where id = :blogid";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':blogid',$blogid,PDO::PARAM_INT);
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
                            <h2><?php echo htmlentities($result->title);?></h2>
								<div class="panel panel-default">
									<div class="panel-heading">Blog : <?php echo htmlentities($result->title);?>  :: date <?php echo htmlentities($result->time);?></div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">

										<center>
											<!--<div class="boxes">-->
												<div2><img src="../images/blogs/<?php echo htmlentities($result->thumbnail);?>" width="540px"/></div2>
											<!--</div>-->
										</center>
										<br>
										<center>
											<div class="col-sm-12 col-sm-offset-0">
												<a href="blog-page.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back Here</button></a>

												<a href="blog-comments.php?id=<?php echo $blogid;?>"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

												<?php
												$string = str_replace(' ', '-', $result->title);
												$string = preg_replace("/[\s-]+/", " ", $string);
												// Convert whitespaces and underscore to dash
												$string = preg_replace("/[\s_]/", "-", $string);
												?>
												<a href="../blog-details.php?id=<?php echo $blogid;?>&name=<?php echo $string ; ?>" target="_blank"><button class="btn btn-danger"><i class="fa fa-eye"></i> Preview </button></a>
											</div>
										</center><br><br><br>
<?php 
$sql = "SELECT * from comments where post_id = '$blogid' order by time DESC";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>

<?php 
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
$comment2 = (htmlentities($result->comment));
$comment = str_replace(array("\n","\n"),'<br>', $comment2);

	date_default_timezone_set('asia/colombo'); 
	$curenttime=$result->time;
	$time_ago =strtotime($curenttime);
?>
        <h5 style="background:#ededed;padding:20px;"><a href="info-comment.php?id=<?php echo $result->id;?>">(<?php echo htmlentities($cnt);?>). <i class="fa fa-user text-primary"></i>&nbsp;&nbsp;<b class="text-primary"><?php echo htmlentities($result->name);?></a> &nbsp;&nbsp; - Posted: <i><?php echo timeAgo($time_ago);?></i></b>&nbsp;&nbsp;
<?php if($result->is_delete == 1)
{?>

<br><br> <?php } else {?>
<a href="info-comment.php?id=<?php echo $result->id;?>"><i class="fa fa-eye" style="color:blue"></i></a>&nbsp;&nbsp;
<br><br>
<?php } ?>
<?php if($result->is_delete == 1)
{?>
<i><center>This comment has been deleted BY Admin<br><br><a href="recovery-or-delete-comment.php?id=<?php echo $result->id;?>"> <u>Recovery OR permanent delete this Commennt</u></a></center></i>

<?php } else {?>
<?php 
if(preg_match($reg_exUrl, $comment, $url)) {
       echo preg_replace($reg_exUrl,'<a href="'. $url[0] .'" target="_blank">'. $url[0] .'</a>', $comment);
} else {
       echo $comment;
}
?>
<?php } ?>

</h5>
<?php $cnt=$cnt+1; }} else {$no_cmt='<center><p>no comments for this post.</p></center>'; } ?>
<?php echo $no_cmt;?>


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