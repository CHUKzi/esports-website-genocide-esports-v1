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

	$file = $_FILES['thumbnail']['name'];
	$file_loc = $_FILES['thumbnail']['tmp_name'];
	$folder="../images/blogs/";
	$new_file_name = strtolower($file);
	$final_file=str_replace(' ','-',date("Y-m-d_h-i_sa_").$new_file_name);

	$thumbnail=$_POST['thumbnail'];
	$title=$_POST['title'];
	$description=$_POST['description'];
	$tags=$_POST['tags'];
	$if_hide_cmt=$_POST['if_hide_cmt'];
	$idedit=$_POST['idedit'];

	if(move_uploaded_file($file_loc,$folder.$final_file))
		{
			$thumbnail=$final_file;
		}
    //$sqlhist="insert history (user,history_type,title) values (:user,:history_type,:title)";

    //$queryhist = $dbh->prepare($sqlhist);
	//$queryhist-> bindParam(':user', $sender, PDO::PARAM_STR);
	//$queryhist-> bindParam(':title',$list, PDO::PARAM_STR);
    //$queryhist-> bindParam(':history_type', $history_type, PDO::PARAM_STR);
    //$queryhist->execute();

	$sender='Admin';
	$history_type=', Blog is Edited';

	$sqlhist="insert history (user,history_type,title) values (:user,:history_type,:title)";
	$queryhist = $dbh->prepare($sqlhist);
	$queryhist-> bindParam(':user', $sender, PDO::PARAM_STR);
	$queryhist-> bindParam(':title',$title, PDO::PARAM_STR);
	$queryhist-> bindParam(':history_type', $history_type, PDO::PARAM_STR);
	$queryhist->execute();

	$sql="UPDATE blogs SET thumbnail=(:thumbnail), title=(:title), description=(:description), tags=(:tags), if_hide_cmt=(:if_hide_cmt) WHERE id=(:idedit)";

	$query = $dbh->prepare($sql);
	$query-> bindParam(':thumbnail', $thumbnail, PDO::PARAM_STR);
	$query-> bindParam(':title', $title, PDO::PARAM_STR);
	$query-> bindParam(':description', $description, PDO::PARAM_STR);
	$query-> bindParam(':tags', $tags, PDO::PARAM_STR);
	$query-> bindParam(':if_hide_cmt', $if_hide_cmt, PDO::PARAM_STR);
	$query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
    $query->execute();

	//echo "<script type='text/javascript'>alert('Added successfully');</script>";
	//echo "<script type='text/javascript'> document.location = 'blog-page.php'; </script>";
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
	
	<title>MANAGE WEB POSTS - EDIT BLOGS</title>

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
<script>
tinymce.init({
    selector: '#description',
    height : "600",
    plugins: 'image code',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | fullscreen',
      plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste imagetools wordcount'
  ],
    
    // without images_upload_url set, Upload tab won't show up
    images_upload_url: 'upload.php',
    
    // override default upload handler to simulate successful upload
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
      
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'upload.php');
      
        xhr.onload = function() {
            var json;
        
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
        
            json = JSON.parse(xhr.responseText);
        
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
        
            success(json.location);
        };
      
        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
      
        xhr.send(formData);
    },
});
</script>

<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

</head>

<?php
		$sql = "SELECT * from blogs where id = :editid";
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
                            <h2>Edit Blog : <?php echo htmlentities($result->title);?></h2>
								<div class="panel panel-default">
									<div class="panel-heading">Blog : <?php echo htmlentities($result->title);?>  :: date <?php echo htmlentities($result->time);?></div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
										<form method="post" class="form-horizontal" enctype="multipart/form-data">

										<center>

												<img id="blah" src="#" alt=" Please Choose your new image (782x429px)" /><br>
												<div2><img src="../images/blogs/<?php echo htmlentities($result->thumbnail);?>" width="540px"/></div2>

										</center>
										<br>
										<div class="form-group">
											<label class="col-sm-2 control-label">Thumbnail<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="hidden" name="thumbnail" value="<?php echo htmlentities($result->thumbnail);?>" >
											<input type="hidden" name="idedit" value="<?php echo htmlentities($result->id);?>" >
											<input type="file" name="thumbnail" class="form-control" id="img" onchange="readURL(this);" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Title<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="title" placeholder="Do not use more than 100 words" class="form-control" value="<?php echo htmlentities($result->title);?>" required>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Description<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<textarea id="description" name="description" class="form-control" placeholder="" cols="30" rows="10"><?php echo($result->description);?></textarea>
											</div>
										</div>
										<script>var myContent = tinymce.get("description").getContent();</script>


										<div class="form-group">
											<label class="col-sm-2 control-label">Tags<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="tags" placeholder=" tags (tags ,tags, tags, tags..)" class="form-control" value="<?php echo htmlentities($result->tags);?>">
											</div>
										</div>

										<div class="form-group">
										<label class="col-sm-2 control-label">Enable OR Disabled Comments<span style="color:red">*</span></label>
										<div class="col-sm-9">
										<select name="if_hide_cmt" class="form-control" required>
											<option value="<?php echo htmlentities($result->if_hide_cmt);?>">Selected <?php if($result->if_hide_cmt == 1){?>"Enable Comments"<?php } else {?>"Disabled Comments"<?php } ?></option>
											<?php if($result->if_hide_cmt == 1){?><option value="0">Disabled Comments</option>
										    <?php } else {?><option value="1">Enable Comments</option>
										    <?php } ?></select>
										</div>
										</div>

										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2">
												<input type="hidden" name="idedit" value="<?php echo htmlentities($result->id);?>" >
												<button class="btn btn-primary" name="submit" type="submit" onclick="postFile2()">Save Now</button>
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
												<a href="blog-page.php"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back to Home</button></a>

												<a href="edit-blog.php?edit=<?php echo $result->id;?>"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

												<?php
												$string = str_replace(' ', '-', $result->title);
												$string = preg_replace("/[\s-]+/", " ", $string);
												// Convert whitespaces and underscore to dash
												$string = preg_replace("/[\s_]/", "-", $string);
												?>

												<a href="../blog-details.php?id=<?php echo $result->id;?>&name=<?php echo $string ; ?>" target="_blank"><button class="btn btn-danger"><i class="fa fa-eye"></i>Preview </button></a>

												<!--<button class="btn btn-danger" id="myBtn"><i class="fa fa-eye"></i> Preview </button>-->
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
                        .width(582)
                        .height(289);
                };

                reader.readAsDataURL(input.files[0]);
                $("div2").hide();
            }
        }</script>
</body>
</html>
<?php } ?>