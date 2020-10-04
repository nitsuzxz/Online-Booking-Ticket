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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
               <select onchange="enableHall()" id="cinemaSelection" name="cinemaSelection"  class="selectpicker form-control" required >
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
               <select onchange="enableMovie()" class="selectpicker form-control" id="hallSelection" name="hallSelection" disabled required>
                <option value='' required>Select Hall</option>
      				 </select>
    					</div>
  					</div>
            <div class="col-8">
  						<label for="inputRate">Movie</label>
   						<div class="form-group">
               <select onchange="enableDate()"  id="movieSelection" class="selectpicker form-control" name="movieSelection" disabled required>
                <option value='' required>Select Movie</option>
      						</select>
    					</div>
  					</div>
            <div class="col-8">
  						<label for="inputRate">Date of Showtime</label>
                <div class="input-group date" data-provide="datepicker">
                  <input onchange="checkingDate()" type="date" class="form-control" id="date" disabled required>
                <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
              </div>
           </div>
  				</div>
          <div class="col-8">
          <label for="appt">Select a time:</label>
          <input type="time" name="startTime" id="startTime" min="10" disabled  required >
          <button type="button" onclick="addTime()">Select</button>
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

    function enableHall(){

      var showtimeStatus=false;
      var showtimeData=[];
      var selectedTime=[];

      var cinemaID = document.getElementById("cinemaSelection").value;
      if(cinemaID !==""){
      
      var formData = new FormData();
      formData.append('fetchHall', cinemaID);
      $("#hallSelection option").remove();
      $.ajax({ 
           url:'showtimeFunction.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (data){
              var a=JSON.parse(data);
                $("#hallSelection").append("<option value=''>Select Hall</option>");
                for(var i=0; i<a.length; i++){
                  var hall_id=a[i].hall_id;
                  var hall_name=a[i].hall_name;
                  $("#hallSelection").append("<option value='"+hall_id+"'>"+hall_name+"</option>");
                }
              
            },
            error: function(x,e){
              alert(x+e);
        }
        });
      document.getElementById("hallSelection").disabled = false;
      
      }else{
        document.getElementById("hallSelection").disabled = true;
        document.getElementById("hallSelection").value = "";
        document.getElementById("movieSelection").disabled = true;
              document.getElementById("movieSelection").value = "";
              document.getElementById("date").disabled = true;
              document.getElementById("date").value = "";
      }
      
    }

      function enableMovie(){
        var formData = new FormData();
        var hallID = document.getElementById("hallSelection").value;

           if(hallID !==""){

              formData.append('fetchMovie', hallID);
              $("#movieSelection option").remove();

              $.ajax({ 
                   url:'showtimeFunction.php',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (data){
                      console.log("movie"+data);
                      var a=JSON.parse(data);
                $("#movieSelection").append("<option value=''>Select Movie</option>");
                for(var i=0; i<a.length; i++){
                  var movie_id=a[i].movie_id;
                  var movie_name=a[i].movie_name;
                  $("#movieSelection").append("<option value='"+movie_id+"'>"+movie_name+"</option>");
                }
                    },
                    error: function(x,e){
                      alert(x+e);
                  }
                });
              document.getElementById("movieSelection").disabled = false;
            }else{
              document.getElementById("movieSelection").disabled = true;
              document.getElementById("movieSelection").value = "";
              document.getElementById("date").disabled = true;
              document.getElementById("date").value = "";
           }
      }
      function enableDate(){
        var movie= document.getElementById("movieSelection").value;
        console.log("function" + movie);

        if(movie!=''){
          document.getElementById("date").disabled = false;
        }else{
          document.getElementById("date").disabled = true;
          document.getElementById("date").value = "";
        }

      }

      function checkingDate(){
        var date=document.getElementById("date").value;
        var hallID=document.getElementById("hallSelection").value;
        var movieID=document.getElementById("movieSelection").value;
        console.log(date);

        var formData = new FormData();

           if(hallID !=="" && movieID !=="" && date !==""){

              formData.append('hallID', hallID);
              formData.append('movieID', movieID);
              formData.append('date', date);
      
              console.log(hallID);
              console.log(movieID);
              console.log(date);

              $.ajax({ 
                   url:'showtimeFunction.php',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (data){
        
                      showtimeData=JSON.parse(data);     
                      showtimeStatus=true;
                      document.getElementById("startTime").disabled = false;
                    },
                    error: function(x,e){
                      alert(x+e);
                  }
                });
            
      
            }else{

              document.getElementById("startTime").disabled = true;

           }

      }

      function addTime(){

          var startTime= document.getElementById("startTime").value;
          selectedTime.push(startTime);

          if(showtimeStatus==true){

              for(var i=0; i<showtimeData.length; i++){

                for(var j=0; j<selectedTime; j++){
                  if(selectedTime >= showtimeData[i].aired_showtime && selectedTime <= showtimeData[i].aired_showtime ){

}

                }

       

                console.log(showtimeData[i]);

              }
  
          }else{

        } 
      } 



  </Script>

</html>

