<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_GET['tournament']))
	{
		$tou_id=$_GET['tournament'];
	}
if(isset($_GET['del']))
{
$id=$_GET['del'];

$sql = "delete from tournament_matches WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();

$msg="Data Deleted successfully";
} 

if(isset($_GET['end']))
{
$end_match=$_GET['end'];

$sql = "UPDATE tournament_matches SET is_mach_end='1' WHERE id='{$end_match}'";
$query = $dbh->prepare($sql);
$query -> execute();

$msg="Match Ended";
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
	
	<title>MANAGE WEB POSTS - PROJECTS</title>

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
<script>
function postFile() {
    var formdata = new FormData();

    formdata.append('file1', $('#file1')[0].files[0]);

    var request = new XMLHttpRequest();

    request.upload.addEventListener('progress', function (e) {
        var file1Size = $('#file1')[0].files[0].size;

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
									<div class="panel-heading"><a href="matches-manage.php"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-home" aria-hidden="true"></i></button></a> <a href="tournament-page.php?tournament=<?php echo($tou_id);?>"><button type="button" class="btn btn-success btn-sm">Refresh</button></a> Manage-Tournament / Manage-Matches</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
								<div class="panel-body" style="background-color:#DE3163;;">
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
											<a href="add-match-teams.php?tournament=<?php echo($tou_id);?>"><button class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"> ADD TEAMS</i></button></a>
											<a href="match-teams-page.php?tournament=<?php echo($tou_id);?>"><button class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"> MANAGE TEAMS</i></button></a>
											<br><br>
											<a href="create_match.php?tournament=<?php echo($tou_id);?>"><button class="btn btn-primary">+ Create NEW Match</button></a>
											<a href="recent-match.php?tournament=<?php echo($tou_id);?>"><button class="btn btn-primary">Recent Match</button></a>
									</center>
								</div>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th><b>Vs</b></th>
											<th>Match Title</th>
											<th>Match Subtitle</th>
											<th>Game Name</th>
                                            <th>Mach Date & time</th>
                                            <th>Manage</th>
											<th>Action</th>	
										</tr>
									</thead>
									<br>
									
									<tbody>

                                    <?php $sql = "SELECT * from tournament_matches WHERE tournament='{$tou_id}' AND is_mach_end = '0' order by time";
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
											<?php  
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
											<td><?php echo htmlentities($result_team_1->team);?> <b>Vs</b> <?php echo htmlentities($result_team_2->team);?></td>
											<td><?php echo htmlentities($result->title);?></td>
                                            <td><?php echo htmlentities($result->subtitle);?></td>
                                            <td><?php echo htmlentities($result->game_name);?></td>
                                            <?php 
                                            	$match_date = date("Y-m-d H:i:s", strtotime($result->mach_time));
												$formattedValue = date("d F Y - l, H:i A", strtotime($match_date));
                                             ?>

                                            <td><?php echo($formattedValue); ?></td>

                                            
                                            <td><a href="tournament-page.php?tournament=<?php echo($tou_id);?>&&end=<?php echo $result->id;?>" onclick="return confirm('Are you sure want end Match?');"><button type="button" class="btn btn-success btn-sm">End the Match</button></a></td>
                                            											
<td>
<a href="edit_match.php?edit=<?php echo $result->id;?>" onclick="return confirm('Do you want to Edit');">&nbsp; <i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
<a href="tournament-page.php?del=<?php echo $result->id;?>&tournament=<? echo($tou_id);?>" onclick="return confirm('Are you sure want to Delete This Post?');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
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