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
  	$subtitle=$_POST['subtitle'];
  	$game_name=$_POST['game_name'];
  	$team_1=$_POST['team_1'];
  	$team_2=$_POST['team_2'];
  	$mach_time=$_POST['mach_time'];
  	$live_link=$_POST['live_link'];
	$idedit=$_POST['idedit'];

	$sql="UPDATE tournament_matches SET title=(:title), subtitle=(:subtitle), game_name=(:game_name), team_1=(:team_1), team_1=(:team_1), team_2=(:team_2), mach_time=(:mach_time), live_link=(:live_link) WHERE id=(:idedit)";

	$query = $dbh->prepare($sql);
	$query-> bindParam(':title', $title, PDO::PARAM_STR);
	$query-> bindParam(':subtitle', $subtitle, PDO::PARAM_STR);
	$query-> bindParam(':game_name', $game_name, PDO::PARAM_STR);
	$query-> bindParam(':team_1', $team_1, PDO::PARAM_STR);
	$query-> bindParam(':team_2', $team_2, PDO::PARAM_STR);
	$query-> bindParam(':mach_time', $mach_time, PDO::PARAM_STR);
	$query-> bindParam(':live_link', $live_link, PDO::PARAM_STR);
	$query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
    $query->execute();

    $msg="Match Score Edited successfully";

	//echo "<script type='text/javascript'>alert('Added successfully');</script>";
	//echo "<script type='text/javascript'> document.location = 'manage-banner.php'; </script>";
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
	
	<title>CREATE TOURNAMENT</title>

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
		$sql = "SELECT * from tournament_matches where id = :editid";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':editid',$editid,PDO::PARAM_INT);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;

		$team_id_1 = $result->team_1;
        $team_id_2 = $result->team_2;

		$sql = "SELECT * from tournament_teams WHERE id='{$team_id_1}'";
		$query = $dbh -> prepare($sql);
		$query->execute();
		$result_team_1=$query->fetch(PDO::FETCH_OBJ);


		$sql = "SELECT * from tournament_teams WHERE id='{$team_id_2}'";
		$query = $dbh -> prepare($sql);
		$query->execute();
		$result_team_2=$query->fetch(PDO::FETCH_OBJ);
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
                            <h2>CREATE MATCH</h2>
								<div class="panel panel-default">
									<div class="panel-heading">CREATE MATCH</div>
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

										<div class="form-group">
											<label class="col-sm-2 control-label">Title<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="title" placeholder="Do not use more than 100 words" class="form-control" required value="<?php echo htmlentities($result->title);?>">
											</div>
										</div>


										<div class="form-group">
											<label class="col-sm-2 control-label">Subtitle<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="subtitle" placeholder="Do not use more than 100 words" class="form-control" required value="<?php echo htmlentities($result->subtitle);?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Game Name<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="game_name" placeholder="Do not use more than 100 words" class="form-control" required value="<?php echo htmlentities($result->game_name);?>">
											</div>
										</div>

							<h1 class="text-center text-bold mt-2x">Vs</h1>

							<div class="form-group">
                            <label class="col-sm-2 control-label">Team 1<span style="color:red">*</span></label>
                            <div class="col-sm-3">
                            <select name="team_1" class="form-control">
                            <option value="<?php echo htmlentities($result_team_1->id);?>">Selected <?php echo htmlentities($result_team_1->team);?></option>
                                    <?php $sql = "SELECT * from tournament_teams WHERE tournament='{$result->tournament}' order by time DESC";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result_team_table)
                                    {               ?>
                            <option value="<?php echo htmlentities($result_team_table->id);?>"><?php echo htmlentities($result_team_table->team);?></option>
							<?php $cnt=$cnt+1; }} ?>
							</select>
                            </div>

                            <label class="col-sm-3 control-label">Team 2<span style="color:red">*</span></label>
                            <div class="col-sm-3">

                            <select name="team_2" class="form-control">
                            <option value="<?php echo htmlentities($result_team_2->id);?>">Selected <?php echo htmlentities($result_team_2->team);?></option>
                                    <?php $sql = "SELECT * from tournament_teams WHERE tournament='{$result->tournament}' order by time DESC";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result_team_table)
                                    {               ?>
                            <option value="<?php echo htmlentities($result_team_table->id);?>"><?php echo htmlentities($result_team_table->team);?></option>
							<?php $cnt=$cnt+1; }} ?>

							</select>
                            </div>
                            </div>


										<div class="form-group">
											<label class="col-sm-2 control-label">Match Start Time<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="datetime-local" name="mach_time" placeholder="Do not use more than 100 words" class="form-control" required value="<?php echo htmlentities($result->mach_time);?>">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label">Live<span style="color:red">*</span></label>
											<div class="col-sm-9">
											<input type="text" name="live_link" placeholder="Do not use more than 100 words" class="form-control" required value="<?php echo htmlentities($result->live_link);?>">
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-8 col-sm-offset-2">
												<input type="hidden" name="idedit" value="<?php echo htmlentities($result->id);?>" >
												<button class="btn btn-primary" name="submit" type="submit" onclick="postFile2()">Save Now</button>
											</div>
										</div>
										</form>
										<center>
											<div class="col-sm-12 col-sm-offset-0">
												<a href="tournament-page.php?tournament=<?php echo($result->tournament);?>"><button class="btn btn-success"><i class="fa fa-arrow-left"></i> Go Back Here</button></a>

												<a href="edit_match.php?edit=<?php echo($editid);?>"><button class="btn btn-info"><i class="fa fa-refresh"></i> Refresh</button></a>

												<a href="tournament-page.php?tournament=<?php echo($tou_id);?>" target="_blank"><button class="btn btn-danger"><i class="fa fa-eye"></i> Preview </button></a>
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
                        .width(482);
                };

                reader.readAsDataURL(input.files[0]);
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