<?php 
	
	include ('../../Config/db_config.php');
	
	$movieName = '';
	$movieDuration = '';
	$movieDesc = '';
	$movieStartDate = '';
	$movieEndDate = '';
	$moviePrice = '';
	$moviePoster = '';
	$check = '';
	$uploadOk = '';
	$query = '';

	$query = 'SELECT * FROM movie ORDER BY movie_id ASC';

  	$res = mysqli_query($conn, $query);
  	$movieList = mysqli_fetch_all($res, MYSQLI_ASSOC);

	

	if(isset($_POST['addMovie'])){
		
		//directory to upload image
		$target_dir = "../../Asset/img/";
		//image to be uploaded
		$target_file = $target_dir . basename($_FILES["moviePoster"]["name"]);
		//1 = uploadable, 0 = not uploadable
		$uploadOk = 1;
		//get file extension
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		//get size of image by using php core function "getimagesize()"
		$check = getimagesize($_FILES["moviePoster"]["tmp_name"]);
  		
  		if($check !== false) {
    		echo "File is an image - " . $check["mime"] . ".";
    		$uploadOk = 1;
  		} else {
    		echo "File is not an image.";
    		$uploadOk = 0;
  		}
	
		//if file already exists
  		if (file_exists($target_file)) {
  			echo "Sorry, file already exists.";
  			$uploadOk = 0;
		}
		
		//check file size if greater than 500KB
		if ($_FILES["moviePoster"]["size"] > 500000) {
  			echo "Sorry, your file is too large.";
  			$uploadOk = 0;
		}
		
		// only allows users to upload JPG, JPEG, PNG, and GIF files.
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
  			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  			$uploadOk = 0;
		}
		
		//file rejected
		if ($uploadOk == 0) {
  			echo "Sorry, your file was not uploaded.";
		} 
		// if everything is ok, try to upload file
		else {
			//upload successful
  			if (move_uploaded_file($_FILES["moviePoster"]["tmp_name"], $target_file)){
    			$movieName = $_POST['movieName'];
    			//calculate movie duration in hours
				$movieDuration = (($_POST['movieDuration'])/60);
				$movieDuration = number_format($movieDuration,2);
				
				$movieDesc = $_POST['movieDesc'];
				$movieStartDate = $_POST['movieStartDate'];
				$movieEndDate = $_POST['movieEndDate'];
				$moviePrice = $_POST['moviePrice'];

				$query = "INSERT INTO movie (movie_name, movie_duration, movie_desciption, movie_date_start_aired, movie_date_end_aired, movie_price, pic_location) VALUES ('$movieName','$movieDuration', '$movieDesc', '$movieStartDate', '$movieEndDate', '$moviePrice', '$target_file')";

				//echo $query;
				if (mysqli_query($conn, $query)) {
					header('Location: movie.php');
				}
				else{
					echo "Query x jadi";
				}	


  			} 
			//error in uploading file
  			else {
    			echo "Sorry, there was an error uploading your file.";
  			}
		}

	}

	

?>