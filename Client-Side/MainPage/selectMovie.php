<?php 
include "../../Config/db_config.php";

if(isset($_POST["getMovie_currentDate"])){

    $currentDate=$_POST["getMovie_currentDate"]; 

    $query="SELECT * FROM movie WHERE movie_status='airing' OR movie_status='upcoming'";
    $run=mysqli_query($conn,$query);
    $fetch=mysqli_fetch_all($run,MYSQLI_ASSOC);


    foreach($fetch as $moviedetails){

        $movie_id   = $moviedetails['movie_id'];
        $startDate  = $moviedetails['movie_date_start_aired'];
        $endDate    = $moviedetails['movie_date_end_aired'];
        $status     = $moviedetails['movie_status'];
    


        if($currentDate>$endDate){

            echo "pass";

            if($status=="airing"){

                $query_updateStatus= "UPDATE movie SET movie_status='finished' WHERE movie_id= $movie_id";
                echo $query_updateStatus;
                $run=mysqli_query($conn,$query_updateStatus);
            
            }
      
        }else if($currentDate>$startDate){
    
            if($status=='upcoming'){

                $query_updateStatus= "UPDATE movie SET movie_status='airing' WHERE movie_id= $movie_id";
                echo $query_updateStatus;
                $run=mysqli_query($conn,$query_updateStatus);
            
            }
        }
    }

    $query="SELECT * FROM movie WHERE movie_status='airing'";
    $run=mysqli_query($conn,$query);
    $fetch=mysqli_fetch_all($run,MYSQLI_ASSOC);


    print json_encode($fetch);
}


if(isset($_POST["sel_movie"], $_POST["currentDate"])){


    $movie_id= $_POST['sel_movie'];
    $currentDate= $_POST['currentDate'];
    

    $query="SELECT aired_date FROM aired WHERE movie_id=$movie_id AND aired_date>='$currentDate' GROUP BY aired_date";
   
    echo $query;
    $run=mysqli_query($conn,$query);
    $fetch=mysqli_fetch_all($run,MYSQLI_ASSOC);


    print json_encode($fetch);

    }

if(isset($_POST["m_id"] , $_POST["m_date"])){

    $movie_id= $_POST ["m_id"];
    $movie_airedDate= $_POST["m_date"];

        $query="SELECT aired.aired_id,aired.aired_startTime,aired.aired_date,aired.movie_id, hall.hall_name, cinema.cinema_name FROM aired 
            INNER JOIN hall ON aired.hall_id=hall.hall_id 
            INNER JOIN cinema on hall.hall_cinema_id=cinema.cinema_id
            WHERE aired.movie_id=$movie_id AND aired.aired_date='$movie_airedDate'";

        $run=mysqli_query($conn,$query);
        $fetch=mysqli_fetch_all($run,MYSQLI_ASSOC);

        print json_encode($fetch);

        

}


?>