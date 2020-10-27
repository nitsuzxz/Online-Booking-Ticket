<?php 
    include ('../../Config/db_config.php');

if(isset($_POST['getPrice'])){

    $airedID=$_POST['getPrice'];

    $query="SELECT movie.movie_price, hall.hall_price from aired
            INNER JOIN movie ON aired.movie_id=movie.movie_id 
            INNER JOIN hall ON aired.hall_id=hall.hall_id
            WHERE aired.aired_id=$airedID";
    
    $run=mysqli_query($conn,$query);
    $fetch=mysqli_fetch_all($run,MYSQLI_ASSOC);

    print json_encode($fetch);
    
}

if(isset($_POST['airedID'],$_POST['totalPrice'],$_POST['date'],$_POST['user_id'],$_POST['seat'],$_POST['total_ticket'])){

    $airedID=$_POST['airedID'];
    $totalPrice=$_POST['totalPrice'];
    $date=$_POST['date'];
    $user_id=$_POST['user_id'];
    $seat=$_POST['seat'];
    $total_ticket=$_POST['total_ticket'];
   

    $query="INSERT INTO transaction_history (customer_id,date,total_ticket,aired_id,total_price) VALUES ($user_id,'$date',$total_ticket,$airedID,$totalPrice)";
    $run=mysqli_query($conn,$query);
    $id= mysqli_insert_id($conn);
    $selected_seat= array();
    
   
    $split_seat=explode(",",$seat);
    $seat_size= count($split_seat);

    for($i=0;$i<$seat_size;$i++){
        array_push($selected_seat,$split_seat[$i]);
    }




    if(!EMPTY($id)){
        
        $size=sizeof($selected_seat);
   
        for($i=0;$i<$size;$i++){
            $split=explode("-",$selected_seat[$i]);
            $seat_row=$split[0];
            $seat_number=$split[1];

            $query="UPDATE seat_record SET seat_availablity='occupied', transaction_id=$id WHERE aired_id=$airedID AND seat_row='$seat_row' AND seat_number=$seat_number";
            $run=mysqli_query($conn,$query);
        

        }
    print json_encode($id);

    }else{
        echo "kosong". $id;
    }
}

if(isset($_POST['receipt'])){

    $trans_id=$_POST['receipt'];
    $query="SELECT aired.aired_date,th.total_ticket,th.total_price,th.date,aired.aired_startTime,movie.movie_name,hall.hall_name,seat_record.seat_row,seat_record.seat_number,cinema.cinema_name FROM transaction_history as TH
            INNER JOIN aired ON aired.aired_id=th.aired_id
            INNER JOIN movie ON movie.movie_id=aired.movie_id
            INNER JOIN hall ON hall.hall_id=aired.hall_id
            INNER JOIN cinema ON cinema.cinema_id=hall.hall_cinema_id
            INNER JOIN seat_record ON seat_record.transaction_id=th.trans_id
            WHERE trans_id=$trans_id";
    $run=mysqli_query($conn,$query);
    $fetch=mysqli_fetch_all($run,MYSQLI_ASSOC);

    print json_encode($fetch);


}





?>

