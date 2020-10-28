<?php
  include './showtimeFunction.php';
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

          <table class="table w-75 p-3" style="margin: 0px 20px;"  id="t_selected">
            <tbody>
            <tr>

          </tbody>
        </table>
       


   					<button type="button" class="btn btn-outline-success col-md-2 offset-md-5" onclick="insertData()">Add</button>

				</form>

        <p></p>

        <table class="table w-75 p-3" style="margin: 0px 20px;">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Movie</th>
                <th scope="col">Air Date</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
                <th scope="col">Cinema</th>
                <th scope="col">Hall</th>
                <th scope="col" style="text-align: center;">Options</th>
              </tr>
            </thead>
            <tbody>

              <?php $i=1; foreach($showtimeList as $showTimeItem) : ?>  
                <tr>
                  <?php $showTimeID = $showTimeItem['aired_id']?>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $showTimeItem['movie_name']; ?></td>
                  <td><?php echo $showTimeItem['aired_date']; ?></td>
                  <td><?php echo $showTimeItem['aired_startTime']; ?></td>
                  <td><?php echo $showTimeItem['aired_endTime']; ?></td>
                  <td><?php echo $showTimeItem['cinema_name']; ?></td>
                  <td><?php echo $showTimeItem['hall_name']; ?></td>
                  <td>
                    <a type="button" href="./showtime.php?delete=<?php echo $showTimeID; ?>" class="btn btn-outline-danger">Delete</a>
                  </td>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

			</div>

		</div>

	</body>

  <Script>
      var showtimeStatus=false;
      var showtimeData=[];
      var selectedTime=[];
      var seat=[];
      var startTime;
      var duration;

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

                seat=[];

                for(var i=0; i<a.length; i++){
                  var hall_id=a[i].hall_id;
                  var hall_name=a[i].hall_name;
                  var seat_row=a[i].seat_row;
                  var seat_number=a[i].seat_number;


                  seat.push({"seat_row":seat_row, "seat_number":seat_number});

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
                      showtimeStatus=false;
             
                      if(showtimeData.length==0){
                        console.log("1"+ showtimeStatus);
                     }else{
                        
                       showtimeStatus=true;
                       console.log("2"+ showtimeStatus);
                     }
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
          console.log("select"+startTime);
          var existingTime=0;
          
          if(startTime!=""){
              console.log("showtimeStatus"+ showtimeStatus);
            if(showtimeStatus==true){
         
         for(var i=0; i<showtimeData.length; i++){
            console.log('s'+showtimeData[i].aired_startTime);
             if(startTime >= showtimeData[i].aired_startTime && startTime <= showtimeData[i].aired_endTime ){

               startTime='';
               alert("Selected time clash with the existing showtime! Please enter other time");
               
             }else{
       
               //movie duration
                var duration=showtimeData[i].movie_duration;
                var dHours=parseInt(duration.split(".")[0]);
                var dMins=parseInt(duration.split(".")[1]);
  
               
                if(isNaN(dMins)){
                  dMins=0;
                }

               //inputTime
     
                var sHours=parseInt(startTime.split(":")[0]);
                var sMins=parseInt(startTime.split(":")[1]);

               //generate end time
                var hours= dHours+sHours;
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

                 selectedTime.push({"start":startTime, "end":generatedEndTime});
    
                }else{
                 
                 //checking existing array

                 for(var j=0 ; j<selectedTime.length; j++){
                    //converted time to double
                   //start time
                  var sh= selectedTime[j].start.split(":")[0];
                  var sm=selectedTime[j].start.split(":")[1];
                  var convertedStart=sh+"."+sm;
                     //end time
                  var eh= selectedTime[j].end.split(":")[0];
                  var em=selectedTime[j].end.split(":")[1];
                  var convertedEnd=eh+"."+em;

                   if(inputTime>=convertedStart && inputTime<=convertedEnd){

                     existingTime++;
                     alert("Selected time clash with the existing showtime! Please enter other time");
 
                   }
                   
                   if(j==selectedTime.length-1){
                
                     if(existingTime==0){
       
                       selectedTime.push({"start":startTime, "end":generatedEndTime});
                       break;

                     }
                 }
               }
             }
           }
           
         }

         displayTable();

     }else{

        var movieID=document.getElementById("movieSelection").value;
        var formData = new FormData();

              formData.append('mId', movieID);
  
      
              $.ajax({ 
                   url:'showtimeFunction.php',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (data){
                      var m_duration=JSON.parse(data) ;

                      duration=m_duration[0].movie_duration;
                                     //movie duration
                console.log("this is duration"+duration);
                var dHours=parseInt(duration.split(".")[0]);
                var dMins=parseInt(duration.split(".")[1]);
  
               
                if(isNaN(dMins)){
                  dMins=0;
                }

               //inputTime
     
                var sHours=parseInt(startTime.split(":")[0]);
                var sMins=parseInt(startTime.split(":")[1]);

               //generate end time
                var hours= dHours+sHours;
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
                  console.log("no array");
                 selectedTime.push({"start":startTime, "end":generatedEndTime});
                 console.log("select in false"+ selectedTime[0].start);
    
                }else{
                  console.log("check array2");
                 //checking existing array

                 for(var j=0 ; j<selectedTime.length; j++){
                    //converted time to double
                   //start time
                  var sh= selectedTime[j].start.split(":")[0];
                  var sm=selectedTime[j].start.split(":")[1];
                  var convertedStart=sh+"."+sm;
                     //end time
                  var eh= selectedTime[j].end.split(":")[0];
                  var em=selectedTime[j].end.split(":")[1];
                  var convertedEnd=eh+"."+em;
                  
                  console.log("nonexisting... input:"+inputTime);
                  console.log("nonexisting... convertedStart:"+convertedStart);
                  console.log("nonexisting... convertedEnd:"+convertedEnd);

                   if(inputTime>=convertedStart && inputTime<=convertedEnd){

                     existingTime++;
                     alert("Selected time clash with the existing showtime! Please enter other time");
 
                   }
                   
                   if(j==selectedTime.length-1){
                
                     if(existingTime==0){
       
                       selectedTime.push({"start":startTime, "end":generatedEndTime});
                       break;

                     }
                 }
               }
             }
             displayTable();
                    
                    },
                    error: function(x,e){
                      alert(x+e);
                  }
                });
       


   } 
          }else{
            alert("Please enter showtime!")
          }
      } 

      function displayTable(){

        $("#t_selected tbody tr").remove();
              for(var i=0; i<selectedTime.length; i++){

                var td= " <tr> <th scope='row'>"+ (i+1)+" </th> <td>"+ selectedTime[i].start+"</td> <td>"+ selectedTime[i].end+"</td> <td><button type='button' class='btn btn-outline-danger col-md-5' onclick='removedata("+ i+")'> remove</button></td></tr>";
                $("#t_selected tbody").append(td);
              }
      }

      function removedata(i){

        selectedTime.splice(i,1)
        displayTable();

      }

      function insertData(){

      var formData = new FormData();
      var movieID=document.getElementById("movieSelection").value;
      var hallID=document.getElementById("hallSelection").value;
      var date=document.getElementById("date").value;
      var insertTime= JSON.stringify(selectedTime);
      var insertSeat= JSON.stringify(seat);
     
      formData.append('selectedTime',insertTime) ;
      formData.append('seat',insertSeat);
      formData.append('movieID_insertdata', movieID);
      formData.append('hallID_insertdata', hallID);
      formData.append('date_insertdata', date);

      $.ajax({ 
           url:'showtimeFunction.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (datas){
            	console.log("checking redirect");
   			window.location.href = "./showtime.php";

            },
            error: function(x,e){
              alert(x+e);
        }
        });

      }



  </Script>

</html>
