<?php 

include "../../Config/db_config.php";

if(isset($_POST['showtimeInfo'])){

    $aired_id=$_POST['showtimeInfo'];
    //get movie name, date, showtime
    $query="SELECT aired.aired_date,aired.aired_startTime,movie.movie_name,hall.hall_name,cinema.cinema_name FROM aired
     INNER JOIN movie on aired.movie_id=movie.movie_id
     INNER JOIN hall on aired.hall_id= hall.hall_id
     INNER JOIN cinema on hall.hall_cinema_id= cinema.cinema_id
     WHERE aired.aired_id=".$aired_id."";

    $res=mysqli_query($conn,$query);
    $fetch_showtimeDetail=mysqli_fetch_all($res,MYSQLI_ASSOC);
    
    print json_encode($fetch_showtimeDetail);

}

if(isset($_POST['airedID'])){

    $aired_id=$_POST['airedID'];

    $query="SELECT * FROM seat_record WHERE aired_id=".$aired_id."";

    $res=mysqli_query($conn,$query);
    $fetch=mysqli_fetch_all($res,MYSQLI_ASSOC);
    
    print json_encode($fetch);

}


?>
