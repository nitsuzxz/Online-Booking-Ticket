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
            <tbody id="tableContent">
              <tr>
                <th scope="row">1</th>
                <td>Start (12.00AM) End (2.00PM)</td>
                <td>
                <button type="submit" class="btn btn-outline-danger col-md-5">Remove</button>
                </td>
              </tr>
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
      var showtimeStatus=false;
      var showtimeData=[];
      var selectedTime=[];
      var startTime;

    function enableHall(){

  

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
        var formData = new FormData();

           if(hallID !=="" && movieID !=="" && date !==""){

              formData.append('hallID', hallID);
              formData.append('movieID', movieID);
              formData.append('date', date);
      
              $.ajax({ 
                   url:'showtimeFunction.php',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (data){
                      showtimeData.splice(0,showtimeData.length);
                      showtimeData=JSON.parse(data) ;     
                  
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
 
          if(showtimeStatus==true){
         
              for(var i=0; i<showtimeData.length; i++){
      
                  if(startTime >= showtimeData[i].aired_startTime && startTime <= showtimeData[i].aired_endTime ){

                    startTime='';
                    alert("Selected time clash with the existing showtime! Please enter other time");
                    
                  }else{
                    console.log("this is else");
                    //movie duration
                     var duration=showtimeData[i].movie_duration;
                     var dHours=parseInt(duration.split(".")[0]);
                     var dMins=parseInt(duration.split(".")[1]);
 
                    //inputTime
          
                     var sHours=parseInt(startTime.split(":")[0]);
                     var sMins=parseInt(startTime.split(":")[1]);

                    //generate end time
                     var hours= dHours+sHours;-6
                     var mins= dMins+sMins;

                    // handle min more than 60mins

                     var hoursCounter=0;

                     while(mins>59){
                       mins=mins-60;
                       hoursCounter++;
                     }

                    hours=hours+hoursCounter;

                     if(hours>23){
                       hours=hours-24;
                     }


                    
                     var inputTime= sHours+"."+sMins;
                     var generatedEndTime=hours+":"+mins;
                  
                     if(selectedTime.length==0){

                      selectedTime.push({start:startTime, end:generatedEndTime});
                      console.log("0000000");

                     }else{
                             
                      for(var i=0 ; i<selectedTime.length; i++){
                         //converted time to double
                          console.log("here----" +selectedTime.length+"   ini i" +i +" masa"+ selectedTime[i].start+" masa"+ selectedTime[i].end);
                       var sh= selectedTime[i].start.split(":")[0];
                       var sm=selectedTime[i].start.split(":")[1];
                       var convertedStart=sh+"."+sm;

                       var eh= selectedTime[i].start.split(":")[0];
                       var em=selectedTime[i].start.split(":")[1];
                       var convertedEnd=eh+"."+em;

                        if(inputTime>=convertedStart && inputTime<=convertedEnd){
                          console.log(convertedStart +" ........."+convertedEnd);
                          console.log("input"+inputTime);
                
                        }else{


                          console.log("b4 push");
                
                           selectedTime.push({start:startTime, end:generatedEndTime});
                     
                        }
                      }
                     }
                  }
              }
  
          }else{

            console.log("in false");

        } 
      } 



  </Script>

</html>

            
<!--       
                  //  if(selectedTime.length>1){

                  //     for (var i=0; i< selectedTime.length; i++){
                  //       console.log("inside2");
                      
                  //        var start= selectedTime[i].start;
                            
                  //        var end= selectedTime[i].end;

                  //         for(var j=1; j<selectedTime.length; j++){

                  //           console.log("view lenght="+selectedTime.length + "this j"+ j);

                  //           var compare_start= selectedTime[j].start;
                            
                  //           var compare_end= selectedTime[j].end;
                         
                  //           console.log(compare_start +">= "+ start +"   "+ compare_end+"<="+end);
                  //           if(start>compare_start && compare_end<end ){
                  //             console.log(compare_start >= start && compare_end<=end);
                  //             console.log("1 "+compare_start >= start );
                  //             console.log("2 "+start<=compare_start);
                    
                  //             selectedTime.splice(j,0);
                                   
                  //             alert("Selected time clash with other existing showtime! Please enter other time");

                  //           }

                  //         }
                  //      }
                  //  }
               
                   
                  //  for(var i=0; selectedTime.length;i++){
                  //   $("#tableContent").append("<td>"+ selectedTime[i]+"</td>");
                  // }
 -->
