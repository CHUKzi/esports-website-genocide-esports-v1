<?php 
require_once('includes/connection.php'); 
require_once('includes/functions.php'); 
require_once('includes/subscribe.php');
include('includes/on-off.php');
include('includes/minifier.php');
$pagenum = '2';
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

<title>About - <?php echo htmlentities($main_info["title"]);?></title>
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
$query = "SELECT * FROM about_us_page_head WHERE id=1";
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
	<section class="players-section style-two">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<div class="title">Clan Admins</div>
				<h2>Founders & Admins</h2>
			</div>
			
			<div class="row clearfix">
				
				<!-- Player Block -->
            <?php 
			$query = "SELECT * FROM our_team ORDER BY time";
			$admins = mysqli_query($connection, $query);
			$cnt=1;
			if ($admins) {
			while ($admins_info = mysqli_fetch_assoc($admins)) {?>
				<div class="player-block col-lg-4 col-md-6 col-sm-12 wow fadeInLeft" data-wow-delay="0mss">
					<div class="inner-box hvr-bob">
						<div class="image">
							<a href="#"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/resource/<?php echo htmlentities($admins_info["avatar"]);?>" alt="" /></a>
						</div>
						<div class="lower-content">
							<h3><a href="#"><?php echo htmlentities($admins_info["name"]);?></a></h3>
							<div class="level"><?php echo htmlentities($admins_info["designation"]);?></div>
							<ul class="social-icons">
								<li><a href="<?php echo htmlentities($admins_info["fb"]);?>" target="_blank"><span class="fab fa-twitter"></span></a></li>
								<li><a href="<?php echo htmlentities($admins_info["twitter"]);?>" target="_blank"><span class="fab fa-facebook-square"></span></a></li>
								<li><a href="<?php echo htmlentities($admins_info["instagram"]);?>" target="_blank"><span class="fab fa-instagram"></span></a></li>
							</ul>
						</div>
					</div>
				</div>
			<?php $cnt=$cnt+1; }} ?>
			<!-- Player Block -->
			</div>
            <hr style="border: 1px solid red;">
            
            <!-- Lower Box -->
            <div class="lower-box">
                <a href="<?php echo htmlentities($main_info["domain"]);?>/members" class="theme-btn btn-style-one"><span class="btn-title">Clan Members</span></a>
            </div>
		</div>
	</section>
	<!-- End Players Section -->
	<!-- About Section -->
<?php 
$query = "SELECT * FROM about_us WHERE id=1";
$about_clan = mysqli_query($connection, $query);
$about_us_info = mysqli_fetch_assoc($about_clan);
?>
	<section class="player-info-section">
		<div class="auto-container">
			<div class="row clearfix">
            	<!--Text Column-->
                <div class="text-column col-lg-6 col-md-6 col-sm-12">
                	<div class="inner wow fadeInRight">
                    	<div class="title-box">
                        	<div class="user-title"><?php echo htmlentities($about_us_info["title"]);?></div>
                            <div class="user-info"><?php echo htmlentities($about_us_info["subtitle"]);?></div>
                        </div>
                        <div class="text"><?php echo($about_us_info["introduction"]);?></div>
                        <ul class="social-icons">
							<?php include('includes/social-icons.php'); ?>
						</ul>
                    </div>
                </div>
                <!--Image Column-->
                <div class="image-column col-lg-6 col-md-6 col-sm-12">
                	<div class="inner wow fadeInLeft">
                    	<figure class="image"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/resource/<?php echo htmlentities($about_us_info["back_img"]);?>" alt=""></figure>
                    </div>
                </div>
            </div>
		</div>
	</section>
	<!-- End About Section -->

	
	
	<!--Sponsors Section-->
	<?php include('includes/sponsors.php'); ?>
    <!--End Sponsors Section-->
	
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