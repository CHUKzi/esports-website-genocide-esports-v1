<?php 
require_once('includes/connection.php'); 
require_once('includes/functions.php'); 
require_once('includes/time-functions.php');
include('includes/on-off.php');
include('includes/minifier.php');
$page = '5';
$cmt_poup = '1';
$contact_poup = '0';
$get_visitor_ip = $_SERVER['REMOTE_ADDR'];
$ip = $get_visitor_ip;
// Use JSON encoded string and converts 
// it into a PHP variable 
$ipdat = @json_decode(file_get_contents( 
      "http://www.geoplugin.net/json.gp?ip=" . $ip));
$time_zone = $ipdat->geoplugin_timezone;

if(isset($_GET['id']) || ($_GET["name"])) 
    {       
        if (empty($_GET['id'])) {
            header( "Location: ../" );
        }

        else
        {
        if (empty($_GET['name'])) {
            header( "Location: ../" );
        }
        else
        {
        $blog=$_GET['id'];
        $get_name=$_GET['name'];
        $name = str_replace('/','',$get_name);
        $name_title = str_replace('-',' ',$name);
        }
        
        }
    }
if (empty($blog)) {
    header( "Location: 404.php" );
} 

if (empty($name)) {
    header( "Location: 404.php" );
} 

$query = "SELECT * from blogs where id = '$blog'";
$result = mysqli_query($connection, $query);
$num_row = mysqli_num_rows ($result);

if($num_row == 0)
                {
 
header( "Location: 404.php" );

 } else {
    require_once('includes/post-comments.php');

    $sql = "UPDATE blogs SET views = views+1 WHERE id = '$blog'";
    $connection->query($sql);
require_once('includes/subscribe.php');
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

<title><?php echo $name_title; ?> - Blog - <?php echo htmlentities($main_info["title"]);?></title>
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
<?php include('includes/cmt-msg.php'); ?>
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

        <!--Sidebar Page Container-->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Side / Blog Detail-->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="blog-detail">
                		<div class="image-box">
                    <?php 
                    $query = "SELECT * FROM blogs WHERE id='$blog'";
                    $blogs = mysqli_query($connection, $query);
                    $blogs_info = mysqli_fetch_assoc($blogs);
                    ?>
                			<figure class="image"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/blogs/<?php echo htmlentities($blogs_info["thumbnail"]);?>" alt=""></figure>
                		</div>
                		<div class="lower-content">
                             <?php
                                //date_default_timezone_set('asia/colombo'); 
                                $curenttime=$blogs_info["time"];
                                $time_ago =strtotime($curenttime);
                             ?>
                			<div class="post-date"><?php echo timeAgo($time_ago);?></div>
							<h3><?php echo htmlentities($blogs_info["title"]);?></h3>
							<ul class="post-info">
								<li>by <?php echo htmlentities($main_info["title"]);?></li>
                            <?php 
                                $query = "SELECT * FROM comments WHERE post_id = '$blog' AND is_delete = '0'";
                                $cmt_result = mysqli_query($connection, $query);
                                $cmt_num_row = mysqli_num_rows ($cmt_result);
                            ?>
								<li><?php echo $cmt_num_row; ?> Comments</a></li>
								<li><?php echo htmlentities($blogs_info["views"]);?> Views</li>
							</ul>
                            <?php echo($blogs_info["description"]);?>
                		</div>
                    </div>

                    <?php if($blogs_info["if_hide_cmt"] == 1)
                    {?>
                    <div class="comment-form">
                        <div class="group-title"><h3>Leave a comment</h3></div>
                             <?php
                                $string = str_replace(' ', '-', $blogs_info["title"]);
                                $string = preg_replace("/[\s-]+/", " ", $string);
                                // Convert whitespaces and underscore to dash
                                $string = preg_replace("/[\s_]/", "-", $string);
                             ?>
                        <form method="post" action="<?php echo htmlentities($main_info["domain"]);?>/blog/?id=<?php echo htmlentities($blogs_info["id"]);?>&name=<?php echo $string ; ?>">
                            <div class="row clearfix">                                    
                                <div class="col-md-6 col-sm-12 form-group">
                                    <input type="text" name="name" placeholder="Full name" <?php echo 'value="' . $name . '"'; ?>>
                                </div>
                                
                                <div class="col-md-6 col-sm-12 form-group">
                                    <input type="email" name="email" placeholder="Email address" <?php echo 'value="' . $email . '"'; ?>>
                                </div>

                                <div class="col-md-12 col-sm-12 form-group">
                                    <textarea name="comment" placeholder="Write a comment"><?php echo "$comment"; ?></textarea>
                                </div>

                                <div class="col-md-12 col-sm-12 form-group">
                                    <button class="theme-btn btn-style-one" type="submit2" name="submit2"><span class="btn-title">Post Comment</span></button>
                                </div>
                            </div>
                        </form>
                    </div><br>
                    <?php } else {?>
                      <!--disabled-->
                      <div class="group-title"><h5><i>Comments is disabled for this Post</i></h5></div>
                    <?php } ?>
                    <!--Comment Form-->


                    <hr style="border: 1px solid red;">

                    <!-- Comments Area -->
                    <div class="comments-area">

                        <div class="group-title"><h3><?php echo $cmt_num_row; ?> Comments</h3></div>

                <?php 
                $query = "SELECT * FROM comments WHERE post_id = '$blog' ORDER BY time DESC";
                $comments = mysqli_query($connection, $query);
                $cnt=1;
                if ($comments) {
                while ($comments_info = mysqli_fetch_assoc($comments)) {?>

                <?php if($comments_info["is_delete"] == 1)
                {?>
                <!--<p style="color:red;"><i>This comment has been deleted BY Admin</i></p>-->
                <?php } else {?>
                        <div class="comment-box reply-comment">
                            <div class="comment">
                                <div class="author-thumb">
                                    <figure class="thumb"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/gnc_guest_comment_img.jpg" alt=""></figure>
                                </div> 
                                <h4 class="name"><?php echo htmlentities(mb_strimwidth($comments_info["name"], 0, 18, "..."));?></h4>
                                <div class="text">
                            <?php 
                                $reg_exUrl = "/(http|https|http|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                                $comment2 = $comments_info["comment"];
                                $comment = str_replace(array("\n","\n"),'<br>', $comment2);
                                 ?>
                                <?php 
                                if(preg_match($reg_exUrl, $comment, $url)) {
                                       echo preg_replace($reg_exUrl,'<a href="'. $url[0] .'" target="_blank">'. $url[0] .'</a>', $comment);
                                } else {
                                       echo $comment;
                                }
                                ?>
                                </div>
                             <?php
                                //date_default_timezone_set('asia/colombo'); 
                                $curenttime=$comments_info["time"];
                                $time_ago =strtotime($curenttime);
                             ?>
                                <p class="reply-btn"><?php echo timeAgo($time_ago);?></p>

                            </div>
                        </div>
                        <?php $cnt=$cnt+1; }} ?>
                        <!--no action-->
                        <?php } ?>
                    </div>
                    
                    <!-- Other Options -->
                    <div class="post-share-options clearfix">
                        <div class="pull-left">
                            <ul class="tags">
                                <li><a href="<?php echo htmlentities($main_info["domain"]);?>">Home</a></li>
                                <li><a href="<?php echo htmlentities($main_info["domain"]);?>/about">About us</a></li>
                                <li><a href="<?php echo htmlentities($main_info["domain"]);?>/members">Players</a></li>
                            </ul>
                        </div>

                        <div class="social-links pull-right">
                            <ul class="social-links">
                            <?php include('includes/social-icons.php'); ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">
                    	<!-- Search -->
                        <!--<div class="sidebar-widget search-box">
                            <form method="post" action="http://t.commonsupport.xyz/gamon/contact.html">
                                <div class="form-group">
                                    <input type="search" name="search-field" value="" placeholder="Search" required>
                                    <button type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>
                        </div>-->

                        <!-- Post Widget -->
                        <div class="sidebar-widget popular-posts">
                            <div class="widget-content">
                                <h4 class="sidebar-title">Recent Posts</h4>
                            <?php 
                            $query = "SELECT * FROM blogs ORDER BY time DESC LIMIT 5";
                            $blogs = mysqli_query($connection, $query);
                            $cnt=1;
                            if ($blogs) {
                            while ($blogs_info_mini = mysqli_fetch_assoc($blogs)) {?>
                            <?php
                                $string = str_replace(' ', '-', $blogs_info_mini["title"]);
                                $string = preg_replace("/[\s-]+/", " ", $string);
                                // Convert whitespaces and underscore to dash
                                $string_mini = preg_replace("/[\s_]/", "-", $string);
                             ?>
                                <article class="post">
                                    <div class="post-inner">
                                        <figure class="post-thumb"><a href="<?php echo htmlentities($main_info["domain"]);?>/blog/?id=<?php echo htmlentities($blogs_info_mini["id"]);?>&name=<?php echo $string ; ?>"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/blogs/<?php echo htmlentities($blogs_info_mini["thumbnail"]);?>" alt=""></a></figure>
                                    <?php
                                        //date_default_timezone_set('asia/colombo'); 
                                        $curenttime=$blogs_info_mini["time"];
                                        $time_ago =strtotime($curenttime);
                                    ?>
                                        <div class="post-info"><?php echo timeAgo($time_ago);?></div>
                                        <div class="text"><a href="<?php echo htmlentities($main_info["domain"]);?>/blog/?id=<?php echo htmlentities($blogs_info_mini["id"]);?>&name=<?php echo $string_mini ; ?>"><?php echo mb_strimwidth($blogs_info_mini["title"], 0, 24, "...");?></a></div>
                                    </div>

                                </article>
                            <?php $cnt=$cnt+1; }} ?>
                                

                            </div>
                        </div>

                        <!-- Tags Widget -->
                        <div class="sidebar-widget popular-tags">
                            <div class="widget-content">
                                <h4 class="sidebar-title">Post tags</h4>
                                <h4><?php echo htmlentities($blogs_info["tags"]);?></h4>
                            </div>
                        </div>

                        <!-- Category Widget -->
                        <div class="sidebar-widget categories">
                            <div class="widget-content">
                                <h4 class="sidebar-title">Categories</h4>
                                <!-- Blog Category -->
                                <ul class="blog-categories">
                                    <li><a href="<?php echo htmlentities($main_info["domain"]);?>">Home</a></li>
                                    <li><a href="<?php echo htmlentities($main_info["domain"]);?>/matches">Matches</a></li>
                                    <li><a href="<?php echo htmlentities($main_info["domain"]);?>/members">Members</a></li>
                                    <li><a href="<?php echo htmlentities($main_info["domain"]);?>/blogs">Blogs</a></li>
                                    <li><a href="<?php echo htmlentities($main_info["domain"]);?>/contact">Contact</a></li>
                                </ul>
                            </div>
                        </div>           
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- End Sidebar Page Container -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="auto-container">
            <!--Widgets Section-->
            <div class="widgets-section">
                <div class="row clearfix">
                    
                    <!--Column-->
                    <div class="column col-lg-4 col-md-6 col-sm-12">
                        <div class="footer-widget logo-widget">
                            <div class="logo">
                                <a href="<?php echo htmlentities($main_info["domain"]);?>"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/<?php echo htmlentities($main_info["logo_f"]);?>" alt="" /></a>
                            </div>
                            <div class="text"><?php echo htmlentities($main_info["about_us"]);?></div>
                        </div>
                    </div>
                    
                    <!--Column-->
                    <div class="column col-lg-4 col-md-6 col-sm-12">
                        <div class="footer-widget links-widget">
                            <div class="widget-content">
                                <div class="footer-title">
                                    <h2>Links</h2>
                                </div>
                                <div class="row clearfix">
                                    <div class="column col-lg-6 col-md-6 col-sm-12">
                                        <ul class="list">
                                            <li><a href="<?php echo htmlentities($main_info["domain"]);?>">Home</a></li>
                                            <li><a href="<?php echo htmlentities($main_info["domain"]);?>/about">About</a></li>
                                            <li><a href="<?php echo htmlentities($main_info["domain"]);?>/members">Clan Members</a></li>
                                            <li><a href="<?php echo htmlentities($main_info["domain"]);?>/gallery">Gallery</a></li>
                                            <li><a href="<?php echo htmlentities($main_info["domain"]);?>/contact">Contact</a></li>
                                        </ul>
                                    </div>
                                    <div class="column col-lg-6 col-md-6 col-sm-12">
                                        <ul class="list">
                                            <li><a href="#">Help & Support</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                            <li><a href="#">Terms of Use</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    
                    <!--Column-->
                    <div class="column col-lg-4 col-md-6 col-sm-12">
                        <div class="footer-widget newsletter-widget">
                            <div class="footer-title">
                                <h2>Newsletter</h2>
                            </div>
                            <div class="text">Subsrcibe us now to get the latest news and updates</div>
                            <div class="newsletter-form">
                                <form method="post">
                                    <div class="form-group clearfix">
                                        <input type="email" name="email" value="" placeholder="Email address" required>
                                        <button type="submit3" name="submit3" class="theme-btn newsletter-btn"><span class="fas fa-envelope"></span></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="auto-container">
                <!--Scroll to top-->
                <div class="scroll-to-top scroll-to-target" data-target="html"><span class="flaticon-up-arrow"></span></div>
                <!--Scroll to top-->
                <div class="row clearfix">
                    <!-- Column -->
                    <div class="column col-lg-6 col-md-12 col-sm-12">
                        <div class="copyright">&copy; <?php echo htmlentities($main_info["copywright"]);?></div>
                    </div>
                    <!-- Column -->
                    <div class="column col-lg-6 col-md-12 col-sm-12">
                        <ul class="social-icons">
                            <?php include('includes/social-icons.php'); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
    </footer>
	
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
<?php }; ?>
<?php ob_end_flush(); ?> 
<?php mysqli_close($connection); //close connection ?>