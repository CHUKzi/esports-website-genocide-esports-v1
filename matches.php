<?php 
require_once('includes/connection.php'); 
require_once('includes/functions.php'); 
require_once('includes/subscribe.php');
include('includes/on-off.php');
include('includes/minifier.php');
$pagenum = '5';
require_once('includes/views-functions.php');
$page = '4';
$cmt_poup = '0';
$contact_poup = '0';
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

<title>Matches - <?php echo htmlentities($main_info["title"]);?></title>
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

    <!--Page Title-->
<?php 
$query = "SELECT * FROM matches_page_head WHERE id=1";
$gallery_page_head = mysqli_query($connection, $query);
$gallery_info = mysqli_fetch_assoc($gallery_page_head);
?>
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
	<?php 
	$query = "SELECT * FROM our_tournament ORDER BY time DESC";
	$tournament = mysqli_query($connection, $query);
	$cnt=1;
	if ($tournament) {
	while ($tournament_info = mysqli_fetch_assoc($tournament)) {?>
	<!-- Matches Section -->
	<section class="matches-section">
		<div class="auto-container">
            <div class="sec-title1">
                <div class="title"><?php echo htmlentities($tournament_info["subtitle"]);?></div>
                <h2><?php echo htmlentities($tournament_info["title"]);?></h2>
            </div>
			<!-- Matches Info Tabs-->
			<div class="matches-info-tabs">
				<!-- Matches Tabs-->
				<div class="matches-tabs tabs-box">
					<?php 
						$tournament_id=$tournament_info["id"];

						$is_recent_results_avablibe = '';
						$is_up_results_avablibe = '';

						$query = "SELECT * FROM tournament_matches WHERE tournament='{$tournament_id}' AND is_mach_end='1' ORDER BY time DESC";
						$is_tournament_result = mysqli_query($connection, $query);
						$is_tournament_result_row = mysqli_num_rows ($is_tournament_result);
						if ($is_tournament_result_row == 0) {
							$is_recent_results_avablibe = 'No recent results yet';
						}
						$is_tournament_result_info = mysqli_fetch_assoc($is_tournament_result);

						$query = "SELECT * FROM tournament_matches WHERE tournament='{$tournament_id}' AND is_mach_end='0' ORDER BY time DESC";
						$is_up_tournament_result = mysqli_query($connection, $query);
						$is_up_tournament_result_row = mysqli_num_rows ($is_up_tournament_result);
						if ($is_up_tournament_result_row == 0) {
							$is_up_results_avablibe = 'Tournament all match ended';
						}
						$is_up_tournament_result_info = mysqli_fetch_assoc($is_up_tournament_result);
					?>
					<!--Tab Btns-->
					<ul class="tab-btns tab-buttons clearfix">
						<li data-tab="#prod-results<?php echo($tournament_id);?>" class="tab-btn active-btn"><span>recent results <?php echo($is_tournament_result_row); ?></span></li>
						<li data-tab="#prod-matches<?php echo($tournament_id);?>" class="tab-btn"><span>Upcoming matches <?php echo($is_up_tournament_result_row); ?></span></li>
						
					</ul>
					
					<!--Tabs Container-->
					<div class="tabs-content">
						
						<!--Tab-->
                        <div class="tab" id="prod-matches<?php echo($tournament_id);?>">
							<div class="content">
					            <div class="sec-title1">
					                <h2><?php echo('<br>'.$is_up_results_avablibe);?></h2>
					            </div>
								<?php 
								$tournament_id=$tournament_info["id"];

								$query = "SELECT * FROM tournament_matches WHERE tournament='{$tournament_id}' AND is_mach_end='0' ORDER BY time";
								$tournament_match = mysqli_query($connection, $query);
								$cnt=1;
								if ($tournament_match) {
								while ($tournament_match_info = mysqli_fetch_assoc($tournament_match)) {?>

								<!-- Matches Block -->
								<div class="matches-block">
									<div class="inner-block">
										<div class="row clearfix">

											<!-- Content Column -->
											<div class="content-column col-lg-7 col-md-12 col-sm-12">
												<div class="inner-column">
													<ul class="tags">
														<li><?php echo htmlentities($tournament_match_info["game_name"]);?></li>
														<?php if ($cnt == 1) {?>
															<a href="<?php echo htmlentities($tournament_match_info["live_link"]);?>" target="_blank"><li>WATCH LIVE</li></a>
														<?php } ?>
														
													</ul>
													<div class="title">Recent Results  <span>.  <?php echo htmlentities($tournament_match_info["score_team_1"]);?> : <?php echo htmlentities($tournament_match_info["score_team_2"]);?></span></div>
													<h2><?php echo htmlentities($tournament_match_info["title"]);?></h2>
		                                            <?php 
		                                            	$match_date = date("Y-m-d H:i:s", strtotime($tournament_match_info["mach_time"]));
														$formattedValue = date("d F Y - l, H:i A", strtotime($match_date));
		                                             ?>
													<div class="date"><?php echo($formattedValue);?></div>
												</div>
											</div>
											<?php 

											$team_id_1 = $tournament_match_info["team_1"];
											$team_id_2 = $tournament_match_info["team_2"];

											$query = "SELECT * from tournament_teams WHERE id='{$team_id_1}'";
											$tournament_teams = mysqli_query($connection, $query);
											$tournament_team_1_info = mysqli_fetch_assoc($tournament_teams);

											$query = "SELECT * from tournament_teams WHERE id='{$team_id_2}'";
											$tournament_teams = mysqli_query($connection, $query);
											$tournament_team_2_info = mysqli_fetch_assoc($tournament_teams);

											?>
											<!-- Match Column -->
											<div class="match-column col-lg-5 col-md-12 col-sm-12">
												<div class="inner-column">
													<div class="row clearfix">
														
														<!-- Match Item -->
														<div class="match-item col-lg-6 col-md-6 col-sm-12">
															<div class="inner-item">
																<div class="icon-box">
																	<span class="icon"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/tournament/<?php echo htmlentities($tournament_team_1_info["logo"]);?>" width="70"></span>
																</div>
																<p class="product"><?php echo htmlentities($tournament_team_1_info["team"]);?></p>
															</div>
														</div>
														
														<!-- Match Item -->
														<div class="match-item col-lg-6 col-md-6 col-sm-12">
															<div class="inner-item">
																<div class="icon-box">
																	<span class="icon"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/tournament/<?php echo htmlentities($tournament_team_2_info["logo"]);?>" width="70"></span>
																</div>
																<p class="product"><?php echo htmlentities($tournament_team_2_info["team"]);?></p>
															</div>
														</div>
														
													</div>
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<?php $cnt=$cnt+1; }} ?>
								
								
							</div>
						</div>
						
						<!--Tab-->
                        <div class="tab active-tab" id="prod-results<?php echo($tournament_id);?>">
							<div class="content">

					            <div class="sec-title1">
					                <h2><?php echo('<br>'.$is_recent_results_avablibe);?></h2>
					            </div>

								<?php 
								$tournament_id=$tournament_info["id"];

								$query = "SELECT * FROM tournament_matches WHERE tournament='{$tournament_id}' AND is_mach_end='1' ORDER BY time DESC";
								$tournament_match = mysqli_query($connection, $query);
								$cnt=1;
								if ($tournament_match) {
								while ($tournament_match_info = mysqli_fetch_assoc($tournament_match)) {?>

								<!-- Matches Block -->
								<div class="matches-block">
									<div class="inner-block">
										<div class="row clearfix">

											<!-- Content Column -->
											<div class="content-column col-lg-7 col-md-12 col-sm-12">
												<div class="inner-column">
													<ul class="tags">
														<li><?php echo htmlentities($tournament_match_info["game_name"]);?></li>
														<a href="<?php echo htmlentities($tournament_match_info["live_link"]);?>" target="_blank"><li>WATCH LIVE</li></a>
													</ul>
													<div class="title">Recent Results  <span>.  <?php echo htmlentities($tournament_match_info["score_team_1"]);?> : <?php echo htmlentities($tournament_match_info["score_team_2"]);?></span></div>
													<h2><?php echo htmlentities($tournament_match_info["title"]);?></h2>
		                                            <?php 
		                                            	$match_date = date("Y-m-d H:i:s", strtotime($tournament_match_info["mach_time"]));
														$formattedValue = date("d F Y - l, H:i A", strtotime($match_date));
		                                             ?>
													<div class="date"><?php echo($formattedValue);?></div>
												</div>
											</div>
											<?php 

											$team_id_1 = $tournament_match_info["team_1"];
											$team_id_2 = $tournament_match_info["team_2"];

											$query = "SELECT * from tournament_teams WHERE id='{$team_id_1}'";
											$tournament_teams = mysqli_query($connection, $query);
											$tournament_team_1_info = mysqli_fetch_assoc($tournament_teams);

											$query = "SELECT * from tournament_teams WHERE id='{$team_id_2}'";
											$tournament_teams = mysqli_query($connection, $query);
											$tournament_team_2_info = mysqli_fetch_assoc($tournament_teams);

											?>
											<!-- Match Column -->
											<div class="match-column col-lg-5 col-md-12 col-sm-12">
												<div class="inner-column">
													<div class="row clearfix">
														
														<!-- Match Item -->
														<div class="match-item col-lg-6 col-md-6 col-sm-12">
															<div class="inner-item">
																<div class="icon-box">
																	<span class="icon"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/tournament/<?php echo htmlentities($tournament_team_1_info["logo"]);?>" width="70"></span>
																</div>
																<p class="product"><?php echo htmlentities($tournament_team_1_info["team"]);?></p>
															</div>
														</div>
														
														<!-- Match Item -->
														<div class="match-item col-lg-6 col-md-6 col-sm-12">
															<div class="inner-item">
																<div class="icon-box">
																	<span class="icon"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/tournament/<?php echo htmlentities($tournament_team_2_info["logo"]);?>" width="70"></span>
																</div>
																<p class="product"><?php echo htmlentities($tournament_team_2_info["team"]);?></p>
															</div>
														</div>
														
													</div>
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<?php $cnt=$cnt+1; }} ?>
								
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $cnt=$cnt+1; }} ?>
	<!-- End Matches Section -->
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
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/scrollbar.js"></script>
<script src="<?php echo htmlentities($main_info["domain"]);?>/js/script.js"></script>

</body>
</html>
<?php ob_end_flush(); ?> 
<?php mysqli_close($connection); //close connection ?>