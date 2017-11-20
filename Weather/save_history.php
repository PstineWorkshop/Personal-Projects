<?php
	 require_once ('mysqli_connect.php');
	 
	 
	
	 $id = $_POST['id'];
	 $lat = $_POST['lat'];
	 $lng= $_POST['lng'];
	 $date = $_POST['date'];
	 $location = $_POST['logLocation'];

	 $sql = "INSERT INTO history(user_id,lat,lng,logDate,logLocation)
	 		VALUES('$id', '$lat', ' $lng','$date',' $location')";

    if(mysqli_query($dbc,$sql)){
    			echo json_encode("works");
    		}
    		else{
    			echo ("error: ".mysqli_error($dbc));
    		}
?>