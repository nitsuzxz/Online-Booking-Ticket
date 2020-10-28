<?php 

include ('../../Config/db_config.php');
    
    $movieName = '';
    $startTime = '';
    $endTime = '';
    $airedDate = '';
    $hallName = '';
    $movieID = '';
    $cinemaName = '';
    $query = '';
    $res = '';
    $showtimeList = '';

    $query = 'SELECT 
    movie.movie_name, 
    aired.aired_startTime, 
    aired.aired_endTime,
    aired.aired_date,
    hall.hall_name, 
    aired.aired_id,
    cinema.cinema_name 
    FROM aired 
    INNER JOIN hall ON aired.hall_id=hall.hall_id 
    INNER JOIN cinema on hall.hall_cinema_id=cinema.cinema_id
    INNER JOIN movie on movie.movie_id = aired.movie_id
    WHERE movie.movie_status="airing" OR movie.movie_status="upcoming"';

    $res = mysqli_query($conn, $query);
    $showtimeList = mysqli_fetch_all($res, MYSQLI_ASSOC);

    if(isset($_POST["fetchHall"])){
        $cinemaID=$_POST["fetchHall"];
        $query='SELECT * FROM hall WHERE hall_cinema_id='.$cinemaID.'';

        $res = mysqli_query($conn, $query);
        $hallList = mysqli_fetch_all($res, MYSQLI_ASSOC);
        print json_encode($hallList);
    }

    if(isset($_POST["fetchMovie"])){
    
        $query='SELECT * FROM movie WHERE movie_status="airing" OR movie_status="upcoming"';

        $res = mysqli_query($conn, $query);
        $movieList = mysqli_fetch_all($res, MYSQLI_ASSOC);
        print json_encode($movieList);
    }

    if(isset($_POST["hallID"], $_POST["movieID"], $_POST["date"])){
       
        $hallID=$_POST["hallID"];
        $movieID=$_POST["movieID"];
        $date=$_POST["date"];



        $query='SELECT aired.aired_id ,aired.movie_id, aired.hall_id, aired.aired_date, aired.aired_startTime, aired.aired_endTime, movie.movie_duration FROM aired JOIN movie 
                 ON aired.movie_id=movie.movie_id WHERE aired.movie_id= '.$movieID.' AND  aired.hall_id='.$hallID.' AND aired.aired_date="'.$date.'" ';

        $res = mysqli_query($conn, $query);
        $aired = mysqli_fetch_all($res, MYSQLI_ASSOC);
  
         print json_encode($aired);
    }

    if(isset($_POST["mId"])){

        $mId= $_POST["mId"];
        $query='SELECT movie_duration FROM movie where movie_id='.$mId.' ';


        $res = mysqli_query($conn, $query);
        $duration = mysqli_fetch_all($res, MYSQLI_ASSOC);
        
        print json_encode($duration);
    }

    if(isset($_POST["selectedTime"], $_POST["seat"])){
       
        $hallID=$_POST["hallID_insertdata"];
        $movieID=$_POST["movieID_insertdata"];
        $date=$_POST["date_insertdata"];
        $selectedTime=json_decode($_POST["selectedTime"]);
        $seats=json_decode($_POST["seat"]);
       
        print_r($selectedTime);
        $datas=array();

        foreach($selectedTime as $index=>$value){
            
            $start= $value->start;
            $end= $value->end;
           
            $query='INSERT INTO aired (movie_id, hall_id, aired_date,aired_startTime,aired_endTime) VALUES ('.$movieID.','.$hallID.',"'.$date.'","'.$start.':00","'.$end.':00")';     
            
            $res = mysqli_query($conn, $query);
          
            $id= mysqli_insert_id($conn);

   
            array_push($datas,$id);
        }

        print_r($datas);

        for($i=0; $i < count($datas) ; $i++){

    
            foreach($seats as $seat){
                $seat_rows=$seat->seat_row;
                $seat_numbers= $seat->seat_number;

                $alphabet ='A';

                for($row=0; $row<$seat_rows; $row++){
             

                    $aired_id = $datas[$i];
                    echo $aired_id;
                    echo "<br>";
                    
                    for($s_numbers=1; $s_numbers<=$seat_numbers; $s_numbers++){
                        
                        $query_seat='INSERT INTO seat_record (seat_row, seat_number, aired_id, seat_availablity) VALUES ("'.$alphabet.'", '.$s_numbers.', '.$aired_id.', "Available")';
    
                        if (mysqli_query($conn,$query_seat)) {
                            echo $query_seat;
                            echo "<br>";
                            echo "success";
                        }
                        else{
                            echo $query_seat;
                            echo "<br>";
                        }	
        
                    }
                    ++$alphabet;
                }
            }
        }   
    }

    if (isset($_GET['delete'])) {
        $query = "DELETE FROM aired WHERE aired_id = {$_GET['delete']}";
        mysqli_query($conn,$query);
        header('Location: showtime.php');
    }
?>
