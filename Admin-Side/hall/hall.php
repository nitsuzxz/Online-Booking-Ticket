<?php
  include ('../../Config/db_config.php');
  include ('./manageHall.php');
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
		<title>Manage Halls</title>
	</head>

	<body>
		
		<div class="dashboardContainer">
			<?php include '../../Asset/sideNav.php'; ?>  
			
			<div id="main">

				<h2>Manage Halls</h2>

				<form action="" method="post" class="col-8" style="margin: 0px 20px;">
						
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

  					<div class="form-group col-8">
    					<label for="inputName">Hall Name</label>
    					<input type="text" name="hallName" class="form-control col-12" id="inputName"  placeholder="Enter Name" value="<?php echo $hallName; ?>">
  					</div>

  					<div class="col-8">
  						<label for="inputRate">Hall Type</label>
   						<div class="form-group">
      						<select name="hallType" class="selectpicker form-control">
        						<option value='Standard Hall'>Standard Hall</option>
        						<option value='Premiere Class'>Premiere Class</option>
        						<option value='Platinum Movie Suites'>Platinum Movie Suites</option>
        						<option value='Gold Class'>Gold Class</option>
      						</select>
    					</div>
  					</div>
  					
  					<div class="form-group col-8">
  						<label for="inputName">Hall Price</label>
  						<input name="hallPrice" type="number" class="form-control col-12" placeholder="RM 0.00" step=".10" value="<?php echo $hallPrice; ?>">				
		        </div>

            <div class="form-group col-8">
              <label for="inputName">Number of Rows</label>
              <input name="hallRow" type="number" class="form-control col-12" placeholder="Enter number of rows (Min = 5, Max 10)" min="5" max="10" value="<?php echo $hallRow; ?>">        
            </div>

            <div class="form-group col-8">
              <label for="inputName">Number of Seats per Row</label>
              <input name="hallSeatsPerRow" type="number" class="form-control col-12" placeholder="Enter number of seats per row (Min = 10, Max 14)" min="10" max="14" value="<?php echo $hallSeatsPerRow; ?>">        
            </div>

            <?php if (isset($_GET['edit'])){
              $id = $_GET['edit'];
              echo '<input  type="hidden" name="hallID" value="'.$id.'"></input>';
              echo '<button name="editHall" type="submit" class="btn btn-outline-success col-md-2 offset-md-5">Edit</button>';
              echo "<a href='./hall.php' type='button' class='btn btn-outline-danger col-md-2 offset-md-5' >Cancel</a>";
            } else{
              echo '<button type="submit" name="addHall" class="btn btn-outline-success col-md-2 offset-md-5">Add</button>';  
            }
   	        
            ?>
				</form>

        <p></p>

        <table class="table w-75 p-3" style="margin: 0px 20px;">
            <thead>
              <tr>
                <th style="text-align: center;" scope="col">No.</th>
                <th style="text-align: center;" scope="col">Cinema Name</th>
                <th style="text-align: center;" scope="col">Name</th>
                <th style="text-align: center;" scope="col">Type</th>
                <th style="text-align: center;" scope="col">Price</th>
                <th style="text-align: center;" scope="col">Number of Rows</th>
                <th style="text-align: center;" scope="col">Number of Seats Per Row</th>
                <th style="text-align: center;" scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; foreach ($hallList as $hall): ?>
                <tr>
                  <td style="text-align: center;" scope="row"><?php echo $i++; ?></th>
                  <td style="text-align: center;" scope="row"><?php echo $hall['cinema_name'];?></th>
                  <td style="text-align: center;"><?php echo $hall['hall_name'];?></td>
                  <td style="text-align: center;"><?php echo $hall['hall_type'];?></td>
                  <td style="text-align: center;">RM <?php echo $hall['hall_price'];?></td>
                  <td style="text-align: center;"><?php echo $hall['seat_row'];?></td>
                  <td style="text-align: center;"><?php echo $hall['seat_number'];?></td>
                  <td><a type="button" href="./hall.php?edit=<?php echo $hallID; ?>&cinema=<?php echo $hall['hall_cinema_id']?>" class="btn btn-outline-success">Edit</a>
                  &nbsp;
                  <a type="button" href="./hall.php?delete=<?php echo $hallID; ?>" class="btn btn-outline-danger">Delete</a>
                  </td>
                </tr>
              <?php endforeach; ?>
          </tbody>
        </table>

			</div>

		</div>

	</body>

</html>