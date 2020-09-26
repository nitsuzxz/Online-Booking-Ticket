<?php
	include ('../../Config/db_config.php');

	if(isset($_POST['addCinema'])){
		$cinemaName = $_POST['cinemaName'];
		$cinemaLocation = $_POST['cinemaLocation'];
		$cinemaDesc = $_POST['cinemaDesc'];

		$query = "INSERT INTO cinema(cinema_name, cinema_description, cinema_location) VALUES('$cinemaName','$cinemaDesc','$cinemaLocation')";
		
		//echo $cinemaName.", ".$cinemaLocation.", ".$cinemaDesc;
		if (mysqli_query($conn, $query)) {
			//echo $query;
			header('Location: cinema.php');
		}
		else{
			echo 'ERROR'.mysqli_error($conn);

		}
	}


?>