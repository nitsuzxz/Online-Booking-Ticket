<?php
include './manageStaff.php';
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
    <title>Manage Staff</title>
    
      
  </head>
  <body>
    
    <div class="dashboardContainer">
      <?php include '../../Asset/sideNav.php'; ?>  
      
      <div id="main">
          <h2>Manage Staff</h2>

          <form class="col-8" action="" method="post" style="margin: 0px 20px;">
            <div class="form-group col-8">
              <label for="inputName">Name</label>
              <input type="text" class="form-control col-12" id="inputName" name="staffName" placeholder="Enter Name" value="" required>
            </div>
            <div class="form-group col-8">
              <label for="inputName">Age</label>
              <input type="text" class="form-control col-12" id="inputAge" name="staffAge" placeholder="Enter Age" value="" required>
            </div>
            <div class="form-group col-8">
              <label for="inputEmail">Email</label>
              <input type="text" class="form-control col-12" id="inputEmail" name="staffEmail" placeholder="Enter Email" value="" required>
            </div>
            <div class="form-group col-8">
              <label for="inputPassword">Password</label>
              <input type="password" class="form-control col-12" id="inputPass" name="staffPass" placeholder="Enter your password" value=""required>
            </div>
            
            <div class="col-8">
              <label for="user_type">User Type</label>
                <select name="user_type"  class="selectpicker form-control">
                  <option value="staff">Staff</option>
                  <option value="admin">Admin</option>
                </select>
            </div>

            <div class="col-8">
              <label for="inputRate">Cinema</label>
              <div class="form-group">
               <select name="cinemaID" class="selectpicker form-control" required>
                <option value=''>Select Cinema</option>
                  <?php
                  
                    $query="SELECT cinema_id, cinema_name FROM cinema ORDER BY cinema_name ASC";
                    $res = mysqli_query($conn, $query);

                    $cinemaList = mysqli_fetch_all($res, MYSQLI_ASSOC);
                    foreach($cinemaList as $listof){
                      echo '<option value="'.$listof['cinema_id'].'" ';
                      
                        if(isset($_GET['edit'])){
                          

                    
                          $selectedID = $_GET['cinema'];
                          $retrievedID = $listof['cinema_id'];
                          if ($retrievedID==$selectedID){
                            echo 'selected="selected"';
                          }
                          else{
                           echo 'in else rn';
                          }
                        }
                      
                      echo '>'.$listof['cinema_name'].'</option>';
                    }
                  ?>
 
                  </select>
              </div>
            </div>

            <?php if (isset($_GET['edit'])) {
              $id = $_GET['edit'];
              echo '<input  type="hidden" name="cinID" value="'.$id.'"></input>';
              echo '<button name="editCinema" type="submit" class="btn btn-outline-success col-md-2 offset-md-5">Edit</button>';
              echo "<a href='./cinema.php' type='button' class='btn btn-outline-danger col-md-2 offset-md-5' >Cancel</a>";
            } 
            else {
              echo '<button name="manageStaff" type="submit" class="btn btn-outline-success col-md-2 offset-md-5">Add New</button>';
            } ?>
          </form>

          <br>

          <table class="table w-75 p-3" style="margin: 0px 20px;">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Email</th>
                <th scope="col">User Type</th>
                <th scope="col">Cinema</th>
                <th scope="col">Option</th>

              </tr>
            </thead>
            <tbody>
              <?php $i=1;
              foreach($userList as $user) : ?>
                <tr>
                  <td style="text-align: center;"><?php echo $i; $i++; ?></td>
                  <td style="text-align: center;"><?php echo $user['user_name'];?></td>
                  <td style="text-align: center;"><?php echo $user['user_age'];?></td>
                  <td style="text-align: center;"><?php echo $user['user_email'];?></td>   
                  <td style="text-align: center;"><?php echo $user['user_type'];?></td>
                  <td style="text-align: center;"><?php echo $user['cinema_name'];?></td>
                  <td><a type="button" href="./staff.php?delete=<?php echo $user['user_id'];  ?>" class="btn btn-outline-danger col-8">Delete</a></td>
                </tr>
                <?php endforeach; ?> 
            </tbody>
          </table>

      </div>

    </div>

  </body>
  
</html>