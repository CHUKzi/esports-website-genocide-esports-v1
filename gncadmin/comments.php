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

$comments='0';

$sql="UPDATE notification SET comments='$comments' WHERE id='1'";
$query = $dbh->prepare($sql);
$query->execute();
	   
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
	
	<title>MANAGE COMMENTS</title>

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
						<h3 class="page-title">COMMENTS</h3>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">COMMENTS</div>
									   <div class="panel-body">

<center>
	<div class="col-sm-12 col-sm-offset-0">
		<a href="dashboard.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back Dashboard</button></a>

		<a href="comments.php"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

		<a href="blog-page.php"><button class="btn btn-success"><i class="fa fa-arrow-right"></i> all blogs</button></a>

	</div>
</center><br><br>
<?php 
$sql = "SELECT * from comments order by time DESC";
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
<?php $cnt=$cnt+1; }} else {$no_cmt='<center><p>no comments</p></center>'; } ?>
<?php echo $no_cmt;?>
<center>
	<div class="col-sm-12 col-sm-offset-0">
		<a href="dashboard.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back Dashboard</button></a>

		<a href="comments.php"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

		<a href="blog-page.php"><button class="btn btn-success"><i class="fa fa-arrow-right"></i> all blogs</button></a>

	</div>
</center><br><br>
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