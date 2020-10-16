<?php 
    include ('../../Config/db_config.php');
        $email =$_POST['email'];
        $password =$_POST['password'];

        $checking ="SELECT  user_email, user_password FROM user WHERE user_email = '$email' AND user_password = '$password'";
        $check =mysqli_query($conn, $checking ) or die(mysqli_error($conn)); // line nie untuk run instruction from $checking
        $row = $check->fetch_assoc();// cara get data

        if (empty($row['user_email'])) {
            ?>
                         <script>
                    alert("Credential is invalid")  
                   window.location.href="Login.html.html";
                </script>
<?php
        }

        else {

            ?>
                <script>
                   window.location.href="../MainPage/MainPage.html";
                </script>
                <?php

        }
?>