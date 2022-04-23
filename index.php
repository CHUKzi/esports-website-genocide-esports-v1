<?php 
require_once('includes/connection.php'); 
require_once('includes/functions.php'); 
require_once('includes/subscribe.php');
require_once('includes/time-functions.php');
include('includes/on-off.php');
include('includes/minifier.php');
$pagenum = '1';
require_once('includes/views-functions.php');
$page = '1';
$cmt_poup = '0';
$contact_poup = '0';
$get_visitor_ip = $_SERVER['REMOTE_ADDR'];
$ip = $get_visitor_ip;
// Use JSON encoded string and converts 
// it into a PHP variable 
$ipdat = @json_decode(file_get_contents( 
      "http://www.geoplugin.net/json.gp?ip=" . $ip));
$time_zone = $ipdat->geoplugin_timezone;
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

<meta name="description" content="<?php echo htmlentities($main_info["about_us"]);?>">

<title><?php echo htmlentities($main_info["title"]);?> - Have Fun</title>
<!-- Stylesheets -->
<link href="<?php echo htmlentities($main_info["domain"]);?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo htmlentities($main_info["domain"]);?>/css/style.css" rel="stylesheet">
<link href="<?php echo htmlentities($main_info["domain"]);?>/css/responsive.css" rel="stylesheet">

<link rel="shortcut icon" href="<?php echo htmlentities($main_info["domain"]);?>/images/<?php echo htmlentities($main_info["icon"]);?>" type="image/x-icon">
<link rel="icon" href="<?php echo htmlentities($main_info["domain"]);?>/images/<?php echo htmlentities($main_info["icon"]);?>" type="image/x-icon">

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

    <!-- Banner Section -->
    <section class="banner-section">
        <div class="banner-carousel owl-theme owl-carousel">
            <!-- Slide Item -->
            <?php 
			$query = "SELECT * FROM banners ORDER BY time";
			$banner = mysqli_query($connection, $query);
			$cnt=1;
			if ($banner) {
			while ($banner_info = mysqli_fetch_assoc($banner)) {?>
            <div class="slide-item">
            	<div class="image-layer" style="background-image:url(<?php echo htmlentities($main_info["domain"]);?>/images/main-slider/<?php echo htmlentities($banner_info["image"]);?>)"></div>

                <div class="auto-container">
                    <div class="content-box">
                        <h2><?php echo htmlentities($banner_info["title"]);?></h2>
                        <div class="btn-box"><a href="<?php echo htmlentities($banner_info["link"]);?>" target="_blank" class="theme-btn btn-style-one"><span class="btn-title">Learn more</span></a></div>
                    </div>  
                </div>
            </div>
		<?php $cnt=$cnt+1; }} ?>
        </div>
    </section>
    <!--End Banner Section -->

	<!-- Welcome Section -->
	<?php include('includes/jersey.php'); ?>
	<!-- End Welcome Section -->
	<!--Sponsors Section-->
	<?php include('includes/sponsors.php'); ?>
    <!--End Sponsors Section-->

	<!-- News Section -->
	<?php include('includes/blog-mini.php'); ?>
	<!-- End News Section -->
	
	<!-- Gallery Section -->
	<?php include('includes/video_area.php'); ?>
	<!-- End Gallery Section -->

	<!-- Matches Section -->
	<!-- End Matches Section -->
	
	<?php include('includes/mini_gallery.php'); ?>
	<!-- Gallery Section Two -->

	
	<!-- Questions Section -->
	<!--<section class="questions-section">
		<div class="auto-container">-->
			<!-- Sec Title -->
			<!--<div class="sec-title centered">
				<div class="title">Frequently Asked Questions</div>
				<h2>Question & Answers</h2>
			</div>
			
			<div class="inner-container">
				<div class="row clearfix">
					
					<div class="question-block col-lg-6 col-md-12 col-sm-12">
						<div class="inner-box">
							<div class="icon-box">
								<span class="icon flaticon-question"></span>
							</div>
							<h3><a href="#">How to download the game?</a></h3>
							<div class="text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</div>
						</div>
					</div>
					

					<div class="question-block col-lg-6 col-md-12 col-sm-12">
						<div class="inner-box">
							<div class="icon-box">
								<span class="icon flaticon-question"></span>
							</div>
							<h3><a href="#">Is there any age restrictions?</a></h3>
							<div class="text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</div>
						</div>
					</div>
					

					<div class="question-block col-lg-6 col-md-12 col-sm-12">
						<div class="inner-box">
							<div class="icon-box">
								<span class="icon flaticon-question"></span>
							</div>
							<h3><a href="#">how to become a team member?</a></h3>
							<div class="text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</div>
						</div>
					</div>
					

					<div class="question-block col-lg-6 col-md-12 col-sm-12">
						<div class="inner-box">
							<div class="icon-box">
								<span class="icon flaticon-question"></span>
							</div>
							<h3><a href="#">Is there any reward for winners?</a></h3>
							<div class="text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</div>
						</div>
					</div>
					
				</div>
			</div>
			
		</div>
	</section>-->
	
	<!-- Call To Action Section -->
	<?php include('includes/story_area.php'); ?>
	<!-- End Call To Action Section -->

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