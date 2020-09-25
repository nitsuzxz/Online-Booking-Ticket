<?php
    include ('../../Config/db_config.php');

    if (isset($_POST['login'])){
        //get from login form
        $inputEmail= $_POST['email'];
        $psw= $_POST['password'];
        
        //sanitize form input
        $inputEmail= mysqli_real_escape_string($conn, $inputEmail);
        $psw= mysqli_real_escape_string($conn, $psw);
        //query the database for existing admins
        $select_query = "SELECT * FROM user WHERE user_email  = '{$inputEmail}'";
        $query = mysqli_query($conn, $select_query);
        
        //info from database
        $row = mysqli_fetch_array($query);
        $adminID = $row['user_id'];
        $adminUsername = $row['user_name'];
        $adminEmail = $row['user_email'];
        $adminPassword = $row['user_password'];
        $adminType = $row['user_type'];
        
        //if username & password not empty
        if(!empty ($adminUsername) && !empty($adminPassword)){
            //compare with data from input & data from database
            if($inputEmail === $adminEmail && $psw === $adminPassword){
                $_SESSION['username'] = $adminUsername;
                if($adminType == 'admin'){
                    $_SESSION['user_type'] = 'admin'; 
                    header("Location: ../dashboard/dashboard.php");
                }
                else if ($adminType == 'user') {
                    $_SESSION['user_type'] = 'user'; 
                    header("Location: ../dashboard.php");
                }
            }
            else{
                $_SESSION['error'] = "<div class='alert alert-danger'><strong>ALERT!</strong> Admin Login Credential are invalid.</div>";
                header("Location: ../index.php");
            }
        }
    }
?>