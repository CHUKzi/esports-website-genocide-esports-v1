<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_POST['submit2']))
  {

	$file1 = $_FILES['icon1']['name'];
	$file_loc1 = $_FILES['icon1']['tmp_name'];
	$folder1="../images/gallery/";
	$new_file_name1 = strtolower($file1);
	$final_file1=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name1);

	$file2 = $_FILES['icon2']['name'];
	$file_loc2 = $_FILES['icon2']['tmp_name'];
	$folder2="../images/gallery/";
	$new_file_name2 = strtolower($file2);
	$final_file2=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name2);

	$file3 = $_FILES['icon3']['name'];
	$file_loc3 = $_FILES['icon3']['tmp_name'];
	$folder3="../images/gallery/";
	$new_file_name3 = strtolower($file3);
	$final_file3=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name3);	
	$icon1=$_POST['icon1'];
	$title=$_POST['title'];

	$link=$_POST['link'];
	$icon2=$_POST['icon2'];
	$title2=$_POST['title2'];

	$link2=$_POST['link2'];
	$icon3=$_POST['icon3'];
	$title3=$_POST['title3'];

	$link3=$_POST['link3'];
	$if_hide=$_POST['if_hide'];
	$idedit='1';

	if(move_uploaded_file($file_loc1,$folder1.$final_file1))
		{
			$icon1=$final_file1;
		}
	if(move_uploaded_file($file_loc2,$folder2.$final_file2))
		{
			$icon2=$final_file2;
		}
	if(move_uploaded_file($file_loc3,$folder3.$final_file3))
		{
			$icon3=$final_file3;
		}

	$sql="UPDATE home_page_box SET icon1=(:icon1), title=(:title), link=(:link), icon2=(:icon2), title2=(:title2), link2=(:link2), icon3=(:icon3), title3=(:title3), link3=(:link3), if_hide=(:if_hide) WHERE id=(:idedit)";

	$query = $dbh->prepare($sql);
	$query-> bindParam(':icon1', $icon1, PDO::PARAM_STR);
	$query-> bindParam(':title', $title, PDO::PARAM_STR);

	$query-> bindParam(':link', $link, PDO::PARAM_STR);
	$query-> bindParam(':icon2', $icon2, PDO::PARAM_STR);
	$query-> bindParam(':title2', $title2, PDO::PARAM_STR);

	$query-> bindParam(':link2', $link2, PDO::PARAM_STR);
	$query-> bindParam(':icon3', $icon3, PDO::PARAM_STR);
	$query-> bindParam(':title3', $title3, PDO::PARAM_STR);

	$query-> bindParam(':link3', $link3, PDO::PARAM_STR);
	$query-> bindParam(':if_hide', $if_hide, PDO::PARAM_STR);
	$query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
    $query->execute();
	$msg="Edited Successfully";
}

if(isset($_POST['submit3']))
  {

	$file = $_FILES['back_img']['name'];
	$file_loc = $_FILES['back_img']['tmp_name'];
	$folder="../images/gallery/";
	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name);
	
	$back_img=$_POST['back_img'];
	$head_title=$_POST['head_title'];
	$title=$_POST['title'];
	$subtitle=$_POST['subtitle'];
	$introduction=$_POST['introduction'];
	$if_hide=$_POST['if_hide'];
	$idedit='1';

	if(move_uploaded_file($file_loc,$folder.$final_file))
		{
			$back_img=$final_file;
		}

	$sql="UPDATE video_progress SET back_img=(:back_img), head_title=(:head_title), title=(:title), subtitle=(:subtitle), introduction=(:introduction), if_hide=(:if_hide) WHERE id=(:idedit)";

	$query = $dbh->prepare($sql);
	$query-> bindParam(':back_img', $back_img, PDO::PARAM_STR);
	$query-> bindParam(':head_title', $head_title, PDO::PARAM_STR);
	$query-> bindParam(':title', $title, PDO::PARAM_STR);
	$query-> bindParam(':subtitle', $subtitle, PDO::PARAM_STR);
	$query-> bindParam(':introduction', $introduction, PDO::PARAM_STR);
	$query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
	$query-> bindParam(':if_hide', $if_hide, PDO::PARAM_STR);
    $query->execute();
	$msg="Work Progress Area Edited Successfully";
} 

if(isset($_POST['submit4']))
  {

	$file = $_FILES['right_img']['name'];
	$file_loc = $_FILES['right_img']['tmp_name'];
	$folder="../images/background/";
	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name);
	
	$right_img=$_POST['right_img'];
	$title=$_POST['title'];
	$subtitle=$_POST['subtitle'];
	$link=$_POST['link'];
	$story=$_POST['story'];
	$history=$_POST['history'];
	$today=$_POST['today'];
	$if_hide=$_POST['if_hide'];
	$idedit='1';

	if(move_uploaded_file($file_loc,$folder.$final_file))
		{
			$right_img=$final_file;
		}

	$sql="UPDATE our_story SET right_img=(:right_img), title=(:title), subtitle=(:subtitle), link=(:link), story=(:story), history=(:history), today=(:today), if_hide=(:if_hide) WHERE id=(:idedit)";

	$query = $dbh->prepare($sql);
	$query-> bindParam(':right_img', $right_img, PDO::PARAM_STR);
	$query-> bindParam(':title', $title, PDO::PARAM_STR);
	$query-> bindParam(':subtitle', $subtitle, PDO::PARAM_STR);
	$query-> bindParam(':link', $link, PDO::PARAM_STR);
	$query-> bindParam(':story', $story, PDO::PARAM_STR);
	$query-> bindParam(':history', $history, PDO::PARAM_STR);
	$query-> bindParam(':today', $today, PDO::PARAM_STR);
	$query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
	$query-> bindParam(':if_hide', $if_hide, PDO::PARAM_STR);
    $query->execute();
	$msg="Work Progress Area Edited Successfully";
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
	
	<title>MANAGE WEB PAGES - HOME PAGE</title>

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
  top: 35%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 170%;
}

.centered2 {
  position: absolute;
  top: 55%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 120%;
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

<?php
		$sql = "SELECT * from home_page_head where id = 1";
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
									<div class="panel-heading">HOME PAGE</div>
										<div id="myModal" class="modal">
										  <div class="modal-content">
										    <span class="close">&times;</span>
										    <p>Alex Lanka Developers</p>
										    <iframe src="../" height="500" width="1000" title="Iframe Example"></iframe>
										  </div>
										</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									
									<style>
									.boxes {
									  width: 400px;
									  padding: 12px;
									  border: 3px solid gray;
									  margin: 0;
									  display: inline-block;
									}
									</style>
									<div class="panel-body">
										<?php
											$sql = "SELECT * from home_page_box where id = 1";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$result2=$query->fetch(PDO::FETCH_OBJ);
											$cnt=1;	
										?>
										<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">
										<center>
											<div class="boxes">
												<div class="form-group">
													<div class="col-sm-8 col-sm-offset-2">
														<img id="blah2" src="#" alt=" Please Choose your new image (59x69px)" />
													<div2><img src="../images/gallery/<?php echo htmlentities($result2->icon1);?>" width="205px"/></div2>
														<input type="hidden" name="icon1" value="<?php echo htmlentities($result2->icon1);?>" >
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">img<span style="color:red">*</span></label>
													<div class="col-sm-9">
													<input type="file" name="icon1" id="icons" class="form-control" onchange="readURL2(this);">
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">title<span style="color:red">*</span></label>
													<div class="col-sm-9">
													<input type="text" name="title" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result2->title);?>">
													</div>
													</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">link<span style="color:red">*</span></label>
													<div class="col-sm-9">
													<input type="text" name="link" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result2->link);?>">
													</div>
													</div>
											</div>
											<div class="boxes">
												<div class="form-group">
													<div class="col-sm-8 col-sm-offset-2">
														<img id="blah3" src="#" alt=" Please Choose your new image (59x69px)" />
														<div3><img src="../images/gallery/<?php echo htmlentities($result2->icon2);?>" width="205px"/></div3>
														<input type="hidden" name="icon2" value="<?php echo htmlentities($result2->icon2);?>" >
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">img<span style="color:red">*</span></label>
													<div class="col-sm-9">
													<input type="file" name="icon2" id="icons" class="form-control" onchange="readURL3(this);">
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">title<span style="color:red">*</span></label>
													<div class="col-sm-9">
													<input type="text" name="title2" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result2->title2);?>">
													</div>
													</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">link<span style="color:red">*</span></label>
													<div class="col-sm-9">
													<input type="text" name="link2" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result2->link2);?>">
													</div>
													</div>
											</div>
											<div class="boxes">
												<div class="form-group">
													<div class="col-sm-8 col-sm-offset-2">
														<img id="blah4" src="#" alt=" Please Choose your new image (59x69px)" />
														<div4><img src="../images/gallery/<?php echo htmlentities($result2->icon3);?>" width="205px"/></div4>
														<input type="hidden" name="icon3" value="<?php echo htmlentities($result2->icon3);?>" >
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">img<span style="color:red">*</span></label>
													<div class="col-sm-9">
													<input type="file" name="icon3" id="icons" class="form-control" onchange="readURL4(this);">
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">title<span style="color:red">*</span></label>
													<div class="col-sm-9">
													<input type="text" name="title3" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result2->title3);?>">
													</div>
													</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">link<span style="color:red">*</span></label>
													<div class="col-sm-9">
													<input type="text" name="link3" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result2->link3);?>">
													</div>
													</div>
											</div>
										</center>

										<div class="form-group"><br>
										<label class="col-sm-2 control-label">Area Hide OR Unhide<span style="color:red">*</span></label>
										<div class="col-sm-8">
										<select name="if_hide" class="form-control" required>
										                            <option value="<?php echo htmlentities($result2->if_hide);?>">selected <?php if($result2->if_hide == 1){?>Do not hide This Area<?php } else {?>Hide This Area<?php } ?></option>
										                            <option value="1">Do not hide This Area</option>
										                            <option value="0">Hide This Area</option>
										                            </select>
										</div>
										</div>
											<input type="hidden" name="idedit" value="<?php echo htmlentities($result2->id);?>" >
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-primary" name="submit2" type="submit"  onclick="postFile2()">Save Changes</button>
												</div>
											</div>
										</form>
										<div id="progress-bar-file2" class="progress"></div>
										<center>
											<div class="col-sm-12 col-sm-offset-0">
												<a href="dashboard.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back to Home</button></a>

												<a href="home-page.php"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

												<button class="btn btn-danger" id="myBtn"><i class="fa fa-eye"></i> Preview </button>

												<!--<button class="btn btn-danger" id="myBtn"><i class="fa fa-eye"></i> Preview </button>-->
											</div>
										</center><br><br><br>
										<script>
										function postFile2() {
										    var formdata = new FormData();

										    formdata.append('icons', $('#icons')[0].files[0]);

										    var request = new XMLHttpRequest();

										    request.upload.addEventListener('progress', function (e) {
										        var file1Size = $('#icons')[0].files[0].size;

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

									<?php
											$sql = "SELECT * from video_progress where id = 1";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$result3=$query->fetch(PDO::FETCH_OBJ);
											$cnt=1;	
									?>
									<div class="panel-body" style="background-color:powderblue;">
										<h2><u><b>CLAN SPECIAL VIDEOS</b></u></h2>
										<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">

										<div class="form-group">
											<div class="col-sm-9 col-sm-offset-2">
												<center>
													<img id="blah5" src="#" alt=" Please Choose your new image (1920x908px)" />
													<div5><img src="../images/gallery/<?php echo htmlentities($result3->back_img);?>" width="750px"/></div5>
												</center>
												<input type="hidden" name="back_img" value="<?php echo htmlentities($result3->back_img);?>" >
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">background image (1920x908px)<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="file" name="back_img" id="back_img_work" class="form-control" onchange="readURL5(this);">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">HEAD Title<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="head_title" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result3->head_title);?>">
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
											<label class="col-sm-2 control-label">Video URL<span style="color:red">*</span></label>
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
										<div id="progress-bar-file3" class="progress"></div>
										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2">
												<button class="btn btn-primary" name="submit3" type="submit" onclick="postFile3()">Save Changes</button>
											</div>
										</div>

									</form>
										<center>
											<div class="col-sm-12 col-sm-offset-0">
												<a href="dashboard.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back to Home</button></a>

												<a href="home-page.php"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

												<a href="../index.php#main_boxes_3" target="_blank"><button class="btn btn-danger"><i class="fa fa-eye"></i>Preview </button></a>

												<!--<button class="btn btn-danger" id="myBtn"><i class="fa fa-eye"></i> Preview </button>-->
											</div>
										</center><br><br><br>
									</div>
										<script>
										function postFile3() {
										    var formdata = new FormData();

										    formdata.append('back_img_work', $('#back_img_work')[0].files[0]);

										    var request = new XMLHttpRequest();

										    request.upload.addEventListener('progress', function (e) {
										        var file1Size = $('#back_img_work')[0].files[0].size;

										        if (e.loaded <= file1Size) {
										            var percent = Math.round(e.loaded / file1Size * 100);
										            $('#progress-bar-file3').width(percent + '%').html(percent + '%');
										        } 

										        if(e.loaded == e.total){
										            $('#progress-bar-file3').width(100 + '%').html(100 + '%');
										        }
										    });   

										    request.open('post', '/echo/html/');
										    request.timeout = 45000;
										    request.send(formdata);
										}
										</script>

									<?php
											$sql = "SELECT * from our_story where id = 1";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$result4=$query->fetch(PDO::FETCH_OBJ);
											$cnt=1;	
									?>
									<div class="panel-body">
										<h2 style="color: green; background-color: #ffff42"><center><u><b>Our Story Area</b></u></center></h2>
										<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">

										<div class="form-group">
											<div class="col-sm-9 col-sm-offset-2">
												<img id="blah6" src="#" alt=" Please Choose your new image (540x620px)" /><br>
												<div6><img src="../images/background/<?php echo htmlentities($result4->right_img);?>" width="350px"/></div6>
												<input type="hidden" name="right_img" value="<?php echo htmlentities($result4->right_img);?>" >
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">image (540x620px)<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="file" name="right_img" id="right_img_story" class="form-control" onchange="readURL6(this);">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Title<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="title" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result4->title);?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Button Name<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="subtitle" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result4->subtitle);?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Set Link<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="link" placeholder="Post link (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result4->link);?>">
											</div>
										</div>

										<div id="progress-bar-file4" class="progress"></div>
										<input type="hidden" name="idedit" value="<?php echo htmlentities($result4->id);?>" >
										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2">
												<button class="btn btn-primary" name="submit4" type="submit" onclick="postFile4()">Save Changes</button>
											</div>
										</div>
										<!--=============================================================================-->

										<center><h4 style="color: green; background-color: #ffff42;">Our Story</h4></center>
										<div class="form-group">
											<label class="col-sm-2 control-label">Our Story<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<textarea id="story" name="story" class="form-control" placeholder="Do not use more than 1000 words" cols="30" rows="10"><?php echo nl2br($result4->story);?></textarea>
											</div>
										</div>
										<script>var myContent = tinymce.get("story").getContent();</script>

										<!--=============================================================================-->

										<center><h4 style="color: green; background-color: #ffff42;">Our History</h4></center>
										<div class="form-group">
											<label class="col-sm-2 control-label">Our History<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<textarea id="history" name="history" class="form-control" placeholder="Do not use more than 1000 words" cols="30" rows="10"><?php echo nl2br($result4->history);?></textarea>
											</div>
										</div>
										<script>var myContent = tinymce.get("history").getContent();</script>

										<!--=============================================================================-->

										<center><h4 style="color: green; background-color: #ffff42;">Today</h4></center>
										<div class="form-group">
											<label class="col-sm-2 control-label">Today<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<textarea id="today" name="today" class="form-control" placeholder="Do not use more than 1000 words" cols="30" rows="10"><?php echo nl2br($result4->today);?></textarea>
											</div>
										</div>
										<script>var myContent = tinymce.get("today").getContent();</script>

										<!--======================================== end =================================-->

										<div class="form-group">
										<label class="col-sm-2 control-label">Area Hide OR Unhide<span style="color:red">*</span></label>
										<div class="col-sm-9">
										<select name="if_hide" class="form-control" required>
										                            <option value="<?php echo htmlentities($result4->if_hide);?>">selected <?php if($result4->if_hide == 1){?>Do not hide This Area<?php } else {?>Hide This Area<?php } ?></option>
										                            <option value="1">Do not hide This Area</option>
										                            <option value="0">Hide This Area</option>
										                            </select>
										</div>
										</div>

										<input type="hidden" name="idedit" value="<?php echo htmlentities($result4->id);?>" >
										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2">
												<button class="btn btn-primary" name="submit4" type="submit" onclick="postFile4()">Save Changes</button>
											</div>
										</div>
										<div id="progress-bar-file4" class="progress"></div>
									</form>
										<center>
											<div class="col-sm-12 col-sm-offset-0">
												<a href="dashboard.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back to Home</button></a>

												<a href="home-page.php"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

												<a href="../index.php#history_area" target="_blank"><button class="btn btn-danger"><i class="fa fa-eye"></i> Preview </button></a>

												<!--<button class="btn btn-danger" id="myBtn"><i class="fa fa-eye"></i> Preview </button>-->
											</div>
										</center>
										<script>
										function postFile4() {
										    var formdata = new FormData();

										    formdata.append('right_img_story', $('#right_img_story')[0].files[0]);

										    var request = new XMLHttpRequest();

										    request.upload.addEventListener('progress', function (e) {
										        var file1Size = $('#right_img_story')[0].files[0].size;

										        if (e.loaded <= file1Size) {
										            var percent = Math.round(e.loaded / file1Size * 100);
										            $('#progress-bar-file4').width(percent + '%').html(percent + '%');
										        } 

										        if(e.loaded == e.total){
										            $('#progress-bar-file4').width(100 + '%').html(100 + '%');
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
<!--======================+image+========================-->
	<script>
		function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(740)
                };

                reader.readAsDataURL(input.files[0]);
                $("div1").hide();
            }
        }
    </script>
<!--======================+icon1+========================-->
	<script>
		function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah2')
                        .attr('src', e.target.result)
                        .width(180)
                };

                reader.readAsDataURL(input.files[0]);
                $("div2").hide();
            }
        }
    </script>
<!--======================+icon2+========================-->
	<script>
		function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah3')
                        .attr('src', e.target.result)
                        .width(180)
                };

                reader.readAsDataURL(input.files[0]);
                $("div3").hide();
            }
        }
    </script>
<!--======================+icon3+========================-->
	<script>
		function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah4')
                        .attr('src', e.target.result)
                        .width(180)
                };

                reader.readAsDataURL(input.files[0]);
                $("div4").hide();
            }
        }
    </script>
<!--======================+image+========================-->
	<script>
		function readURL5(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah5')
                        .attr('src', e.target.result)
                        .width(750)
                };

                reader.readAsDataURL(input.files[0]);
                $("div5").hide();
            }
        }
    </script>
<!--======================+image+========================-->
	<script>
		function readURL6(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah6')
                        .attr('src', e.target.result)
                        .width(350)
                };

                reader.readAsDataURL(input.files[0]);
                $("div6").hide();
            }
        }
    </script>
</body>
</html>
<?php } ?>