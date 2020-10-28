<?php
	
  include ('./addMovie.php');

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<!-- Bootstrap CSS CDN -->
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
		<link rel="stylesheet" href="../../Asset/style.css" />
		
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    	<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    	<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

		<title>Manage Movies</title>
    	
	</head>
	
	<body>
		<div class="dashboardContainer">
			<?php include '../../Asset/sideNav.php'; ?>  
			<div  id="main" class="container">

	  			

	  		<h2>Manage Movies</h2>		

				<form class="col-8" action="./addMovie.php" method="post" enctype="multipart/form-data" style="margin: 0px 20px;">
      				<div class="form-group col-8">
        				<label for="inputName">Movie Name</label>
        				<input type="text" name="movieName" class="form-control col-12" id="inputName"  placeholder="Enter Name" value="<?php echo $movieName ?>">
      				</div>
              <div class="form-group col-8">
                <label for="inputName">Movie Duration</label>
                <input name="movieDuration" type="number" class="form-control col-12" placeholder="Enter duration in Minutes" step="1" value="<?php echo $movieDuration ?>">       
              </div>
      				<div class="form-group col-8">
        				<label for="exampleFormControlTextarea1">Synopsis</label>
        				<textarea class="form-control col-12" name="movieDesc" id="exampleFormControlTextarea1" rows="3"><?php echo $movieDesc ?></textarea>
      				</div>

    				<div class="form-group col-8">
            			Start Date: <input type=date name="movieStartDate" class="form-control" id="startDate" width="276" value="<?php echo $movieStartDate ?>" />
            			End Date: <input type="date" name="movieEndDate" class="form-control" id="endDate" width="276" value="<?php echo $movieEndDate ?>" />
        		</div>

            <div class="form-group col-8">
              <label for="inputName">Movie Price</label>
              <input name="moviePrice" type="number" class="form-control col-12" placeholder="RM 0.00" step=".10" value="<?php echo $moviePrice ?>">
            </div>

        		<div class="custom-file col-8">
      					<!--<label class="custom-file-label" for="customFile">Upload Movie Poster</label>-->
                <input type="file" name="moviePoster" class="form-control-file" id="customFile">
      					
    				</div>

    				<div class="form-group">
    					<br>
                <?php if (isset($_GET['edit'])){
                  $id = $_GET['edit'];
                  echo '<input  type="hidden" name="movieID" value="'.$id.'"></input>';
                  echo '<button name="editMovie" type="submit" class="btn btn-outline-success col-md-2 offset-md-5">Edit</button>';
                  echo "<a href='./movie.php' type='button' class='btn btn-outline-danger col-md-2 offset-md-5' >Cancel</a>";
                }
                else{
                  echo '<button name="addMovie" type="submit" class="btn btn-outline-success col-md-2 offset-md-6" margin="40%">Add Movie</button>';
                }?>
      			</div>
        </form>

        <br>
        <div class="container-fluid">
          <?php foreach ($movieList as $movie): ?>
            <?php $movieID = $movie['movie_id'];?>
            <?php $moviePicDir = $movie['pic_location']; ?>
            <div class="card">
        <div class="row no-gutters">
            <div class="col-auto">
                <img class="img-fluid" src="<?php echo "./".$movie['pic_location'] ?>" alt="">
            </div>
            <div class="col">
                <div class="card-block px-2">
                    <h4 class="card-title"><b><?php echo $movie['movie_name']; ?></b></h4>
                    <p class="card-text"><b>Details</b></p>
                    <h6 class="card-subtitle mb-2 text-muted" style="">Start: <?php echo $movie['movie_date_start_aired']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted" style="">End: <?php echo $movie['movie_date_end_aired']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Duration  : <?php echo $movie['movie_duration']; ?>hours</h6>
                    <h6 class="card-subtitle mb-2 text-muted">Price     : RM <?php echo $movie['movie_price']; ?></h6>
          
                <h6><b>Description</b></h6>
                <p class="card-text"><?php echo $movie['movie_desciption']; ?></p>

                <a type="button" href="./movie.php?edit=<?php echo $movieID; ?>" class="btn btn-outline-success col-md-5">Edit</a>
                  &nbsp;
                <a type="button" href="./movie.php?delete=<?php echo $movieID; ?>&posterDir=<?php echo $moviePicDir; ?>" class="btn btn-outline-danger col-md-5">Delete</a>
               
                </div>
            </div>
        </div>
    </div>
            
   
          <?php endforeach; ?>
        </div>
			
      </div>

		</div>

  </body>

</html>