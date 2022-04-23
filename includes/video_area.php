<section class="gallery-section" style="background-image:url(<?php echo htmlentities($main_info["domain"]);?>/images/background/2.jpg)">
        <div class="auto-container">
            <!-- Sec Title -->
<?php 
$query = "SELECT * FROM video_progress WHERE id=1";
$s_video = mysqli_query($connection, $query);
$video_progress = mysqli_fetch_assoc($s_video);
?>
            <div class="sec-title centered">
                <div class="title">Watch Popular</div>
                <h2><?php echo htmlentities($video_progress["head_title"]);?></h2>
            </div>
            
            <div class="row clearfix">

                <!-- Column -->
                <div class="column col-lg-12 col-md-12 col-sm-12">
                    
                    <!-- Gallery Block -->
                    <div class="gallery-block">
                        <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="image">
                                <img src="<?php echo htmlentities($main_info["domain"]);?>/images/gallery/<?php echo htmlentities($video_progress["back_img"]);?>" alt="" />
                                <div class="overlay-box">
                                    <div class="overlay-inner">
                                        <a href="<?php echo htmlentities($video_progress["introduction"]);?>" class="lightbox-image play-box"><span class="flaticon-play-button"><i class="ripple"></i></span></a>
                                        <div class="content">
                                            <div class="title"><?php echo htmlentities($video_progress["subtitle"]);?></div>
                                            <h2><a href="<?php echo htmlentities($video_progress["introduction"]);?>" class="lightbox-image"><?php echo htmlentities($video_progress["title"]);?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <!-- Column -->

            
            </div>
        </div>
    </section>