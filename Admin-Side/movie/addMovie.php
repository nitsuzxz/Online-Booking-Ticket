<?php 
	
	include ('../../Config/db_config.php');
	
	$movieName = '';
	$movieDuration = '';
	$movieDesc = '';
	$movieStartDate = '';
	$movieEndDate = '';
	$moviePrice = '';
	$moviePoster = '';
	$movieStatus = '';
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
		$target_file = basename($_FILES["moviePoster"]["name"]);
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

				//get current date
				$currentDate = date("Y-m-d");
				//upcoming
			    if($currentDate < $movieStartDate){
			    	$movieStatus = 'upcoming';
			    }
				
			    //airing
			    else if($currentDate >= $movieStartDate && $currentDate <= $movieEndDate){
			        $movieStatus = 'airing';
			    }
			    
			    //finished
			    else if($currentDate > $movieEndDate){
					$movieStatus = 'finished';
			    }

				$query = "INSERT INTO movie (
				movie_name, 
				movie_duration, 
				movie_desciption, 
				movie_date_start_aired, 
				movie_date_end_aired, 
				movie_price, 
				pic_location,
				movie_status) 
				VALUES (
				'$movieName',
				'$movieDuration',
				'$movieDesc',
				'$movieStartDate', 
				'$movieEndDate', 
				'$moviePrice', 
				'$target_file',
				'$movieStatus')";

				//echo $query;
				if (mysqli_query($conn, $query)) {
					header('Location: movie.php');
				}
				else{
					echo "Query x jadi"."<br>";
					echo $query;
				}	


  			} 
			//error in uploading file
  			else {
  				unlink($_GET['posterDir']);
    			echo "Sorry, there was an error uploading your file.";
  			}
		}

	}

	//delete movie
	if (isset($_GET['delete'])){
		//delete movie poster
		unlink($_GET['posterDir']);
		//query to delete
		$query = "DELETE FROM movie WHERE movie_id = {$_GET['delete']}";
		mysqli_query($conn, $query);
		header('Location: movie.php');
	}

	if (isset($_GET['edit'])){
	    $query = "SELECT * FROM movie WHERE movie_id = {$_GET['edit']}";
	    $res = mysqli_query($conn, $query);
	    $movieInst = mysqli_fetch_array($res);

	    $movieName = $movieInst['movie_name'];
	    $movieDuration = $movieInst['movie_duration'];
	    $movieDesc = $movieInst['movie_desciption'];
		$movieStartDate = $movieInst['movie_date_start_aired'];
	    $movieEndDate = $movieInst['movie_date_end_aired'];
	    $moviePrice = $movieInst['movie_price'];
	    
  	}

  	if (isset($_POST['editMovie'])) {
  		$movieID = $_POST['movieID'];
  		$movieName = $_POST['movieName'];
  		$movieDuration = $_POST['movieDuration'];
	    $movieDesc = $_POST['movieDesc'];
		$movieStartDate = $_POST['movieStartDate'];
	    $movieEndDate = $_POST['movieEndDate'];
	    $moviePrice = $_POST['moviePrice'];
	    
	    $query = "UPDATE movie SET 
	    	movie_name = '$movieName', 
	    	movie_duration = '$movieDuration', 
	    	movie_desciption = '$movieDesc', 
	    	movie_date_start_aired = '$movieStartDate', 
	    	movie_date_end_aired = '$movieEndDate', 
	    	movie_price = '$moviePrice' 
	    WHERE movie_id = '$movieID'";
	   	
	   	mysqli_query($conn, $query);
	   	header('Location: movie.php');
  	}

	

?>