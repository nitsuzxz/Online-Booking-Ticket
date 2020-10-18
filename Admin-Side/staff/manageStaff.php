<?php
  include ('../../Config/db_config.php');

  $query1 = "select user.user_id, user.cinema_id, user.user_name, user.user_age, user.user_email, user.user_type, cinema.cinema_name from user JOIN cinema ON user.cinema_id=cinema.cinema_id";

  $result1 = mysqli_query($conn, $query1);
  $userList = mysqli_fetch_all($result1, MYSQLI_ASSOC);

  if(isset($_POST['manageStaff'])){

    $staffName = $_POST['staffName'];
    $staffAge =$_POST['staffAge'];
    $staffEmail=$_POST['staffEmail'];
    $staffPass=$_POST['staffPass'];
    $user_type=$_POST['user_type'];
    $cinemaID=$_POST['cinemaID'];

    $query1 = "select * from user WHERE user_email = '".$staffEmail."'";
    $result1 = mysqli_query($conn, $query1);
    $user_data = mysqli_fetch_array($result1);

      if(EMPTY($user_data['user_email'])){
        /*echo "Ok user tawujud blh proceed";*/
        $query2 = "INSERT INTO user(
        user_name,
        user_age,
        user_email,
        user_password,
        user_type,
        cinema_id)
        VALUES(
        '$staffName',
        '$staffAge',
        '$staffEmail',
        '$staffPass',
        '$user_type',
        '$cinemaID')";
        $result1 = mysqli_query($conn, $query2);
        header('Location: staff.php');
      }
      else{
        /*echo "Woi wujud aa maneleh";*/
      }

  }

  if (isset($_GET['delete'])) {
    $query = "DELETE FROM user WHERE user_id = {$_GET['delete']}";
   if (mysqli_query($conn,$query)){
      header('Location: staff.php');
    }
    else{
      echo "Query x jadi";
      } 
  }

?>