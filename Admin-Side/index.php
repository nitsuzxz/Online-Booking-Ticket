<!DOCTYPE html>
<html>
    <head>
        <title>Dummy Cinemas</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
        <link rel="stylesheet" href="../Asset/style.css" />
    </head>
    
    <body>
        <h1 class="adminLogin">Cinema System</h1>
        <?php session_start(); if(!empty($_SESSION['error'])){ echo $_SESSION['error'];}?>
        
        <form action="./login/adminLogin.php" method="post">
          <div class="container">
            <label for="email"><b>Administrator Email</b></label>
            <input type="text" placeholder="Enter Administrator E-mail" name="email" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button name="login" type="submit">Login</button>
          </div>
        </form>


    </body>
</html>