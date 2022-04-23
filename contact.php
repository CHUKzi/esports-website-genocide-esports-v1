<?php
require_once('includes/connection.php'); 
require_once('includes/functions.php'); 
require_once('includes/subscribe.php');
require_once('includes/send-contact-email.php');
include('includes/on-off.php');
include('includes/minifier.php');
$pagenum = '7';
require_once('includes/views-functions.php');
$page = '6';
$cmt_poup = '0';
$contact_poup = '1';
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

<title>Contact - <?php echo htmlentities($main_info["title"]);?></title>
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
<?php include('includes/contact-msg.php'); ?>
<?php include('includes/subscribe-msg.php'); ?>

<div class="page-wrapper">
    <!-- Preloader -->
    <!--<div class="preloader"><div class="icon"></div></div>-->

    <!-- Main Header -->
    <?php include('includes/header.php'); ?>
    <!-- End Main Header -->

	<!--Page Title-->
<?php 
$query = "SELECT * FROM services_page_head WHERE id=1";
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

    <!-- Contact Form Section -->
    <section class="contact-form-section style-two">
        <div class="auto-container">
            <div class="row clearfix">
                
                <!-- Title Column -->
                <div class="title-column col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInLeft" data-wow-delay="0ms">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            <div class="title">Contact With Us</div>
                            <h2>we’re here to help you</h2>
                        </div>
                        <div class="text"><?php echo htmlentities($main_info["contact_info"]);?></div>
                        <ul class="social-icons">
                        <?php include('includes/social-icons.php'); ?>
                        </ul>
                    </div>
                </div>
                
                <!-- Form Column -->
                <div class="form-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column wow fadeInRight" data-wow-delay="0ms">
                        
                        <!--Default Form-->
                        <div class="default-form contact-form">

                            <form method="post" action="<?php echo htmlentities($main_info["domain"]);?>/contact" id="contact-form">
                                <div class="row clearfix">                                    
                                    <div class="col-md-6 col-sm-12 form-group">
                                        <input type="text" name="name" placeholder="Full name" <?php echo 'value="' . $name . '"'; ?>>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-12 form-group">
                                        <input type="email" name="email" placeholder="Email address" <?php echo 'value="' . $email . '"'; ?>>
                                    </div>

                                    <div class="col-md-12 col-sm-12 form-group">
                                        <input type="text" name="subject" placeholder="Subject" <?php echo 'value="' . $subject . '"'; ?>>
                                    </div>

                                    <div class="col-md-12 col-sm-12 form-group">
                                        <textarea name="message" placeholder="Write a Message"><?php echo "$message"; ?></textarea>
                                    </div>

                                    <div class="col-md-12 col-sm-12 form-group">
                                        <button class="theme-btn btn-style-one" type="submit4" name="submit4"><span class="btn-title">Send Message</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- End Contact Form Section -->
	

    <!--Map Section-->
    <!--<section class="map-section">
        <div class="auto-container">-->
            <!--Map Outer-->
            <!--<div class="map-outer">-->
                <!--Map Canvas-->
                <!--<div class="map-canvas"
                    data-zoom="12"
                    data-lat="-37.817085"
                    data-lng="144.955631"
                    data-type="roadmap"
                    data-hue="#ffc400"
                    data-title="Envato"
                    data-icon-path="images/icons/map-marker.png"
                    data-content="Melbourne VIC 3000, Australia<br><a href='mailto:info@youremail.com'>info@youremail.com</a>">
                </div>
            </div>
        </div>
    </section>-->
    <!--End Map Section-->
    <!--Sponsors Section-->
    <?php include('includes/sponsors.php'); ?>
    <!--End Sponsors Section-->
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
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/validate.js"></script>
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/scrollbar.js"></script>
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/script.js"></script>

<!--Google Map APi Key-->
<script src="http://maps.google.com/maps/api/js?key=AIzaSyBKS14AnP3HCIVlUpPKtGp7CbYuMtcXE2o"></script>
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/map-script.js"></script>
<!--End Google Map APi-->

</body>

</html>
<?php ob_end_flush(); ?> 
<?php mysqli_close($connection); //close connection ?>