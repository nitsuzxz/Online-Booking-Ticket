<?php
  include ('../../Config/db_config.php');
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
		<title>Manage Halls</title>
	</head>

	<body>
		
		<div class="dashboardContainer">
			<?php include '../../Asset/sideNav.php'; ?>  
			
			<div id="main">

				<h2>Manage Showtime</h2>

				<form class="col-8" style="margin: 0px 20px;">
						
  					<div class="col-8">
  						<label for="inputRate">Cinema</label>
   						<div class="form-group">
               <select  class="selectpicker form-control">
                <option value='' required>Select Cinema</option>
                  <?php
                  
                  $query="SELECT cinema_id, cinema_name FROM cinema ORDER BY cinema_name ASC";
                  $res = mysqli_query($conn, $query);

                  $cinemaList = mysqli_fetch_all($res, MYSQLI_ASSOC);
                  foreach($cinemaList as $listof ){
                    echo '<option value="'.$listof['cinema_id'].'">'.$listof['cinema_name'].'</option>';
                  }
                  ?>
 
      						</select>
    					</div>
  					</div>
            <div class="col-8">
  						<label for="inputRate">Hall</label>
   						<div class="form-group">
               <select  class="selectpicker form-control">
                <option value='' required>Select Hall</option>
                  <?php
                  
                  $query="SELECT hall_id, hall_name FROM hall ORDER BY hall_name ASC";
                  $res = mysqli_query($conn, $query);

                  $hallList = mysqli_fetch_all($res, MYSQLI_ASSOC);
                  foreach($hallList as $listof ){
                    echo '<option value="'.$listof['hall_id'].'">'.$listof['hall_name'].'</option>';
                  }
                  ?>
 
      						</select>
    					</div>
  					</div>
            <div class="col-8">
  						<label for="inputRate">Movie</label>
   						<div class="form-group">
               <select  class="selectpicker form-control">
                <option value='' required>Select Movie</option>
                  <?php
                  
                  $query="SELECT hall_id, hall_name FROM hall ORDER BY hall_name ASC";
                  $res = mysqli_query($conn, $query);

                  $movieList = mysqli_fetch_all($res, MYSQLI_ASSOC);
                  foreach($movieList as $listof ){
                    echo '<option value="'.$listof['movie_id'].'">'.$listof['movie_name'].'</option>';
                  }
                  ?>
 
      						</select>
    					</div>
  					</div>
            <div class="col-8">
  						<label for="inputRate">Date of Showtime</label>
                <div class="input-group date" data-provide="datepicker">
                  <input type="date" class="form-control" onchange= >
                <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
              </div>
           </div>
  				</div>
          <div class="col-8">
          <label for="appt">Select a time:</label>
          <input type="time" name="startTime" id="startTime" min="10"  required >
          <a type="button" onclick="addTime()">Select</a>
          </div>

          <table class="table w-75 p-3" style="margin: 0px 20px;">

            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Start (12.00AM) End (2.00PM)</td>
                <td>
                <button type="submit" class="btn btn-outline-danger col-md-5">Remove</button>
                </td>
              </tr>
              <tr>
          </tbody>
        </table>
       


   					<button type="submit" class="btn btn-outline-success col-md-2 offset-md-5">Add</button>

				</form>

        <p></p>

        <table class="table w-75 p-3" style="margin: 0px 20px;">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Cinema</th>
                <th scope="col">Hall</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Layout</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Place 1</td>
                <td>*</td>
                <td>?</td>
                <td>RMXX</td>
                <td>X</td>
                <td><button type="submit" class="btn btn-outline-success col-md-5">Edit</button>
                &nbsp;
                <button type="submit" class="btn btn-outline-danger col-md-5">Delete</button>
                </td>
              </tr>
              <tr>
                <th scope="row">2</th>
                  <td>Place 2</td>
                  <td>*</td>
                  <td>?</td>
                  <td>RMXX</td>
                  <td>X</td>
                  <td><button type="submit" class="btn btn-outline-success col-md-5">Edit</button>
                &nbsp;
                <button type="submit" class="btn btn-outline-danger col-md-5">Delete</button>
                </td>
              </tr>
              <tr>
                <th scope="row">3</th>
                  <td>Place 3</td>
                  <td>*</td>
                  <td>?</td>
                  <td>RMXX</td>
                  <td>X</td>
                  <td><button type="submit" class="btn btn-outline-success col-md-5">Edit</button>
                &nbsp;
                <button type="submit" class="btn btn-outline-danger col-md-5">Delete</button>
                </td>
              </tr>
          </tbody>
        </table>

			</div>

		</div>

	</body>

  <Script>
      function addTime(){
        console.log("this is add Time");
        var time = document.getElementById("startTime").value;
        console.log("this is Time"+ time);
      }

  </Script>

</html>