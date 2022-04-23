<?php 
require_once('includes/connection.php'); 
require_once('includes/functions.php'); 
require_once('includes/subscribe.php');
require_once('includes/time-functions.php');
include('includes/on-off.php');
include('includes/minifier.php');
$pagenum = '6';
require_once('includes/views-functions.php');
$page = '5';
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

<title>Blogs - <?php echo htmlentities($main_info["title"]);?></title>
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

<?php 
$query = "SELECT * FROM blogs_head WHERE id=1";
$gallery_page_head = mysqli_query($connection, $query);
$gallery_info = mysqli_fetch_assoc($gallery_page_head);
?>
	<!--Page Title-->
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

    <!-- News Section -->
	<section class="news-section style-two">
		<div class="auto-container">
			<div class="row clearfix">
				<!-- News Block -->
            <div class="row clearfix">
	            <?php 
	            $query = "SELECT * FROM blogs ORDER BY time DESC";
	            $blogs = mysqli_query($connection, $query);
	            $cnt=1;
	            if ($blogs) {
	            while ($blogs_info = mysqli_fetch_assoc($blogs)) {?>
				<div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms">
					<div class="inner-box hvr-bob">
							 <?php
								$string = str_replace(' ', '-', $blogs_info["title"]);
								$string = preg_replace("/[\s-]+/", " ", $string);
								// Convert whitespaces and underscore to dash
								$string = preg_replace("/[\s_]/", "-", $string);
							 ?>
						<div class="image">
							<a href="<?php echo htmlentities($main_info["domain"]);?>/blog/?id=<?php echo htmlentities($blogs_info["id"]);?>&name=<?php echo $string ; ?>"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/blogs/<?php echo htmlentities($blogs_info["thumbnail"]);?>" alt="" /></a>
						</div>
						<div class="lower-content">
							 <?php
								date_default_timezone_set('asia/colombo'); 
								$curenttime=$blogs_info["time"];
								$time_ago =strtotime($curenttime);
							 ?>
							<div class="post-date"><?php echo timeAgo($time_ago);?></div>
							<h3><a href="<?php echo htmlentities($main_info["domain"]);?>/blog/?id=<?php echo htmlentities($blogs_info["id"]);?>&name=<?php echo $string ; ?>"><?php echo mb_strimwidth($blogs_info["title"], 0, 35, "...");?></a></h3>
						</div>
					</div>
				</div>
				<?php $cnt=$cnt+1; }} ?>
				

			</div>
		</div>
	</section>
	<!-- End News Section -->
	
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