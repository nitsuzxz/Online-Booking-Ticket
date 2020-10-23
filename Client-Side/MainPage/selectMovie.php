<?php 
include "../../Config/db_config.php";

if(isset($_POST["getMovie_currentDate"])){

    $currentDate=$_POST["getMovie_currentDate"]; 

    $query="SELECT * FROM movie WHERE movie_status='aired' OR movie_status='upcoming'";
    $run=mysqli_query($conn,$query);
    $fetch=mysqli_fetch_all($run,MYSQLI_ASSOC);
    
    foreach($fetch as $moviedetails){

        $movie_id   = $moviedetails['movie_id'];
        $startDate  = $moviedetails['movie_date_start_aired'];
        $endDate    = $moviedetails['movie_date_end_aired'];
        $status     = $moviedetails['movie_status'];

        if($currentDate>$endDate){

            if($status=="aired"){

                $query_updateStatus= "UPDATE movie SET movie_status='finished' WHERE movie_id= $movie_id";
                $run=mysqli_query($conn,$query_updateStatus);
            
            }
      
        }else if($currentDate>$startDate){
    
            if($status=='upcoming'){

                $query_updateStatus= "UPDATE movie SET movie_status='aired' WHERE movie_id= $movie_id";
                $run=mysqli_query($conn,$query_updateStatus);
            
            }
        }
    }

    
    $query="SELECT * FROM movie WHERE movie_status='aired'";
    $run=mysqli_query($conn,$query);
    $fetch=mysqli_fetch_all($run,MYSQLI_ASSOC);


    print json_encode($fetch);
}


if(isset($_POST['sel_movie']) && $_POST['currentDate']){


    $movie_id= $_POST['sel_movie'];
    $currentDate= $_POST['currentDate'];

    $query="SELECT aired_startTime,aired.aired_date,aired.movie_id, hall.hall_name, cinema.cinema_name FROM aired 
            INNER JOIN hall ON aired.hall_id=hall.hall_id 
            INNER JOIN cinema on hall.hall_cinema_id=cinema.cinema_id
            WHERE aired.movie_id=$movie_id AND aired.aired_date>='$currentDate'";

    $run=mysqli_query($conn,$query);
    $fetch=mysqli_fetch_all($run,MYSQLI_ASSOC);


    print json_encode($fetch);

    }


?>