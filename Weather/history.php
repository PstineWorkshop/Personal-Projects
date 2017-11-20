
<?php  
ob_start();
	include ('includes/session.php');
	include ('includes/header.php');

	require_once ('mysqli_connect.php');
		$user =($_SESSION['user_id']);
		echo '<h1 style="text-align:center;"> History </h1>';

		$query = "SELECT h.logLocation,h.lat,h.lng,h.logDate,h.searchDate FROM history h JOIN users u ON u.user_id=h.user_id WHERE u.user_id=$user";
		$result = mysqli_query ($dbc, $query);
		$num = mysqli_num_rows($result);
			if ($num > 0){
			 	echo '<table class="table "align="center" cellspacing="3" cellpadding="3" width="40%">
				<tr>
					<td class="info" align="left"><b>Searched Location</b></td>
					<td class="info" align="left"><b>Latitude</b></td>
					<td class="info" align="left"><b>Longitude</b></td>
					<td class="info" align="left"><b>Date Searched For</b></td>
					<td class="info" align="left"><b>Date of the Searched</b></td>  
				</tr>';

		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo '<tr>
				<td class="info" align="left">' . $row['logLocation'] . '</td>
				<td class="info" align="left">' . $row['lat'] . '</td>
				<td class="info" align="left">' . $row['lng'] . '</td>
				<td class="info" align="left">' . $row['logDate'] . '</td>
				<td class="info" align="left">' . $row['searchDate'] . '</td>

				</tr>';
		
		}

	
	

				echo '</table>';
	}else{
			 echo 'The user has not logged in any history';
	     }
?>

<?php
 include ('includes/footer.html');
?>


