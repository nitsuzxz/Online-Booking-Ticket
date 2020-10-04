<?php 
	include ('../../Config/db_config.php');


	$movieName = '';
	$movieDesc = '';
	$movieStartDate = '';
	$movieEndDate = '';
	$moviePoster = '';
	$check = '';
	$uploadOk = '';

	$target_dir = "../../Asset/img/";
	$target_file = $target_dir . basename($_FILES["moviePoster"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	if(isset($_POST['addMovie'])){
		//echo "Added movie";
		$movieName = $_POST['movieName'];
		$movieDesc = $_POST['movieDesc'];
		$movieStartDate = $_POST['movieStartDate'];
		
		$check = getimagesize($_FILES["moviePoster"]["tmp_name"]);
  		
  		if($check !== false) {
    		echo "File is an image - " . $check["mime"] . ".";
    		$uploadOk = 1;
  		} else {
    		echo "File is not an image.";
    		$uploadOk = 0;
  		}

  		if (file_exists($target_file)) {
  			echo "Sorry, file already exists.";
  			$uploadOk = 0;
		}

		if ($_FILES["moviePoster"]["size"] > 500000) {
  			echo "Sorry, your file is too large.";
  			$uploadOk = 0;
		}

		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
  			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
  			echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
		} else {
  			if (move_uploaded_file($_FILES["moviePoster"]["tmp_name"], $target_file)) {
    			echo "The file ". htmlspecialchars( basename( $_FILES["moviePoster"]["name"])). " has been uploaded.";
  			} else {
    			echo "Sorry, there was an error uploading your file.";
  			}
		}

	}

	

?>