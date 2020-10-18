<?php 

include "../../Config/db_config.php";

//variable to filter the result...
// $cinema_id=''; 
// $movie_id=''; 
// $hall='';
// $time='';
// $data='';

// $movie_id=mysqli_real_escape_string($conn, $movie_id);

// $fetch

if(isset($_POST['airedID'])){

    $aired_id=$_POST['airedID'];

    $query="SELECT * FROM seat_record WHERE aired_id=".$aired_id."";

    $res=mysqli_query($conn,$query);
    $fetch=mysqli_fetch_all($res,MYSQLI_ASSOC);
    
    print json_encode($fetch);

}


?>
