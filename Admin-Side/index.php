<?php //include("../Config/db_config.php") ?>
<?php //include ("adminLogin.php") ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dummy Cinemas</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
        <link rel="stylesheet" href="../Asset/style.css" />
    </head>
    
    <body>
        <h1 class="adminLogin">Dummy Cinemas</h1>
        
        <form action="adminLogin.php" method="post">
          <div class="container">
            <label for="adminName"><b>Administrator Name</b></label>
            <input type="text" placeholder="Enter Administrator Name" name="adminName" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button type="submit">Login</button>
          </div>
        </form>


    </body>
</html>