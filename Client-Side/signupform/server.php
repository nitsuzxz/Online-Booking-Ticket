<?php 
    include ('../../Config/db_config.php');
        $username =$_POST['username'];
        $email =$_POST['email'];
        $password =$_POST['password'];
        $age= $_POST['age'];
        $type= "user";

        $checking ="SELECT FROM user_name, user_email";

        $checking ="SELECT  user_name, user_email FROM user WHERE user_name = '$username' OR user_email = '$email'";// line ni untuk buat instruction

        $check =mysqli_query($conn, $checking ) or die(mysqli_error($conn)); // line nie untuk run instruction from $checking
        $row = $check->fetch_assoc();// cara get data
        $c_username = $row['user_name'];
        $c_email = $row['user_email'];
        
        if ($email != $c_email && $username != $c_username) {
                    $sql ="INSERT INTO user (user_name, user_age, user_email, user_password, user_type ) values( '$username', '$age', '$email', '$password', '$type' )";

        $result =mysqli_query($conn, $sql ) or die(mysqli_error($conn));

        if($result==true)
        {header("../MainPage/MainPage.html");
         ?>
                <script>
                   window.location.href="../MainPage/MainPage.html";
                </script>
                <?php
        }

        } else {
         ?>
                <script>
                    alert("Email or Username already existed")  
                   window.location.href="signupform.html";
                </script>
                <?php

            //header("location: signupform.html") ;
        }
        


?>