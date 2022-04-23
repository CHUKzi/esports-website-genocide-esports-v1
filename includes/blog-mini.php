	<section class="news-section">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<div class="title">Recent Articles</div>
				<h2>Latest Posts</h2>
			</div>
			
			<div class="row clearfix">
				
				<!-- News Block -->
	            <?php 
	            $query = "SELECT * FROM blogs ORDER BY time DESC LIMIT 3";
	            $blogs = mysqli_query($connection, $query);
	            $cnt=1;
	            if ($blogs) {
	            while ($blogs_info = mysqli_fetch_assoc($blogs)) {?>
				<div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
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