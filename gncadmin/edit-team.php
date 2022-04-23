<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_GET['edit']))
	{
		$editid=$_GET['edit'];
	}

if(isset($_POST['submit']))
  {
	$file = $_FILES['avatar']['name'];
	$file_loc = $_FILES['avatar']['tmp_name'];
	$folder="../images/resource/";
	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name);
	
	$avatar=$_POST['avatar'];
	$name=$_POST['name'];
	$designation=$_POST['designation'];
	$fb=$_POST['fb'];
	$twitter=$_POST['twitter'];
	$instagram=$_POST['instagram'];
	$idedit=$_POST['idedit'];

	if(move_uploaded_file($file_loc,$folder.$final_file))
		{
			$avatar=$final_file;
		}

	$sql="UPDATE our_team SET avatar=(:avatar), name=(:name), designation=(:designation), fb=(:fb), twitter=(:twitter), instagram=(:instagram) WHERE id=(:idedit)";
	$query = $dbh->prepare($sql);

	$query-> bindParam(':avatar', $avatar, PDO::PARAM_STR);
	$query-> bindParam(':name', $name, PDO::PARAM_STR);
	$query-> bindParam(':designation', $designation, PDO::PARAM_STR);
	$query-> bindParam(':fb', $fb, PDO::PARAM_STR);
	$query-> bindParam(':twitter', $twitter, PDO::PARAM_STR);
	$query-> bindParam(':instagram', $instagram, PDO::PARAM_STR);
	$query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
	$query->execute();
	$msg=" Edit Successfully";
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
	
	<title>EDIT MEMBER</title>

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

	<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

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
  width: 280px;
  padding: 12px;
  border: 2px solid gray;
  margin: 0;
  display: inline-block;
}
		</style>
</head>

<body>
<?php
		$sql = "SELECT * from our_team where id = :editid";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':editid',$editid,PDO::PARAM_INT);
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
						<h3 class="page-title">EDIT MEMBER : <font color="#FF7355"><b> <?php echo htmlentities($result->name);?></b></font></h3>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default" style="background-color:powderblue;">
									<div class="panel-heading">EDIT MEMBER</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

<center>
									<div class="panel-body">

									<div class="boxes">
										<center>
										<img id="blah3" src="#" alt=" Please Choose your image (350x360px)" /><br>
										<div3><img src="../images/resource/<?php echo htmlentities($result->avatar);?>" width="220px"/></div3>
										<h4><?php echo htmlentities($result->name);?></h4>
										<h4><?php echo htmlentities($result->designation);?></h4>
										<a href="<?php echo htmlentities($result->fb);?>" target="_blank"><i class="fa fa-facebook-square" style="font-size:20px;color:blue;"></i></a>
										<a href="<?php echo htmlentities($result->twitter);?>" target="_blank"><i class="fa fa-twitter" style="font-size:20px;color:blue;"></i></a>
										<a href="<?php echo htmlentities($result->instagram);?>" target="_blank"><i class="fa fa-instagram" style="font-size:20px;color:blue;"></i></a>
									</center><hr>
										<a href="about-us-page.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to Delete <?php echo htmlentities($result->name);?> from team');"><i class="fa fa-trash" style="font-size:25px;color:red;"></i></a>
									</div>
									</center>
									<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">

									<div class="form-group">
										<div class="col-sm-8 col-sm-offset-2">
											<input type="hidden" name="avatar" value="<?php echo htmlentities($result->avatar);?>" >
											<input type="hidden" name="idedit" value="<?php echo htmlentities($result->id);?>" >
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Edit Image<span style="color:red">*</span></label>
										<div class="col-sm-9">
										<input type="file" name="avatar" class="form-control" id="teamimg" onchange="readURL3(this);">
										</div>
									</div>


									<div class="form-group">
										<label class="col-sm-2 control-label">Edit Name<span style="color:red">*</span></label>
										<div class="col-sm-9">
										<input type="text" name="name" placeholder="Post Title (Do not use more than 100 words)" class="form-control" required value="<?php echo htmlentities($result->name);?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Edit Designation<span style="color:red">*</span></label>
										<div class="col-sm-9">
										<input type="text" name="designation" placeholder="(Do not use more than 100 words)" class="form-control" required value="<?php echo htmlentities($result->designation);?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Edit Facebook<span style="color:red">*</span></label>
										<div class="col-sm-9">
										<input type="text" name="fb" placeholder="(Do not use more than 100 words)" class="form-control" required value="<?php echo htmlentities($result->fb);?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Edit twitter<span style="color:red">*</span></label>
										<div class="col-sm-9">
										<input type="text" name="twitter" placeholder="(Do not use more than 100 words)" class="form-control" required value="<?php echo htmlentities($result->twitter);?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Edit instagram<span style="color:red">*</span></label>
										<div class="col-sm-9">
										<input type="text" name="instagram" placeholder=" (Do not use more than 100 words)" class="form-control" required value="<?php echo htmlentities($result->instagram);?>">
										</div>
									</div>

									<input type="hidden" name="idedit" value="<?php echo htmlentities($result->id);?>" >
									<div class="form-group">
										<div class="col-sm-8 col-sm-offset-2">
											<button class="btn btn-primary" name="submit" type="submit" onclick="postFile2()">Save Changes</button>
										</div>
									</div>

									</form>
									<div id="progress-bar-file2" class="progress"></div>
										<center>
											<div class="col-sm-12 col-sm-offset-0">
												<a href="about-us-page.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back Here</button></a>

												<a href="add-team.php"><button class="btn btn-warning">+ Add New Member</button></a>

												<a href="edit-team.php?edit=<?php echo htmlentities($result->id);?>"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

												<a href="../about-us.php#members_area" target="_blank"><button class="btn btn-danger"><i class="fa fa-eye"></i>Preview </button></a>
											</div>
										</center><br><br>
										<script>
										function postFile2() {
										    var formdata = new FormData();

										    formdata.append('teamimg', $('#teamimg')[0].files[0]);

										    var request = new XMLHttpRequest();

										    request.upload.addEventListener('progress', function (e) {
										        var file1Size = $('#teamimg')[0].files[0].size;

										        if (e.loaded <= file1Size) {
										            var percent = Math.round(e.loaded / file1Size * 100);
										            $('#progress-bar-file2').width(percent + '%').html(percent + '%');
										        } 

										        if(e.loaded == e.total){
										            $('#progress-bar-file2').width(100 + '%').html(100 + '%');
										        }
										    });   

										    request.open('post', '/echo/html/');
										    request.timeout = 45000;
										    request.send(formdata);
										}
										</script><br><br><br><br>
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
	<script>
		function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah3')
                        .attr('src', e.target.result)
                        .width(220)
                };

                reader.readAsDataURL(input.files[0]);
                $("div3").hide();
            }
        }
    </script>

</body>
</html>
<?php } ?>