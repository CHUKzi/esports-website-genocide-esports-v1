<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	
if(isset($_GET['del']))
{
$id=$_GET['del'];

$cmt_posted=$_GET['name2'];

	$sender='Admin';
	$history_type=', Blog is Permanently deleted';

	$sqlhist="insert history (user,history_type,title) values (:user,:history_type,:title)";
	$queryhist = $dbh->prepare($sqlhist);
	$queryhist-> bindParam(':user', $sender, PDO::PARAM_STR);
	$queryhist-> bindParam(':title',$cmt_posted, PDO::PARAM_STR);
	$queryhist-> bindParam(':history_type', $history_type, PDO::PARAM_STR);
	$queryhist->execute();

$sql = "delete from blogs WHERE id=:id";
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
	
	<title>MANAGE WEB POSTS - BLOGS</title>

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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
  <script src="https://cdn.tiny.cloud/1/bv5a14g71ngqfnetpdy42q9a139li5dutndzg3fdpth22wx5/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'textarea2', height : "420"});</script>
</head>

<body>
<style>
.progress-wrapper {
    width:100%;
}
.progress-wrapper .progress {
    background-color:green;
    width:0%;
    padding:5px 0px 5px 0px;
}
</style>
<style>
.container {
  position: relative;
  text-align: center;
  color: white;
}

.top-left {
  position: absolute;
  top: 8px;
  left: 16px;
}

.centered {
  position: absolute;
  top: 50%;
  left: 40%;
  transform: translate(-50%, -50%);
  font-size: 150%;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Blogs</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
								<div class="panel-body" style="background-color:powderblue;">

								<style>
									.boxes {
									  width: 280px;
									  padding: 12px;
									  border: 2px solid gray;
									  margin: 0;
									  display: inline-block;
									}
									.boxe {
									  width: 280px;
									  height: 100px;
									  padding: 12px;
									  /*border: 6px solid gray;*/
									  margin: 0;
									  display: inline-block;
									  text-align: center;
									  position: relative;
  									  text-align: center;
									  }
									.boxcenter {
									  position: absolute;
									  top: 50%;
									  left: 50%;
									  transform: translate(-50%, -50%);
									}
								</style>
								<center>
									<div class="boxe">
										<div class="boxcenter">
											<a href="create-blog.php"><button class="btn btn-primary">+ Create a New Blog Post</button></a>
										</div>
									</div>
									</center>
								</div>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>thumbnail</th>
                                            <th>Title</th>
                                            <th>views</th>
                                            <th>comments</th>
                                            <th>date and time</th>
											<th>Action</th>	
										</tr>
									</thead>
									
									<tbody>

                                    <?php $sql = "SELECT * from  blogs order by time DESC";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><img src="../images/blogs/<?php echo htmlentities($result->thumbnail);?>" class="" alt="" width="100" height="60"></td>
                                            <td><a href="edit-blog.php?edit=<?php echo $result->id;?>" onclick="return confirm('Do you want to Edit');"><?php echo mb_strimwidth($result->title , 0, 35, "...");?></a></td>
                                            <td><i class="fa fa-eye"></i>&nbsp;<?php echo htmlentities($result->views);?></td>
                                            <td>
                                            <?php if($result->if_hide_cmt == 1){?>

												<?php 
												$sql ="SELECT * from comments where post_id = '$result->id'";
												$query = $dbh -> prepare($sql);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												$bg=$query->rowCount();
												?>

                                            	<a href="blog-comments.php?id=<?php echo $result->id;?>"><i class="fa fa-comment">&nbsp;</i>Comments(<?php echo htmlentities($bg);?>)</a>
                                            	<?php }else {?>
                                            	 comments disable
                                            <?php } ?>		
                                            </td>
                                            <td><?php echo htmlentities($result->time);?></td>
                                            											
<td>
<a href="edit-blog.php?edit=<?php echo $result->id;?>" onclick="return confirm('Do you want to Edit');">&nbsp; <i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
<a href="blog-page.php?del=<?php echo $result->id;?>&name2=<?php echo $result->title;?>" onclick="return confirm('Are you sure want to Delete This Post?');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;
</td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>


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