<?php

	$cinemaID = '';
	$hallName = '';
	$hallType = '';
	$hallPrice = '';
	$hallRow = '';
	$hallSeatsPerRow = '';

	$query = 'SELECT * FROM hall ORDER BY hall_cinema_id ASC';

  	$res = mysqli_query($conn, $query);
  	$hallList = mysqli_fetch_all($res, MYSQLI_ASSOC);

	if (isset($_POST['addHall'])) {
		//echo $_POST['cineID'];
		$cinemaID = $_POST['cinemaID'];
		$hallName = $_POST['hallName'];
		$hallType = $_POST['hallType'];
		$hallPrice = $_POST['hallPrice'];
		$hallRow = $_POST['hallRow'];
		$hallSeatsPerRow = $_POST['hallSeatsPerRow'];

		$query = "INSERT INTO hall(hall_name, hall_cinema_id, hall_type, hall_price, seat_row, seat_number) VALUES ('$hallName', '$cinemaID', '$hallType', '$hallPrice', '$hallRow', '$hallSeatsPerRow')";
		echo $query;
		if (mysqli_query($conn, $query)) {
			header('Location: hall.php');
		}
		else{
			echo "Query x jadi";
		}
		
		//echo $query;
				
	}

	if (isset($_GET['delete'])){
		$query = "DELETE FROM hall WHERE hall_id = {$_GET['delete']}";
		mysqli_query($conn, $query);
		header('Location: hall.php');
	}

	if (isset($_GET['edit'])){
		$query = "SELECT * FROM hall WHERE hall_id = {$_GET['edit']}";
		$res = mysqli_query($conn, $query);
		$hallInst = mysqli_fetch_array($res);

		$cinemaID = $hallInst['hall_cinema_id'];
		$hallName = $hallInst['hall_name'];
		$hallType = $hallInst['hall_type'];
		$hallPrice = $hallInst['hall_price'];
		$hallRow = $hallInst['seat_row'];
		$hallSeatsPerRow = $hallInst['seat_number'];
	}

	if (isset($_POST['editHall'])){
		$hallID = $_POST['hallID'];
		$cinemaID = $_POST['cinemaID'];
		$hallName = $_POST['hallName'];
		$hallType = $_POST['hallType'];
		$hallPrice = $_POST['hallPrice'];
		$hallRow = $_POST['hallRow'];
		$hallSeatsPerRow = $_POST['hallSeatsPerRow'];

		$query = "UPDATE hall SET hall_cinema_id = '$cinemaID', hall_name = '$hallName', hall_type = '$hallType', hall_price = '$hallPrice', seat_row = '$hallRow', seat_number = '$hallSeatsPerRow' WHERE hall_id = '$hallID'";

		mysqli_query($conn, $query);
		header('Location: hall.php');
	}
?>