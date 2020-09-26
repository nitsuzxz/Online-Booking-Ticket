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
    <title>Manage Cinema</title>
    
      
  </head>
  <body>
    
    <div class="dashboardContainer">
      <?php include '../../Asset/sideNav.php'; ?>  
      
      <div id="main">
          <h2>Manage Cinema</h2>

          <form class="col-8" action="./addCinema.php" method="post" style="margin: 0px 20px;">
            <div class="form-group col-8">
              <label for="inputName">Name</label>
              <input type="text" class="form-control col-12" id="inputName" name="cinemaName" placeholder="Enter Name">
            </div>
            <div class="form-group col-8">
              <label for="inputAddress">Address</label>
              <input type="text" class="form-control col-12" id="inputAddress" name="cinemaLocation" placeholder="Enter Adress">
            </div>
            <div class="form-group col-8">
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea class="form-control col-12" id="exampleFormControlTextarea1" name="cinemaDesc" rows="3"> </textarea>
            </div>
            <button name="addCinema" type="submit" class="btn btn-outline-success col-md-2 offset-md-5">Add</button>
          </form>

          <p></p>

          <table class="table w-75 p-3" style="margin: 0px 20px;">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Cinema</th>
                <th scope="col">Location</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Place 1</td>
                <td>Address 1</td>
                <td><button type="submit" class="btn btn-outline-success col-md-5">Edit</button>
                &nbsp;
                <button type="submit" class="btn btn-outline-danger col-md-5">Delete</button>
                </td>
              </tr>
              <tr>
                <th scope="row">2</th>
                  <td>Place 2</td>
                  <td>Address 2</td>
                  <td><button type="submit" class="btn btn-outline-success col-md-5">Edit</button>
                &nbsp;
                <button type="submit" class="btn btn-outline-danger col-md-5">Delete</button>
                </td>
              </tr>
              <tr>
                <th scope="row">3</th>
                  <td>Place 3</td>
                  <td>Address 3</td>
                  <td><button type="submit" class="btn btn-outline-success col-md-5">Edit</button>
                &nbsp;
                <button type="submit" class="btn btn-outline-danger col-md-5">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>

      </div>

    </div>

  </body>
  
</html>