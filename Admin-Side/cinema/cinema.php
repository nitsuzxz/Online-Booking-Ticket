<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- Bootstrap CSS CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Asset/style.css" />
    <title>Admin Dashboard</title>
    
      
  </head>
  <body>
    
    <div class="dashboardContainer">
      <?php include '../../Asset/sideNav.php'; ?>  
      
      <div id="main">
          <h2>Manage Cinema</h2>

      <form class="col-8">
          <div class="form-group col-8">
            <label for="inputName">Name</label>
            <input type="text" class="form-control col-12" id="inputName"  placeholder="Enter Name">
          </div>
          <div class="form-group col-8">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control col-12" id="inputAddress"  placeholder="1234 Ma:">
          </div>
          <div class="form-group col-8">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control col-12" id="exampleFormControlTextarea1" rows="3"> </textarea>
          </div>
          <button type="submit" class="btn btn-outline-success col-md-2 offset-md-5">Add</button>
      </form>

      </div>
    </div>
  </body>
</html>