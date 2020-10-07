<?php
  include ('../../Config/db_config.php');

  $query = 'SELECT * FROM cinema ORDER BY cinema_id ASC';

  $res = mysqli_query($conn, $query);
  $cinemaList = mysqli_fetch_all($res, MYSQLI_ASSOC);
  $cinemaName = '';
  $cinemaLocation = '';
  $cinemaDesc = '';

	if(isset($_POST['addCinema'])){
		$cinemaName = $_POST['cinemaName'];
		$cinemaLocation = $_POST['cinemaLocation'];
		$cinemaDesc = $_POST['cinemaDesc'];

		$query = "INSERT INTO cinema(
    cinema_name, 
    cinema_description, 
    cinema_location) 
    VALUES(
    '$cinemaName',
    '$cinemaDesc',
    '$cinemaLocation')";
		
		//echo $cinemaName.", ".$cinemaLocation.", ".$cinemaDesc;
		if (mysqli_query($conn, $query)) {
			//echo $query;
			header('Location: cinema.php');
		}
		else{
			echo 'ERROR'.mysqli_error($conn);
		}
	}
  if (isset($_GET['delete'])) {
    $query = "DELETE FROM cinema WHERE cinema_id = {$_GET['delete']}";
    mysqli_query($conn,$query);
    header('Location: cinema.php');
  }

  if (isset($_GET['edit'])){
    $query = "SELECT * FROM cinema WHERE cinema_id = {$_GET['edit']}";
    $res = mysqli_query($conn, $query);
    $cinemaInst = mysqli_fetch_array($res);

    $cinemaName = $cinemaInst['cinema_name'];
    $cinemaLocation = $cinemaInst['cinema_location'];
    $cinemaDesc = $cinemaInst['cinema_description'];
  }

  if (isset($_POST['editCinema'])){
    $cinemaID= $_POST['cinID']; 
    $cinemaName = $_POST['cinemaName'];
    $cinemaLocation = $_POST['cinemaLocation'];
    $cinemaDesc = $_POST['cinemaDesc'];

    $query = "UPDATE cinema SET 
      cinema_name = '$cinemaName', 
      cinema_location ='$cinemaLocation', 
      cinema_description ='$cinemaDesc' 
    WHERE cinema_id = '$cinemaID'";
    
    mysqli_query($conn, $query);
	  header('Location: cinema.php');
  }
  // Free Result
  mysqli_free_result($res);

  // Close Connection
  mysqli_close($conn);


?>