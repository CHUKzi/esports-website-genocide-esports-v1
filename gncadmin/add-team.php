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


	$file = $_FILES['avatar']['name'];
	$file_loc = $_FILES['avatar']['tmp_name'];
	$folder="../images/resource/";
	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name);

	$name=$_POST['name'];
	$designation=$_POST['designation'];
	$fb=$_POST['fb'];
	$twitter=$_POST['twitter'];
	$instagram=$_POST['instagram'];
	$history_type='category createed';
	$sender='Admin';

	if(move_uploaded_file($file_loc,$folder.$final_file))
		{
			$avatar=$final_file;
		}

    //$sqlhist="insert history (user,history_type,title) values (:user,:history_type,:title)";

    //$queryhist = $dbh->prepare($sqlhist);
	//$queryhist-> bindParam(':user', $sender, PDO::PARAM_STR);
	//$queryhist-> bindParam(':title',$list, PDO::PARAM_STR);
    //$queryhist-> bindParam(':history_type', $history_type, PDO::PARAM_STR);
    //$queryhist->execute();

	$sql="insert into our_team (sender, avatar, name, designation, fb, twitter, instagram) values (:user,:avatar,:name,:designation,:fb,:twitter,:instagram)";

	$query = $dbh->prepare($sql);
	$query-> bindParam(':user', $sender, PDO::PARAM_STR);
	$query-> bindParam(':avatar', $avatar, PDO::PARAM_STR);
	$query-> bindParam(':name', $name, PDO::PARAM_STR);
	$query-> bindParam(':designation', $designation, PDO::PARAM_STR);
	$query-> bindParam(':fb', $fb, PDO::PARAM_STR);
	$query-> bindParam(':twitter', $twitter, PDO::PARAM_STR);
	$query-> bindParam(':instagram', $instagram, PDO::PARAM_STR);
    $query->execute();

	echo "<script type='text/javascript'>alert('Added successfully');</script>";
	echo "<script type='text/javascript'> document.location = 'about-us-page.php'; </script>";
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
	
	<title>ADD NEW MEMBER</title>

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
                            <h2>+ ADD NEW MEMBER</h2>
								<div class="panel panel-default">
									<div class="panel-heading">ADD NEW MEMBER</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
										<form method="post" class="form-horizontal" enctype="multipart/form-data">
										<div class="form-group">
											<div class="col-sm-9 col-sm-offset-2">
												<center>
												<img id="blah3" src="#" alt=" Please Choose your image (350x360px)" /><br>
												</center>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Avatar (350x360px)<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="file" name="avatar" class="form-control" id="teamimg" onchange="readURL3(this);" required>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Name<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="name" placeholder="Do not use more than 100 words" class="form-control" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Designation<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="designation" placeholder="Designation" class="form-control" required>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Facebook Profile (link)<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="fb" placeholder="Facebook Profile (link)" class="form-control" required>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Twitter Profile (link)<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="twitter" placeholder="Twitter Profile (link)" class="form-control" required>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Instagram Profile (link)<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="instagram" placeholder="Instagram Profile (link)" class="form-control" required>
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2">
												<button class="btn btn-primary" name="submit" type="submit" onclick="postFile2()">Save Now</button>
											</div>
										</div>
										</form>
										<div id="progress-bar-file2" class="progress"></div>
										<center>
											<div class="col-sm-12 col-sm-offset-0">
												<a href="about-us-page.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back Here</button></a>

												<a href="add-team.php"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

												<a href="../about-us.php#members_area" target="_blank"><button class="btn btn-danger"><i class="fa fa-eye"></i>Preview </button></a>
											</div>
										</center>
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
										</script>
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
                        .width(370)
                };

                reader.readAsDataURL(input.files[0]);
                $("div3").hide();
            }
        }
    </script>
</body>
</html>
<?php } ?>