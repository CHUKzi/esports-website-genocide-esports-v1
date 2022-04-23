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

  	$title=$_POST['title'];
  	$link=$_POST['link'];

	$file = $_FILES['image']['name'];
	$file_loc = $_FILES['image']['tmp_name'];
	$folder="../images/main-slider/";
	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name);

	$image=$_POST['image'];
	$idedit=$_POST['idedit'];

	if(move_uploaded_file($file_loc,$folder.$final_file))
		{
			$image=$final_file;
		}
    //$sqlhist="insert history (user,history_type,title) values (:user,:history_type,:title)";

    //$queryhist = $dbh->prepare($sqlhist);
	//$queryhist-> bindParam(':user', $sender, PDO::PARAM_STR);
	//$queryhist-> bindParam(':title',$list, PDO::PARAM_STR);
    //$queryhist-> bindParam(':history_type', $history_type, PDO::PARAM_STR);
    //$queryhist->execute();

	$sql="UPDATE banners SET image=(:image), title=(:title), link=(:link) WHERE id=(:idedit)";

	$query = $dbh->prepare($sql);
	$query-> bindParam(':image', $image, PDO::PARAM_STR);
	$query-> bindParam(':link', $link, PDO::PARAM_STR);
	$query-> bindParam(':title', $title, PDO::PARAM_STR);

	$query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
    $query->execute();

	echo "<script type='text/javascript'>alert('Added successfully');</script>";
	echo "<script type='text/javascript'> document.location = 'manage-banner.php'; </script>";
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
	
	<title>EDIT PROJECT</title>

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

<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

</head>

<?php
		$sql = "SELECT * from banners where id = :editid";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':editid',$editid,PDO::PARAM_INT);
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
								<div class="panel panel-default">
									<div class="panel-heading">Posted date: <i><?php echo htmlentities($result->time);?></i></div>
										<div id="myModal" class="modal">
										  <div class="modal-content">
										    <span class="close">&times;</span>
										    <p>Alex Lanka Developers</p>
										    <iframe src="../our-works.php" height="500" width="1000" title="Iframe Example"></iframe>
										  </div>
										</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
										<form method="post" class="form-horizontal" enctype="multipart/form-data">

										<center>
												<img id="blah" src="#" alt=" Please Choose your new image" /><br>
												<div2><img src="../images/main-slider/<?php echo htmlentities($result->image);?>" width="540px"/></div2>
										</center>
										<br>
										<div class="form-group">
											<label class="col-sm-2 control-label">Thumbnail<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="hidden" name="image" value="<?php echo htmlentities($result->image);?>" >
											<input type="hidden" name="idedit" value="<?php echo htmlentities($result->id);?>" >
											<input type="file" name="image" class="form-control" id="img" onchange="readURL(this);" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Title<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="title" placeholder="Do not use more than 100 words" value="<?php echo htmlentities($result->title);?>" class="form-control" required>
											</div>
										</div>


										<div class="form-group">
											<label class="col-sm-2 control-label">Link<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="link" placeholder="Do not use more than 100 words" value="<?php echo htmlentities($result->link);?>" class="form-control" required>
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2">
												<input type="hidden" name="idedit" value="<?php echo htmlentities($result->id);?>" >
												<button class="btn btn-primary" name="submit" type="submit" onclick="postFile2()"><i class="fa fa-camera"></i> Save Now</button>
											</div>
										</div>
										</form>
										<div id="progress-bar-file2" class="progress"></div>
										<script>
										function postFile2() {
										    var formdata = new FormData();

										    formdata.append('img', $('#img')[0].files[0]);

										    var request = new XMLHttpRequest();

										    request.upload.addEventListener('progress', function (e) {
										        var file1Size = $('#img')[0].files[0].size;

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
												<a href="work-manage.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back Here</button></a>

												<a href="work-manage.php?del=<?php echo $result->id;?>" onclick="return confirm('Are you sure want to Delete this post?');"><button class="btn btn-danger"><i class="fa fa-trash"></i> DELETE BOLOG </button></a>

												<a href="edit-project.php?edit=<?php echo htmlentities($result->id);?>"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

												<button class="btn btn-warning" id="myBtn"><i class="fa fa-eye"></i> Preview </button>
											</div>
										</center>

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
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(482)
                };

                reader.readAsDataURL(input.files[0]);
                $("div2").hide();
            }
        }
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
</body>
</html>
<?php } ?>