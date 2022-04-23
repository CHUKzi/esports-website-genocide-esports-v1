    <section class="welcome-section">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <div class="title">Welcome to the Best</div>
                <h2>GENOCIDE JERSEY</h2>
            </div>
<?php 
$query = "SELECT * FROM home_page_box WHERE id=1";
$jersey = mysqli_query($connection, $query);
$clan_jersey = mysqli_fetch_assoc($jersey);
?>
            <div class="row clearfix">
                
                <!--Default Portfolio Item-->
                <div class="default-portfolio-item col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="inner-box hvr-bob">
                        <figure class="image-box"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/gallery/<?php echo htmlentities($clan_jersey["icon1"]);?>" alt=""></figure>
                        <!--Overlay Box-->
                        <div class="overlay-box">
                            <div class="overlay-inner">
                                <div class="content">
                                    <h3><a href="<?php echo htmlentities($clan_jersey["link"]);?>"><?php echo htmlentities($clan_jersey["title2"]);?></a></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <!--Default Portfolio Item-->
                <div class="default-portfolio-item col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                    <div class="inner-box hvr-bob">
                        <figure class="image-box"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/gallery/<?php echo htmlentities($clan_jersey["icon2"]);?>" alt=""></figure>
                        <!--Overlay Box-->
                        <div class="overlay-box">
                            <div class="overlay-inner">
                                <div class="content">
                                    <h3><a href="<?php echo htmlentities($clan_jersey["link2"]);?>"><?php echo htmlentities($clan_jersey["title3"]);?></a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Default Portfolio Item-->
                <div class="default-portfolio-item col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                    <div class="inner-box hvr-bob">
                        <figure class="image-box"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/gallery/<?php echo htmlentities($clan_jersey["icon3"]);?>" alt=""></figure>
                        <!--Overlay Box-->
                        <div class="overlay-box">
                            <div class="overlay-inner">
                                <div class="content">
                                    <h3><a href="<?php echo htmlentities($clan_jersey["link3"]);?>"><?php echo htmlentities($clan_jersey["title"]);?></a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <hr style="border: 1px solid red;">
            
            <!-- Lower Box -->
            <div class="lower-box">
                <div class="text"><?php echo htmlentities($main_info["contact_info"]);?></div>
                <a href="<?php echo htmlentities($main_info["domain"]);?>/about" class="theme-btn btn-style-one"><span class="btn-title">About us</span></a>
            </div>
            
        </div>
    </section>