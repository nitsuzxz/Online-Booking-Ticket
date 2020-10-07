<?php 
    include ('../../Config/db_config.php');
        $username =$_POST['username'];
        $email =$_POST['email'];
        $password =$_POST['password'];
        $age= $_POST['age'];
        $type= "user";

        $sql ="INSERT INTO user (user_name, user_age, user_email, user_password, user_type ) values( '$username', '$age', '$email', '$password', '$type' )";

        $result =mysqli_query($conn, $sql ) or die(mysqli_error($conn));

        if($result==true)
        {header("../MainPage/MainPage.html")
            ?>
                <script>
                   window.location.href="../MainPage/MainPage.html";
                </script>
            <?php
        }

?>