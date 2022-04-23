<!--
____________________________________________________________________________________________
|  _____                       _     _                    _____                  _         |
| / ____|                     (_)   | |                  / ____|                | |        |
|| |  __  ___ _ __   ___   ___ _  __| | ___    ___ _____| (___  _ __   ___  _ __| |_ ___   |
|| | |_ |/ _ \ '_ \ / _ \ / __| |/ _` |/ _ \  / _ \______\___ \| '_ \ / _ \| '__| __/ __|  |
|| |__| |  __/ | | | (_) | (__| | (_| |  __/ |  __/      ____) | |_) | (_) | |  | |_\__ \  |
| \_____|\___|_| |_|\___/ \___|_|\__,_|\___|  \___|     |_____/| .__/ \___/|_|   \__|___/  |
|                                                              | |                         |
|                                                              |_|C H U K z i              |
|__________________________________________________________________________________________|
 -->
<?php session_start(); // design by CHUKz!?>
<?php 
require_once('includes/connection.php');
require_once('gncadmin/includes/config.php');
$pagenum = '9';
require_once('includes/views-functions.php');
?>

<!doctype html>
<html lang="en" class="no-js">

<head>	
	<title>Schedule GEI-Inhouse Tournament 2k21</title>
	<style>
		table {
		  font-family: arial, sans-serif;
		  border-collapse: collapse;
		  width: 100%;
		}

		td, th {
		  border: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;
		}

		tr:nth-child(even) {
		  background-color: #dddddd;
		}
	</style>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<hr style="border: 1px solid red;">
<h4><b>&nbsp;&nbsp;RECENT ALL MATCHES</b></h4>

								<table class="display" style="width:100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Game Name</th>
											<th><b>Vs</b></th>
											<th>Score</th>
                                            <th>Match Date & time</th>
                                            <th>watch live</th>
										</tr>
									</thead>
									<br>
									
									<tbody>

                                    <?php $sql = "SELECT * from tournament_matches WHERE tournament='121' AND is_mach_end = '1' order by mach_time DESC";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><img src="../../images/icons/<?php echo($result->game_name);?>.png">&nbsp;&nbsp;<?php echo htmlentities($result->game_name);?></td>
											<?php  
											$team_id_1 = $result->team_1;
                                    		$team_id_2 = $result->team_2;
                                    		
											$sql = "SELECT * from tournament_teams WHERE id='{$team_id_1}'";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$result_team_1=$query->fetch(PDO::FETCH_OBJ);


											$sql = "SELECT * from tournament_teams WHERE id='{$team_id_2}'";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$result_team_2=$query->fetch(PDO::FETCH_OBJ);

											?>
											<td><?php echo htmlentities($result_team_1->team);?> <b>Vs</b> <?php echo htmlentities($result_team_2->team);?></td>
                                            <td><button type="button" class="btn btn-info btn-sm" disabled><?php echo htmlentities($result->score_team_1);?></button> : <button type="button" class="btn btn-info btn-sm" disabled><?php echo htmlentities($result->score_team_2);?></button></td>
                                            <?php 
                                            	$match_date = date("Y-m-d H:i:s", strtotime($result->mach_time));
												$formattedValue = date("d F Y - l, h:i A", strtotime($match_date));
                                             ?>

                                            <td><?php echo($formattedValue); ?></td>
                                            <td><a href="<?php echo htmlentities($result->live_link);?>" target="_blank"><button type="button" class="btn btn-danger btn-sm">● Watch Live</button></a></td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>
								<br>
</body>
</html>
<?php
$page_id = $pagenum;
$visitor_ip = $_SERVER['REMOTE_ADDR']; // stores IP address of visitor in variable
add_view($connection, $visitor_ip, $page_id);
?>
<?php $total_page_views = total_views($connection, 1); 
?>
