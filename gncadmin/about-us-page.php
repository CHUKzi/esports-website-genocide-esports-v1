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

	$file = $_FILES['back_img']['name'];
	$file_loc = $_FILES['back_img']['tmp_name'];
	$folder="../images/background/";
	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name);
	
	$back_img=$_POST['back_img'];
	$title=$_POST['title'];
	$idedit='1';

	if(move_uploaded_file($file_loc,$folder.$final_file))
		{
			$back_img=$final_file;
		}

	$sql="UPDATE about_us_page_head SET back_img=(:back_img), title=(:title) WHERE id=(:idedit)";

	$query = $dbh->prepare($sql);
	$query-> bindParam(':back_img', $back_img, PDO::PARAM_STR);
	$query-> bindParam(':title', $title, PDO::PARAM_STR);
	$query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
    $query->execute();
	$msg="Edited Successfully";
}

if(isset($_POST['submit3']))
  {

	$file = $_FILES['back_img']['name'];
	$file_loc = $_FILES['back_img']['tmp_name'];
	$folder="../images/resource/";
	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name);
	
	$back_img=$_POST['back_img'];
	$title=$_POST['title'];
	$subtitle=$_POST['subtitle'];
	$introduction=$_POST['introduction'];
	$if_hide=$_POST['if_hide'];
	$idedit='1';

	if(move_uploaded_file($file_loc,$folder.$final_file))
		{
			$back_img=$final_file;
		}

	$sql="UPDATE about_us SET back_img=(:back_img), title=(:title), subtitle=(:subtitle), introduction=(:introduction), if_hide=(:if_hide) WHERE id=(:idedit)";

	$query = $dbh->prepare($sql);
	$query-> bindParam(':back_img', $back_img, PDO::PARAM_STR);
	$query-> bindParam(':title', $title, PDO::PARAM_STR);
	$query-> bindParam(':subtitle', $subtitle, PDO::PARAM_STR);
	$query-> bindParam(':introduction', $introduction, PDO::PARAM_STR);
	$query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
	$query-> bindParam(':if_hide', $if_hide, PDO::PARAM_STR);
    $query->execute();
	$msg="Edited Successfully";
} 

if(isset($_GET['del']))
{
$id=$_GET['del'];

$sql = "delete from our_team WHERE id=:id";
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
	
	<title>MANAGE WEB PAGES - ABOUT US PAGE</title>

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
<style>
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px;
  padding-left: 200px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}
/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

<?php
		$sql = "SELECT * from about_us_page_head where id = 1";
		$query = $dbh -> prepare($sql);
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
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">ABOUT US PAGE</div>
										<div id="myModal" class="modal">
										  <div class="modal-content">
										    <span class="close">&times;</span>
										    <p>Alex Lanka Developers</p>
										    <iframe src="../about-us.php" height="500" width="1000" title="Iframe Example"></iframe>
										  </div>
										</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body" style="background-color:powderblue;">
										<h2><center><u><b>Banner</b></u></center></h2>
										<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">
											<div class="container">
										<img id="blah" src="#" alt=" Please Choose your new image (1920x514px)" /><br>
										  <div2>
										  <img src="../images/background/<?php echo htmlentities($result->back_img);?>" alt="Snow" style="width:70%;">
										  </div2>
										  <div class="centered"><?php echo htmlentities($result->title);?></div>
										</div>
										<div class="form-group">
											<div class="col-sm-9 col-sm-offset-2">
												<input type="hidden" name="back_img" value="<?php echo htmlentities($result->back_img);?>" >
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">background image (1920x514px)<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="file" name="back_img" class="form-control" onchange="readURL(this);" id="back_img">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Title<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="title" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result->title);?>">
											</div>
										</div>
										<input type="hidden" name="idedit" value="<?php echo htmlentities($result->id);?>" >
										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2">
												<button class="btn btn-primary" name="submit" type="submit" onclick="postFile()">Save Changes</button>
											</div>
										</div>
									</form>
									<div id="progress-bar-file1" class="progress"></div>
										<script>
										function postFile() {
										    var formdata = new FormData();

										    formdata.append('back_img', $('#back_img')[0].files[0]);

										    var request = new XMLHttpRequest();

										    request.upload.addEventListener('progress', function (e) {
										        var file1Size = $('#back_img')[0].files[0].size;

										        if (e.loaded <= file1Size) {
										            var percent = Math.round(e.loaded / file1Size * 100);
										            $('#progress-bar-file1').width(percent + '%').html(percent + '%');
										        } 

										        if(e.loaded == e.total){
										            $('#progress-bar-file1').width(100 + '%').html(100 + '%');
										        }
										    });   

										    request.open('post', '/echo/html/');
										    request.timeout = 45000;
										    request.send(formdata);
										}
										</script>
										<center>
											<div class="col-sm-12 col-sm-offset-0">
												<a href="dashboard.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back to Home</button></a>

												<a href="about-us-page.php"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

												<button class="btn btn-danger" id="myBtn"><i class="fa fa-eye"></i> Preview </button>

												<!--<button class="btn btn-danger" id="myBtn"><i class="fa fa-eye"></i> Preview </button>-->
											</div>
										</center><br><br><br>
										<hr>
									</div>
									<?php
											$sql = "SELECT * from about_us where id = 1";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$result3=$query->fetch(PDO::FETCH_OBJ);
											$cnt=1;	
									?>
									<div class="panel-body" style="background-color:powderblue;">
										<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">

										<div class="form-group">
											<div class="col-sm-9 col-sm-offset-2">
												<center>
													<h2><center><u><b>About-us</b></u></center></h2>
												<img id="blah3" src="#" alt=" Please Choose your new image (703x768px)" /><br>
												  <div3>
												  <img src="../images/resource/<?php echo htmlentities($result3->back_img);?>" width="370px"/>
												  </div3>
												</center>
												<input type="hidden" name="back_img" value="<?php echo htmlentities($result3->back_img);?>" >
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">background image (540x540px)<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="file" name="back_img" class="form-control" id="aboutimg" onchange="readURL3(this);">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Title<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="title" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result3->title);?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">subtitle<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="subtitle" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result3->subtitle);?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Introduction<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<textarea id="introduction" name="introduction" class="form-control" placeholder="Do not use more than 1000 words" cols="30" rows="10"><?php echo nl2br($result3->introduction);?></textarea>
											</div>
										</div>

										<div class="form-group">
										<label class="col-sm-2 control-label">Area Hide OR Unhide<span style="color:red">*</span></label>
										<div class="col-sm-9">
										<select name="if_hide" class="form-control" required>
										                            <option value="<?php echo htmlentities($result3->if_hide);?>">selected <?php if($result3->if_hide == 1){?>Do not hide This Area<?php } else {?>Hide This Area<?php } ?></option>
										                            <option value="1">Do not hide This Area</option>
										                            <option value="0">Hide This Area</option>
										                            </select>
										</div>
										</div>

										<script>var myContent = tinymce.get("introduction").getContent();</script>

										<input type="hidden" name="idedit" value="<?php echo htmlentities($result3->id);?>" >
										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2">
												<button class="btn btn-primary" name="submit3" type="submit" onclick="postFile2()">Save Changes</button>
											</div>
										</div>
									</form>
									<div id="progress-bar-file2" class="progress"></div>
										<script>
										function postFile2() {
										    var formdata = new FormData();

										    formdata.append('aboutimg', $('#aboutimg')[0].files[0]);

										    var request = new XMLHttpRequest();

										    request.upload.addEventListener('progress', function (e) {
										        var file1Size = $('#aboutimg')[0].files[0].size;

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
										<center>
											<div class="col-sm-12 col-sm-offset-0">
												<a href="dashboard.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back to Home</button></a>

												<a href="about-us-page.php"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

												<!--<a href="../" target="_blank"><button class="btn btn-danger"><i class="fa fa-eye"></i>Preview </button></a>-->
												<a href="../about-us.php" target="_blank"><button class="btn btn-danger"><i class="fa fa-eye"></i>Preview </button></a>
											</div>
										</center><br><br><br>
									<hr>
									</div>

								<div class="panel-body" style="background-color:powderblue;">
									<h2><center><u><b>+ Add Team</b></u></center></h2>
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
									  height: 300px;
									  padding: 12px;
									  border: 6px solid gray;
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
						            <?php $sql = "SELECT * from our_team ";
						            $query = $dbh -> prepare($sql);
						            $query->execute();
						            $results=$query->fetchAll(PDO::FETCH_OBJ);
						            $cnt=1;
						            if($query->rowCount() > 0)
						            {
						            foreach($results as $result4)
						                {               ?>
						            <?php $no=''; ?>
									<div class="boxes">
										<center><img src="../images/resource/<?php echo htmlentities($result4->avatar);?>" width="220px"/>
										<h4><?php echo htmlentities($result4->name);?></h4>
										<h4><?php echo htmlentities($result4->designation);?></h4>
										<a href="<?php echo htmlentities($result4->fb);?>" target="_blank"><i class="fa fa-facebook-square" style="font-size:20px;color:blue;"></i></a>
										<a href="<?php echo htmlentities($result4->twitter);?>" target="_blank"><i class="fa fa-twitter" style="font-size:20px;color:blue;"></i></a>
										<a href="<?php echo htmlentities($result4->instagram);?>" target="_blank"><i class="fa fa-instagram" style="font-size:20px;color:blue;"></i></a>
									</center><hr>
										<a href="edit-team.php?edit=<?php echo $result4->id;?>" onclick="return confirm('Do you want to Edit <?php echo htmlentities($result4->name);?>');">&nbsp; <i class="fa fa-pencil" style="font-size:25px;color:green;"></i></a>&nbsp;&nbsp;
										<a href="about-us-page.php?del=<?php echo $result4->id;?>" onclick="return confirm('Do you want to Delete <?php echo htmlentities($result4->name);?> from team');"><i class="fa fa-trash" style="font-size:25px;color:red;"></i></a>
									</div>
									<?php $cnt=$cnt+1; }} else { $no='No result found';}?>&nbsp;&nbsp;

									<div class="boxe">
										<div class="boxcenter">
											<a href="add-team.php"><button class="btn btn-warning">+ Add New Member</button></a>
											<p><?php echo $no;?></p>
										</div>
									</div><br><br>
										<center>
											<div class="col-sm-12 col-sm-offset-0">
												<a href="dashboard.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back to Home</button></a>

												<a href="about-us-page.php"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

												<!--<a href="../" target="_blank"><button class="btn btn-danger"><i class="fa fa-eye"></i>Preview </button></a>-->
												<a href="../about-us.php#members_area" target="_blank"><button class="btn btn-danger"><i class="fa fa-eye"></i>Preview </button></a>
											</div>
										</center><br><br><br>
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
	// Get the modal
	var modal = document.getElementById("myModal");

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 
	btn.onclick = function() {
	  modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	  modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}
	</script>
	<script>      function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(810)
                        .height(224);
                };

                reader.readAsDataURL(input.files[0]);
                $("div2").hide();
            }
        }
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