<?php 
    include ('../../Config/db_config.php');
        $email =$_POST['email'];
        $password =$_POST['password'];

        $checking ="SELECT user_id,user_email, user_password FROM user WHERE user_email = '$email' AND user_password = '$password'";
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
                    var aired=JSON.parse(sessionStorage.getItem("airedID"));
                    var user_id=JSON.parse(sessionStorage.getItem("user_id"));


               
                    sessionStorage.setItem("user_id", JSON.stringify(<?php echo $row['user_id']; ?>));


                    if(aired==null){
                          window.location.href="../index.html";
                     }else{
                         window.location.href = "../Seat/seat.html";
                     }

                </script>
                <?php

        }
?>


