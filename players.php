<?php 
require_once('includes/connection.php'); 
require_once('includes/functions.php'); 
require_once('includes/subscribe.php');
include('includes/on-off.php');
include('includes/minifier.php');
$pagenum = '3';
require_once('includes/views-functions.php');
$page = '2';
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

<title>Clan Members - <?php echo htmlentities($main_info["title"]);?></title>
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

	<!--Page Title-->
<?php 
$query = "SELECT * FROM members_page_head WHERE id=1";
$gallery_page_head = mysqli_query($connection, $query);
$gallery_info = mysqli_fetch_assoc($gallery_page_head);
?>
    <section class="page-banner" style="background-image:url(<?php echo htmlentities($main_info["domain"]);?>/images/background/<?php echo htmlentities($gallery_info["back_img"]);?>);">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <ul class="bread-crumb clearfix">
                    <li><a href="<?php echo htmlentities($main_info["domain"]);?>">Home</a></li>
                    <li><?php echo htmlentities($gallery_info["title"]);?></li>
                </ul>
                <h1><?php echo htmlentities($gallery_info["title"]);?></h1>
            </div>
        </div>
    </section>
    <!--End Page Title-->

	<!-- Players Section -->
	<section class="players-section players-page-section">
		<div class="auto-container">
			
			<div class="row clearfix">


 
				<div class="player-block col-lg-4 col-md-6 col-sm-12 wow fadeInLeft" data-wow-delay="0ms">
					<div class="inner-box hvr-bob">
						<div class="image">
							<a href="#"><img src="https://www.casino.org/blog/wp-content/uploads/eSports-Players-1024x682.jpg" alt="" /></a>
						</div>
						<div class="lower-content">
							<h3><a href="#">Player Name</a></h3>
							<div class="level">Player Designation</div>
							<ul class="social-icons">
								<li><a href="https://www.facebook.com/" target="_blank"><span class="fab fa-facebook-square"></span></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="player-block col-lg-4 col-md-6 col-sm-12 wow fadeInLeft" data-wow-delay="0ms">
					<div class="inner-box hvr-bob">
						<div class="image">
							<a href="#"><img src="https://zy2j5l7p3y3syp0qud0rd139-wpengine.netdna-ssl.com/wp-content/uploads/2020/03/teknos-associates-rise-of-female-gamers-image005.jpg" alt="" /></a>
						</div>
						<div class="lower-content">
							<h3><a href="#">Player Name</a></h3>
							<div class="level">Player Designation</div>
							<ul class="social-icons">
								<li><a href="https://www.facebook.com/" target="_blank"><span class="fab fa-facebook-square"></span></a></li>
							</ul>
						</div>
					</div>
				</div>


				<div class="player-block col-lg-4 col-md-6 col-sm-12 wow fadeInLeft" data-wow-delay="0ms">
					<div class="inner-box hvr-bob">
						<div class="image">
							<a href="#"><img src="https://miro.medium.com/max/1000/1*0arudU1U_pgeTeai7ZXgWQ.jpeg" alt="" /></a>
						</div>
						<div class="lower-content">
							<h3><a href="#">Player Name</a></h3>
							<div class="level">Player Designation</div>
							<ul class="social-icons">
								<li><a href="https://www.facebook.com/" target="_blank"><span class="fab fa-facebook-square"></span></a></li>
							</ul>
						</div>
					</div>
				</div>

				
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