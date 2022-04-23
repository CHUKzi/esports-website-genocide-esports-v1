<?php 
require_once('includes/connection.php'); 
require_once('includes/functions.php'); 
require_once('includes/subscribe.php');
include('includes/on-off.php');
include('includes/minifier.php');
$pagenum = '8';
require_once('includes/views-functions.php');
$page = '0';
$cmt_poup = '0';
$contact_poup = '0';
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">

<?php 
$query = "SELECT * FROM main WHERE id=1";
$main = mysqli_query($connection, $query);
$main_info = mysqli_fetch_assoc($main);
?>

<title>404 Page not found</title>
<!-- Stylesheets -->
<link href="<?php echo htmlentities($main_info["domain"]);?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo htmlentities($main_info["domain"]);?>/css/style.css" rel="stylesheet">
<link href="<?php echo htmlentities($main_info["domain"]);?>/css/responsive.css" rel="stylesheet">

<link rel="shortcut icon" href="<?php echo htmlentities($main_info["domain"]);?>/images/<?php echo htmlentities($main_info["icon"]);?>" type="image/x-icon">
<link rel="icon" href="<?php echo htmlentities($main_info["domain"]);?>/images/<?php echo htmlentities($main_info["icon"]);?>" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<?php echo($main_info["script"]);?>

</head>

<body>
<?php include('includes/subscribe-msg.php'); ?>
<div class="page-wrapper">
    <!-- Preloader -->
    <!--<div class="preloader"><div class="icon"></div></div>-->

    <!-- Main Header -->
	<?php include('includes/header.php'); ?>
    <!-- End Main Header -->

	<!-- Players Section -->
	<section class="players-section players-page-section">
		<div class="auto-container">
			
			<!--<div class="row clearfix">
				
				<div class="player-block col-lg-4 col-md-6 col-sm-12 wow fadeInLeft" data-wow-delay="0ms">
					<div class="inner-box hvr-bob">
						<div class="image">
							<a href="#"><img src="images/resource/player-4.jpg" alt="" /></a>
						</div>
						<div class="lower-content">
							<h3><a href="#">Lion king</a></h3>
							<div class="level">36 level completed</div>
							<ul class="social-icons">
								<li><a href="#"><span class="fab fa-twitter"></span></a></li>
								<li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
								<li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
								<li><a href="#"><span class="fab fa-instagram"></span></a></li>
							</ul>
						</div>
					</div>
				</div>
				
			</div>-->
			<div class="sec-title centered">
				<!--<div class="title">404 page</div>-->
				<h2>404 <br> Page not found</h2>
			</div>
		</div>
	</section>
	<!-- End Players Section -->
	
	<!-- Main Footer -->
<?php include('includes/footer.php'); ?>
	
</div>
<!--End pagewrapper-->
<?php echo($main_info["script_f"]);?>
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/jquery.js"></script>
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/popper.min.js"></script>
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/bootstrap.min.js"></script>
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/jquery-ui.js"></script>
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/jquery.fancybox.js"></script>
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/owl.js"></script>
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/appear.js"></script>
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/wow.js"></script>
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/scrollbar.js"></script>
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/script.js"></script>

</body>
</html>
<?php ob_end_flush(); ?> 
<?php mysqli_close($connection); //close connection ?>