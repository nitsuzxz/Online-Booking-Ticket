<?php
	session_start();
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
        				<input type="text" name="movieName" class="form-control col-12" id="inputName"  placeholder="Enter Name">
      				</div>

      				<div class="form-group col-8">
        				<label for="exampleFormControlTextarea1">Synopsis</label>
        				<textarea class="form-control col-12" name="movieDesc" id="exampleFormControlTextarea1" rows="3"> </textarea>
      				</div>

    				<div class="form-group col-8">
            			Start Date: <input type=date name="movieStartDate" class="form-control" id="startDate" width="276" />
            			End Date: <input type="date" name="movieEndDate" class="form-control" id="endDate" width="276" />
        		</div>

        		<div class="custom-file col-8">
      					<label class="custom-file-label" for="customFile">Upload Movie Poster</label>
                <input type="file" name="moviePoster" class="custom-file-input" id="customFile">
      					
    				</div>

    				<div class="form-group">
    					<br>
              <button name="addMovie" type="submit" class="btn btn-outline-success col-md-2 offset-md-6" margin="40%">Add</button>
      			</div>
        </form>

        <br>

       <form class="row" style="margin: 0px 20px;">

        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="./ae.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <p class="card-text">ExampleExampleExampleExampleExampleExampleExampleExampleExampleExampleExampleExampleExampleExampleExampleExample</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
          </div>
        </div>

        <p>&nbsp;</p>
      </form>

			</div>

		</div>

  </body>

</html>