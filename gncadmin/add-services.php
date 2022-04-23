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


	$file = $_FILES['icon']['name'];
	$file_loc = $_FILES['icon']['tmp_name'];
	$folder="../assets/img/icon/";
	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name);

	$title=$_POST['title'];
	$description=$_POST['description'];
	$link=$_POST['link'];
	$history_type='category createed';
	$sender='Admin';

	if(move_uploaded_file($file_loc,$folder.$final_file))
		{
			$icon=$final_file;
		}

    //$sqlhist="insert history (user,history_type,title) values (:user,:history_type,:title)";

    //$queryhist = $dbh->prepare($sqlhist);
	//$queryhist-> bindParam(':user', $sender, PDO::PARAM_STR);
	//$queryhist-> bindParam(':title',$list, PDO::PARAM_STR);
    //$queryhist-> bindParam(':history_type', $history_type, PDO::PARAM_STR);
    //$queryhist->execute();

	$sql="insert into our_services (sender, icon, title, description, link) values (:user,:icon,:title,:description,:link)";

	$query = $dbh->prepare($sql);
	$query-> bindParam(':user', $sender, PDO::PARAM_STR);
	$query-> bindParam(':icon', $icon, PDO::PARAM_STR);
	$query-> bindParam(':title', $title, PDO::PARAM_STR);
	$query-> bindParam(':description', $description, PDO::PARAM_STR);
	$query-> bindParam(':link', $link, PDO::PARAM_STR);
    $query->execute();

	echo "<script type='text/javascript'>alert('Added successfully');</script>";
	echo "<script type='text/javascript'> document.location = 'services-page.php'; </script>";
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
	
	<title>ADD NEW SERVICES</title>

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
  <script src="https://cdn.tiny.cloud/1/bv5a14g71ngqfnetpdy42q9a139li5dutndzg3fdpth22wx5/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'textarea2', height : "320"});</script>

<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

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
                            <h2>+ ADD SEVICES</h2>
								<div class="panel panel-default">
									<div class="panel-heading">+ ADD SEVICES</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
										<form method="post" class="form-horizontal" enctype="multipart/form-data">

										<div class="form-group">
											<div class="col-sm-9 col-sm-offset-2">
												<center>
												<img id="blah3" src="#" alt=" Please Choose your image (90x90px)" /><br>
												</center>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Icon (90x90px)<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="file" name="icon" class="form-control" id="icon" onchange="readURL(this);" required>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Title<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="title" placeholder="Do not use more than 100 words" class="form-control" required>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Description<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<textarea2 id="description" name="description" class="form-control" placeholder="Do not use more than 1000 words" cols="30" rows="10"></textarea2>
											</div>
										</div>
										<script>var myContent = tinymce.get("description").getContent();</script>

										<div class="form-group">
											<label class="col-sm-2 control-label">Set Link<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="link" placeholder="set link" class="form-control" required>
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
												<a href="services-page.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back Here</button></a>

												<a href="add-services.php"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

												<a href="../service.php#service_area" target="_blank"><button class="btn btn-danger"><i class="fa fa-eye"></i>Preview </button></a>
											</div>
										</center>
										<script>
										function postFile2() {
										    var formdata = new FormData();

										    formdata.append('icon', $('#icon')[0].files[0]);

										    var request = new XMLHttpRequest();

										    request.upload.addEventListener('progress', function (e) {
										        var file1Size = $('#icon')[0].files[0].size;

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

	<script>      function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah3')
                        .attr('src', e.target.result)
                        .width(100)
                };

                reader.readAsDataURL(input.files[0]);
                $("div2").hide();
            }
        }
    </script>

</body>
</html>
<?php } ?>