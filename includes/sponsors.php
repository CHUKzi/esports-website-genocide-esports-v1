    <section class="sponsors-section">
        <div class="auto-container">
            <center>
            <div class="sponsors-outer">
                <!--Sponsors Carousel-->
                <ul class="sponsors-carousel owl-carousel owl-theme">
            <?php 
            $query = "SELECT * FROM our_sponsors ORDER BY time"; //DESC
            $sponsors = mysqli_query($connection, $query);
            $cnt=1;
            if ($sponsors) {
            while ($sponsors_info = mysqli_fetch_assoc($sponsors)) {?>
                        <li class="slide-item"><figure class="image-box"><a href="<?php echo htmlentities($sponsors_info["link"]);?>" target="_blank"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/clients/<?php echo htmlentities($sponsors_info["thumbnail"]);?>" alt=""></a></figure></li>
                    
                   <?php $cnt=$cnt+1; }} ?>
                </ul>
            </div>
            </center>
            
        </div>
    </section>