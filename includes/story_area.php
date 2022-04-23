<section class="facts-section">
<?php 
$query = "SELECT * FROM our_story WHERE id=1";
$our_story = mysqli_query($connection, $query);
$story_info = mysqli_fetch_assoc($our_story);
?>
		<!-- Title Boxed -->
		<div class="title-boxed" style="background-image:url(<?php echo htmlentities($main_info["domain"]);?>/images/background/<?php echo htmlentities($story_info["right_img"]);?>)">
			<div class="auto-container">
				<div class="content wow fadeInLeft" data-wow-delay="0ms">
					<h2><?php echo($story_info["title"]);?></h2>
					<a href="<?php echo htmlentities($story_info["link"]);?>" target="_blank" class="theme-btn btn-style-one"><span class="btn-title"><?php echo htmlentities($story_info["subtitle"]);?></span></a>
				</div>
			</div>
		</div>
		<!-- End Title Boxed -->
		
		<!-- Lower Boxed -->
		<div class="lower-boxed">
			<div class="auto-container">
				<div class="row clearfix">
					
					<!-- Counter Column -->
					<div class="counter-column col-lg-6 col-md-12 col-sm-12">
						<div class="inner-column">
							
							<!-- Featured Block -->
							<div class="featured-block">
								<div class="inner-box">
									<div class="icon-box">
										<span class="icon flaticon-joystick"></span>
									</div>
									<h3>05</h3>
									<div class="text">YEARS OF EXPERIENCE</div>
								</div>
							</div>
							
							<!-- Featured Block -->
							<div class="featured-block">
								<div class="inner-box">
									<div class="icon-box">
										<span class="icon flaticon-man"></span>
									</div>
									<h3>118</h3>
									<div class="text">Of Registered Players</div>
								</div>
							</div>
							
						</div>
					</div>
					
					<!-- Testimonial Column -->
					<div class="testimonial-column col-lg-6 col-md-12 col-sm-12">
						<div class="inner-column wow fadeInRight" data-wow-delay="0ms">
							
							<div class="single-item-carousel owl-carousel owl-theme">
								
								<!-- Testimonial Block -->
								<div class="testimonial-block">
									<div class="inner-box">
										<div class="quote-icon flaticon-quote-1"></div>
										<div class="text"><?php echo($story_info["story"]);?></div>
										<div class="author">Our Story</div>
									</div>
								</div>
								
								<!-- Testimonial Block -->
								<div class="testimonial-block">
									<div class="inner-box">
										<div class="quote-icon flaticon-quote-1"></div>
										<div class="text"><?php echo($story_info["history"]);?></div>
										<div class="author">Our History</div>
									</div>
								</div>
								
								<!-- Testimonial Block -->
								<div class="testimonial-block">
									<div class="inner-box">
										<div class="quote-icon flaticon-quote-1"></div>
										<div class="text"><?php echo($story_info["today"]);?></div>
										<div class="author">Today</div>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
	</section>