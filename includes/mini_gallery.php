    <br>
    <section class="gallery-section-two">
    
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <div class="title">Check Out Our</div>
                <h2>Photos gallery</h2>
            </div>
            
            <div class="row clearfix">
            
            <?php 
            $query = "SELECT * FROM our_projects ORDER BY time DESC LIMIT 9";
            $gallery = mysqli_query($connection, $query);
            $cnt=1;
            if ($gallery) {
            while ($gallery_info = mysqli_fetch_assoc($gallery)) {?>
                <!--Gallery Item-->
                <div class="gallery-item col-lg-4 col-md-6 col-sm-12 wow fadeInLeft" data-wow-delay="0ms">
                    <div class="inner-box">
                        <figure class="image-box">
                            <img src="<?php echo htmlentities($main_info["domain"]);?>/images/gallery/<?php echo htmlentities($gallery_info["thumbnail"]);?>" alt="">
                            <!--Overlay Box-->
                            <div class="overlay-box">
                                <div class="overlay-inner">
                                    <div class="content">
                                        <a href="#" class="link"><span class="icon flaticon-unlink"></span></a>
                                        <a href="<?php echo htmlentities($main_info["domain"]);?>/images/gallery/<?php echo htmlentities($gallery_info["thumbnail"]);?>" data-fancybox="gallery-2" data-caption="" class="link"><span class="icon flaticon-add"></span></a>
                                    </div>
                                </div>
                            </div>
                        </figure>
                    </div>
                </div>
                <?php $cnt=$cnt+1; }} ?>
            </div>
            
        </div>
	</section>