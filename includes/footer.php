<?php
$page_id = $pagenum;
$visitor_ip = $_SERVER['REMOTE_ADDR']; // stores IP address of visitor in variable
add_view($connection, $visitor_ip, $page_id);
?>
<?php $total_page_views = total_views($connection, 1); ?>

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