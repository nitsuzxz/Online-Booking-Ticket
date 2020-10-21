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

        // echo "run";
        // echo " current date is ".$currentDate;
        // echo " movie end date is ". $endDate;
        // echo " movie status is ". $status;
        // echo "<br>";


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





?>