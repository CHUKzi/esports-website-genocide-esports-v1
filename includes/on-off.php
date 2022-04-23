<?php

$query = "SELECT * FROM detective WHERE id=1";
$admins_ip = mysqli_query($connection, $query);
$is_active_info = mysqli_fetch_assoc($admins_ip);

$query = "SELECT * FROM notification WHERE id=1";
$on_or_off = mysqli_query($connection, $query);
$is_on_or_off = mysqli_fetch_assoc($on_or_off);

$myip = $_SERVER['REMOTE_ADDR'];
$dbip = $is_active_info["list"];
$admin_ip = '';

if($is_on_or_off["is_active"] == 0){

} elseif ($myip == $dbip) {
	$admin_ip = '<i class="fa fa-user-secret" style="color:red"></i><li>Hellow admin !!</li>';
} else {
	$query = "SELECT * FROM main WHERE id=1";
	$main = mysqli_query($connection, $query);
	$main_info = mysqli_fetch_assoc($main);
    header('Location: ' . $main_info['domain'] .  '/under-construction');
}
?>