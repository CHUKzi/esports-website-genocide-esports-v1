<header class="main-header">
        <!-- Header Top -->
        <div class="header-top">
            <div class="auto-container clearfix">

                <div class="top-left clearfix">
                    <ul class="info-list">
                        <?php
                        // wish design by CHUKz!
                        date_default_timezone_set('asia/colombo');

                        $Hour = date('G');

                        if ( $Hour >= 00 && $Hour <= 11 ) {
                            echo '<li>Good Morning, Welcome to Genocide e-Sports</li>';
                        } else if ( $Hour >= 12 && $Hour <= 16 ) {
                            echo '<li>Good Afternoon, Welcome to Genocide e-Sports</li>';
                        } else if ( $Hour >= 17 || $Hour <= 23 ) {
                            echo '<li>Good Evening, Welcome to Genocide e-Sports</li>';
                        }
                        ?>
                    </ul>
                </div>

                <div class="top-right">
                    <ul class="social-icons">
						<?php include('includes/social-icons.php'); ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Header Upper -->
        <div class="header-upper">
            <div class="inner-container">
                <div class="auto-container clearfix">
                    <!--Logo-->
                    <div class="logo-outer">
                        <div class="logo"><a href="<?php echo htmlentities($main_info["domain"]);?>"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/<?php echo htmlentities($main_info["logo"]);?>" alt="" title="<?php echo htmlentities($main_info["title"]);?>"></a></div>
                    </div>

                    <!--Nav Box-->
                    <div class="nav-outer clearfix">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>

                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix pull-left">
                                    <li class="<?php if ($page == 1) {echo "current";} ?> dropdown"><a href="<?php echo htmlentities($main_info["domain"]);?>">Home</a>
                                    </li>
									<li class="<?php if ($page == 2) {echo "current";} ?> dropdown"><a href="<?php echo htmlentities($main_info["domain"]);?>/about">Pages</a>
                                        <ul>
                                            <li><a href="<?php echo htmlentities($main_info["domain"]);?>/about">About Clan</a></li>
											<li><a href="<?php echo htmlentities($main_info["domain"]);?>/members">Clan Members</a></li>
                                        </ul>
                                    </li>
                                    <li class="<?php if ($page == 3) {echo "current";} ?>"><a href="<?php echo htmlentities($main_info["domain"]);?>/gallery">Gallery</a></li>
                                </ul>

                                <ul class="navigation pull-right clearfix">
                                    <li class="<?php if ($page == 4) {echo "current";} ?> dropdown"><a href="<?php echo htmlentities($main_info["domain"]);?>/matches">Matches</a>
                                    </li>
                                    <li class="<?php if ($page == 5) {echo "current";} ?> dropdown"><a href="<?php echo htmlentities($main_info["domain"]);?>/blogs">Blogs</a>
                                    </li>
                                    <li class="<?php if ($page == 6) {echo "current";} ?>"><a href="<?php echo htmlentities($main_info["domain"]);?>/contact">Contacts</a></li>
                                </ul>
                            </div>
                        </nav>
                        <!-- Main Menu End-->
                    </div>
                </div>
            </div>
        </div>
        <!--End Header Upper-->

        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container clearfix">
                <!--Logo-->
                <div class="logo pull-left">
                    <a href="<?php echo htmlentities($main_info["domain"]);?>" title=""><img src="<?php echo htmlentities($main_info["domain"]);?>/images/<?php echo htmlentities($main_info["logo_f"]);?>" alt="" title=""></a>
                </div>
                <!--Right Col-->
                <div class="pull-right">
                    <!-- Main Menu -->
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav><!-- Main Menu End-->
                </div>
            </div>
            <?php if ($cmt_poup == 1) {include('includes/cmt-msg.php');} ?>
            <?php if ($contact_poup == 1) {include('includes/contact-msg.php');} ?>
		<?php include('includes/subscribe-msg.php'); ?>
<!--<script type="text/javascript">
function PopUp(hideOrshow) {
    if (hideOrshow == 'hide') document.getElementById('ac-wrapper').style.display = "none";
    else document.getElementById('ac-wrapper').removeAttribute('style');
}
window.onload = function () {
    setTimeout(function () {
        PopUp('show');
    }, 5000);
}
</script>-->

<!--<div id="ac-wrapper" style='display:none'>
<div class="alert alert-success alert-dismissible" tabindex="-1">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
</div>
</div>-->
        </div><!-- End Sticky Menu -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon flaticon-close"></span></div>
            
            <nav class="menu-box">
                <div class="nav-logo"><a href="<?php echo htmlentities($main_info["domain"]);?>/"><img src="<?php echo htmlentities($main_info["domain"]);?>/images/<?php echo htmlentities($main_info["logo_f"]);?>" alt="" title=""></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
				<!--Social Links-->
				<div class="social-links">
					<ul class="clearfix">
						<?php include('includes/social-icons.php'); ?>
					</ul>
                </div>
            </nav>
        </div><!-- End Mobile Menu -->
    </header>