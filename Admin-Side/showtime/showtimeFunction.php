<?php 

include ('../../Config/db_config.php');


    if(isset($_POST["cinemaID"])){
        
        $query='SELECT * FROM hall WHERE hall_cinema_id='.$_POST["cinemaID"].'';

        $res = mysqli_query($conn, $query);
        $hallList = mysqli_fetch_all($res, MYSQLI_ASSOC);
        print json_encode($hallList);

    }
?>
