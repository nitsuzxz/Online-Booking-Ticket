<?php 

include ('../../Config/db_config.php');


if(isset($_POST['fetchhistory'])){

    $customer_id=$_POST['fetchhistory'];

    $query="SELECT th.trans_id,th.date,movie.movie_name FROM transaction_history AS th 
    INNER JOIN aired ON  th.aired_id= aired.aired_id 
    INNER JOIN movie on aired.movie_id=movie.movie_id
    WHERE th.customer_id=$customer_id ";

    $result=mysqli_query($conn,$query);
    $fetch=mysqli_fetch_all($result,MYSQLI_ASSOC);

    print json_encode($fetch);
}
?>