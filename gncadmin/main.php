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
	$folder="../images/";
	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name);

	$file1 = $_FILES['logo']['name'];
	$file_loc1 = $_FILES['logo']['tmp_name'];
	$folder1="../images/";
	$new_file_name1 = strtolower($file1);
	$final_file1=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name1);

	$file2 = $_FILES['logo_f']['name'];
	$file_loc2 = $_FILES['logo_f']['tmp_name'];
	$folder2="../images/";
	$new_file_name2 = strtolower($file2);
	$final_file2=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name2);

	$file3 = $_FILES['looder']['name'];
	$file_loc3 = $_FILES['looder']['tmp_name'];
	$folder3="../images/";
	$new_file_name3 = strtolower($file3);
	$final_file3=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name3);
	
	$domain=$_POST['domain'];
	$icon=$_POST['icon'];
	$logo=$_POST['logo'];
	$logo_f=$_POST['logo_f'];
	$looder=$_POST['looder'];
	$title=$_POST['title'];
	$script=$_POST['script'];
	$script_f=$_POST['script_f'];
	$email=$_POST['email'];
	$email_2=$_POST['email_2'];
	$send_me=$_POST['send_me'];
	$number1=$_POST['number1'];
	$number2=$_POST['number2'];
	$instagram=$_POST['instagram'];
	$fb_page=$_POST['fb_page'];
	$yt_channel=$_POST['yt_channel'];
	$twitter=$_POST['twitter'];
	$contact_info=$_POST['contact_info'];
	$address=$_POST['address'];
	$about_us=$_POST['about_us'];
	$apple_app=$_POST['apple_app'];
	$android_app=$_POST['android_app'];
	$copywright=$_POST['copywright'];
	$idedit='1';

	if(move_uploaded_file($file_loc,$folder.$final_file))
		{
			$icon=$final_file;
		}
	if(move_uploaded_file($file_loc1,$folder1.$final_file1))
		{
			$logo=$final_file1;
		}
	if(move_uploaded_file($file_loc2,$folder2.$final_file2))
		{
			$logo_f=$final_file2;
		}
	if(move_uploaded_file($file_loc3,$folder3.$final_file3))
		{
			$looder=$final_file3;
		}

	$sql="UPDATE main SET domain=(:domain), icon=(:icon), logo=(:logo), logo_f=(:logo_f), looder=(:looder), title=(:title), script=(:script), script_f=(:script_f), email=(:email), email_2=(:email_2), send_me=(:send_me), number1=(:number1), number2=(:number2), instagram=(:instagram), fb_page=(:fb_page), yt_channel=(:yt_channel), twitter=(:twitter), contact_info=(:contact_info), address=(:address), about_us=(:about_us), apple_app=(:apple_app), android_app=(:android_app), copywright=(:copywright) WHERE id=(:idedit)";

	$query = $dbh->prepare($sql);
	$query-> bindParam(':domain', $domain, PDO::PARAM_STR);
	$query-> bindParam(':icon', $icon, PDO::PARAM_STR);
	$query-> bindParam(':logo', $logo, PDO::PARAM_STR);
	$query-> bindParam(':logo_f', $logo_f, PDO::PARAM_STR);
	$query-> bindParam(':looder', $looder, PDO::PARAM_STR);
	$query-> bindParam(':title', $title, PDO::PARAM_STR);
	$query-> bindParam(':script', $script, PDO::PARAM_STR);
	$query-> bindParam(':script_f', $script_f, PDO::PARAM_STR);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query-> bindParam(':email_2', $email_2, PDO::PARAM_STR);
	$query-> bindParam(':send_me', $send_me, PDO::PARAM_STR);
	$query-> bindParam(':number1', $number1, PDO::PARAM_STR);
	$query-> bindParam(':number2', $number2, PDO::PARAM_STR);
	$query-> bindParam(':instagram', $instagram, PDO::PARAM_STR);
	$query-> bindParam(':fb_page', $fb_page, PDO::PARAM_STR);
	$query-> bindParam(':yt_channel', $yt_channel, PDO::PARAM_STR);
	$query-> bindParam(':twitter', $twitter, PDO::PARAM_STR);
	$query-> bindParam(':contact_info', $contact_info, PDO::PARAM_STR);
	$query-> bindParam(':address', $address, PDO::PARAM_STR);
	$query-> bindParam(':about_us', $about_us, PDO::PARAM_STR);
	$query-> bindParam(':apple_app', $apple_app, PDO::PARAM_STR);
	$query-> bindParam(':android_app', $android_app, PDO::PARAM_STR);
	$query-> bindParam(':copywright', $copywright, PDO::PARAM_STR);
	$query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
    $query->execute();
	$msg="Edited Successfully";
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
	
	<title>MAIN</title>

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
<?php
		$sql = "SELECT * from main where id = 1";
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
									<div class="panel-heading">Last update : <?php echo htmlentities($result->date);?></div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body" style="background-color:powderblue;">
<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">

<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<center>
			<img id="blah1" src="#" alt=" Please Choose your new image (49x49px)" /><br>
			<div1><img src="../images/<?php echo htmlentities($result->icon);?>" width="70px"/></div1>
		</center>
		<input type="hidden" name="icon" value="<?php echo htmlentities($result->icon);?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">icon<span style="color:red">*</span></label>
	<div class="col-sm-9">
	<input type="file" name="icon" class="form-control" id="main_images" onchange="readURL1(this);">
	</div>
</div>
<hr>
<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<center>
			<img id="blah2" src="#" alt=" Please Choose your new image" /><br>
			<div2><img src="../images/<?php echo htmlentities($result->logo);?>" width="150px"/></div2>
		</center>		
		<input type="hidden" name="logo" value="<?php echo htmlentities($result->logo);?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Logo<span style="color:red">*</span></label>
	<div class="col-sm-9">
	<input type="file" name="logo" class="form-control" id="main_images" onchange="readURL2(this);">
	</div>
</div>
<hr>
<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<center>
			<img id="blah3" src="#" alt=" Please Choose your new image" /><br>
			<div3><img src="../images/<?php echo htmlentities($result->logo_f);?>" width="150px"/></div3>
		</center>
		<input type="hidden" name="logo_f" value="<?php echo htmlentities($result->logo_f);?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Logo footer<span style="color:red">*</span></label>
	<div class="col-sm-9">
	<input type="file" name="logo_f" class="form-control" id="main_images" onchange="readURL3(this);">
	</div>
</div>
<hr>
<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<center>
			<img id="blah4" src="#" alt=" Please Choose your new image" /><br>
			<div4><img src="../images/<?php echo htmlentities($result->looder);?>" width="170px"/></div4>
		</center>
		<input type="hidden" name="looder" value="<?php echo htmlentities($result->looder);?>" >
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">loader (GIF)<span style="color:red">*</span></label>
	<div class="col-sm-9">
	<input type="file" name="looder" class="form-control" id="main_images" onchange="readURL4(this);">
	</div>
</div>
<hr>
<div class="form-group">
	<label class="col-sm-2 control-label">title<span style="color:red">*</span></label>
	<div class="col-sm-9">
	<input type="text" name="title" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result->title);?>">
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">scripts (header)<span style="color:red">*</span></label>
	<div class="col-sm-9">
	<textarea name="script" class="form-control" placeholder="Do not use more than 5000 words" cols="30" rows="10"><?php echo htmlentities($result->script);?></textarea>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">scripts (footer)<span style="color:red">*</span></label>
	<div class="col-sm-9">
	<textarea name="script_f" class="form-control" placeholder="Do not use more than 5000 words" cols="30" rows="10"><?php echo htmlentities($result->script_f);?></textarea>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">e-mail<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="email" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result->email);?>">
	</div>

	<label class="col-sm-1 control-label">Mobile Number<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="number1" placeholder="Post Title (Do not use more than 60 words)" class="form-control" value="<?php echo htmlentities($result->number1);?>">
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">e-mail(2nd)<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="email_2" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result->email_2);?>">
	</div>

	<label class="col-sm-1 control-label">Mobile Number(2nd)<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="number2" placeholder="Post Title (Do not use more than 60 words)" class="form-control" value="<?php echo htmlentities($result->number2);?>">
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label"><i class="fa fa-instagram" style="color:blue"> instagram</i><span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="instagram" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result->instagram);?>">
	</div>

	<label class="col-sm-1 control-label"><i class="fa fa-facebook" style="color:blue"> facebook</i><span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="fb_page" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result->fb_page);?>">
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label"><i class="fa fa-youtube" style="color:blue"> Youtube</i><span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="yt_channel" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result->yt_channel);?>">
	</div>

	<label class="col-sm-1 control-label"><i class="fa fa-twitter" style="color:blue"> Twitter</i><span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="twitter" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result->twitter);?>">
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Contact info<span style="color:red">*</span></label>
	<div class="col-sm-9">
	<textarea name="contact_info" class="form-control" placeholder="Do not use more than 5000 words" cols="30" rows="10"><?php echo htmlentities($result->contact_info);?></textarea>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Address<span style="color:red">*</span></label>
	<div class="col-sm-9">
	<input type="text" name="address" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result->address);?>">
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">About Us<span style="color:red">*</span></label>
	<div class="col-sm-9">
	<textarea name="about_us" class="form-control" placeholder="Do not use more than 5000 words" cols="30" rows="10"><?php echo htmlentities($result->about_us);?></textarea>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Apple App<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="apple_app" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result->apple_app);?>">
	</div>

	<label class="col-sm-1 control-label">Android App<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="android_app" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result->android_app);?>">
	</div>
</div>
<div class="form-group">
	<label class="col-sm-2 control-label">Copyright<span style="color:red">*</span></label>
	<div class="col-sm-9">
	<input type="text" name="copywright" placeholder="Post Title (Do not use more than 100 words)" class="form-control" value="<?php echo htmlentities($result->copywright);?>">
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Domain<span style="color:red">*</span></label>
	<div class="col-sm-9">
	<input type="text" name="domain" placeholder="Post Title (Do not use more than 50 words)" class="form-control" value="<?php echo htmlentities($result->domain);?>">
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Send E-mails<span style="color:red">*</span></label>
	<div class="col-sm-9">
	<input type="text" name="send_me" placeholder="Post Title (Do not use more than 50 words)" class="form-control" value="<?php echo htmlentities($result->send_me);?>">
	</div>
</div>

<input type="hidden" name="idedit" value="<?php echo htmlentities($result->id);?>" >
<div class="form-group">
	<div class="col-sm-8 col-sm-offset-6">
		<button class="btn btn-primary" name="submit" type="submit" onclick="postFile2()">Save Changes</button>
	</div>
</div>

</form>
<div id="progress-bar-file2" class="progress"></div>

<script>
										function postFile2() {
										    var formdata = new FormData();

										    formdata.append('main_images', $('#main_images')[0].files[0]);

										    var request = new XMLHttpRequest();

										    request.upload.addEventListener('progress', function (e) {
										        var file1Size = $('#main_images')[0].files[0].size;

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
<!--======================+icon1+========================-->
	<script>
		function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah1')
                        .attr('src', e.target.result)
                        .width(90)
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
                        .width(170)
                };

                reader.readAsDataURL(input.files[0]);
                $("div2").hide();
            }
        }
    </script>
<!--======================+icon1+========================-->
	<script>
		function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah3')
                        .attr('src', e.target.result)
                        .width(170)
                };

                reader.readAsDataURL(input.files[0]);
                $("div3").hide();
            }
        }
    </script>
<!--======================+icon1+========================-->
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

</body>
</html>
<?php } ?>