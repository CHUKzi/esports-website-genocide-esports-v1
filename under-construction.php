<?php 
require_once('includes/connection.php');
include('includes/minifier.php');

$query = "SELECT * FROM detective WHERE id=1";
$admin_ip = mysqli_query($connection, $query);
$is_active_info = mysqli_fetch_assoc($admin_ip);

$query = "SELECT * FROM notification WHERE id=1";
$on_or_off = mysqli_query($connection, $query);
$is_on_or_off = mysqli_fetch_assoc($on_or_off);

$query = "SELECT * FROM main WHERE id=1";
$main = mysqli_query($connection, $query);
$main_info = mysqli_fetch_assoc($main);

$myip = $_SERVER['REMOTE_ADDR'];
$dbip = $is_active_info["list"];
$admin_ip = '';

if($is_on_or_off["is_active"] == 1){

} else {
    header("Location: index.php");
}
if($myip == $dbip){
    header("Location: index.php");
} else {
    
}
?>
<!doctype html>
<html lang="en">
<html>
<head>

    <title></title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo htmlentities($main_info["domain"]);?>/images/<?php echo htmlentities($main_info["icon"]);?>">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}
</style>
</head>
<body>
<center>
    <br>
    <img src="<?php echo htmlentities($main_info["domain"]);?>/images/gnc-comming-soon.png" width="250">
    <h1 style="font-size: 45px">This website is currently under construction</h1>
    <p>IP : <?php $myip = $_SERVER['REMOTE_ADDR']; echo $myip; ?></p>
</center>
<footer>
<hr>
	<center>
<img src="<?php echo htmlentities($main_info["domain"]);?>/images/<?php echo htmlentities($main_info["logo"]);?>" alt="">
		<p>Alex Lanka Developers</p>
	</center>
</footer>
</body>
</html>
<?php ob_end_flush(); ?> 