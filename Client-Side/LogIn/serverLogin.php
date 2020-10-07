<?php 
    include ('../../Config/db_config.php');
        $username =$_POST['username'];
        $password =$_POST['password'];

/*        $sql ="INSERT INTO user (user_name, user_age, user_email, user_password, user_type ) values( '$username', '$age', '$email', '$password', '$type' )";*/


$sql = "SELECT * FROM user WHERE  user_name='$username'  AND user_password='$password'";
        $result =mysqli_query($conn, $sql ) or die(mysqli_error($conn));

        if($result==true)
        {
            ?>
                <script>
                    window.location.href="../MainPage/MainPage.html";
                </script>
            <?php
        }

?>