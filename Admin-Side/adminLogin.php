<?php
    global $connection;
    global $error1;


    if (isset($_POST['login'])){
        $uname= $_POST['uname'];
        $psw= $_POST['psw'];
        
        $email= mysqli_real_escape_string($connection, $uname);
        $pass= mysqli_real_escape_string($connection, $psw);
        
        $select_query = "SELECT * FROM pengajar WHERE email_pengajar = '{$email}'";
        $query = mysqli_query($connection, $select_query);
        
        $row = mysqli_fetch_array($query);
        $idp=$row['id_pengajar'];
        $admin_uname=$row['email_pengajar'];
        $admin_psw= $row['pass_pengajar'];
        $us_role= $row['jawatan'];
        $bahagian=$row['bahagian'];
        
        if(!empty ($uname) && !empty($psw)){
            
        if($email === $admin_uname && $pass === $admin_psw){
            if($us_role == 1) {
             header("Location: ./Dashboard/index.php");   
           
            }
            else if ($us_role == 2){
            header("Location: ./KBDashboard/index.php");
            }
           
            $_SESSION['bahagian']= $bahagian;
            $_SESSION['email_pengajar']= $admin_uname;
            $_SESSION['id_pengajar']=$idp;
        }
        if(isset($_SESSION['email_pengajar']) &&
    empty ($_SESSION['email_pengajar'])) {
    header ('Location: ../index.php');
            
        }    
        else{
            $error1 ="<div class='alert alert-danger'>
    <strong>ALERT!</strong> Admin Login Credential are invalid.
  </div>";
            }
        }
    }

?>