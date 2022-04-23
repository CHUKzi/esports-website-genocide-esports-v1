<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
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
	
	<title>Admin Dashboard</title>

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
	<link rel="icon" href="img/favicon.png" type="img/x-icon">
</head>

<body>
<?php include('includes/header.php');?>

	<div class="ts-main-content">
<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Dashboard</h2>
						
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">
<?php 
$sql ="SELECT * from pages where id = 1";
$query = $dbh -> prepare($sql);
$query->execute();
$resultboxes=$query->fetch(PDO::FETCH_OBJ);
$cnt=1;	
?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($resultboxes->total_views);?></div>
													<div class="stat-panel-title text-uppercase">Total Views</div>
												</div>
											</div>
											<a href="views.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-info text-light">
												<div class="stat-panel text-center">
<?php
		$sql = "SELECT * from notification where id = '1'";
		$query = $dbh -> prepare($sql);
		$query->execute();
		$result2=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;	
?>

<?php 
$sql ="SELECT id from contact where is_delete = '0'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$emg=$query->rowCount();
?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($result2->emails);?></div>
													<div class="stat-panel-title text-uppercase">New contact e-mails</div>
												</div>
											</div>
											<a href="emails.php" class="block-anchor panel-footer"> Full Detail <i class="fa fa-arrow-right"></i>&nbsp;&nbsp;(+<?php echo htmlentities($emg);?>)</a>
										</div>
									</div>

									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">

													<div class="stat-panel-number h1 ">0</div>
													<div class="stat-panel-title text-uppercase">issues</div>
												</div>
											</div>
											<a href="clint-feedback.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i>&nbsp;&nbsp;</a>
										</div>
									</div>

									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-danger text-light">
												<div class="stat-panel text-center">

<?php
		$sql = "SELECT * from notification where id = '1'";
		$query = $dbh -> prepare($sql);
		$query->execute();
		$result4=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;	
?>

<?php 
$sql ="SELECT id from comments where is_delete = '0'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$comments=$query->rowCount();
?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($result4->comments);?></div>
													<div class="stat-panel-title text-uppercase">New Comments</div>
												</div>
											</div>
											<a href="comments.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i>&nbsp;&nbsp;(+<?php echo htmlentities($comments);?>)</a>
										</div>
										</div>
									
<?php
//main table
    $sql = "SELECT * from main where id = 1";
    $query = $dbh -> prepare($sql);
    $query->execute();
    $main=$query->fetch(PDO::FETCH_OBJ);
	$cnt=1;	

?>
								
<?php
	// wish design by CHUKz!
	date_default_timezone_set('asia/colombo');

	$Hour = date('G');

	if ( $Hour >= 00 && $Hour <= 11 ) {
	    echo '<center><h1>Good Morning, Welcome to '. $main->title .' Admin panel</h1></center>';
	} else if ( $Hour >= 12 && $Hour <= 16 ) {
	    echo '<center><h1>Good Afternoon, Welcome to '. $main->title .' Admin panel</h1></center>';
	} else if ( $Hour >= 17 || $Hour <= 23 ) {
	    echo '<center><h1>Good Evening, Welcome to '. $main->title .' Admin panel</h1></center>';
	}
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
										    <script type="text/javascript">
										      google.charts.load("current", {packages:["corechart"]});
										      google.charts.setOnLoadCallback(drawChart);
										      function drawChart() {
										        var data = google.visualization.arrayToDataTable([
										          ['Task', 'automatic'],
									<?php $sql = "SELECT * from pages ";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>
										          ['<?php echo htmlentities($result->page_name);?>',     <?php echo htmlentities($result->total_views);?>],
									<?php $cnt=$cnt+1; }} ?>

										        ]);
										        var options = {
										          title: 'WEB PAGES TOTAL VIEWS',
										          is3D: true,
										        };
										        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
										        chart.draw(data, options);
										      }
										    </script>

										   <div id="piechart_3d" style="width: 810px; height: 610px;"></div>

<!--<p class="text-right">-->

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
	
	<script>
		
	window.onload = function(){
    
		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		}); 
		
		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}
	</script>
</body>
</html>
<?php } ?>