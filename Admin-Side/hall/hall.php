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
		<title>Manage Halls</title>
	</head>

	<body>
		
		<div class="dashboardContainer">
			<?php include '../../Asset/sideNav.php'; ?>  
			
			<div id="main">

				<h2>Manage Halls</h2>

				<form class="col-8" style="margin: 0px 20px;">
						
  					<div class="col-8">
  						<label for="inputRate">Cinema</label>
   						<div class="form-group">
      						<select class="selectpicker form-control">
        						<option>GSC Mid Valley</option>
        						<option>GSC Quill City Mall</option>
        						<option>GSC NU Sentral</option>
        						<option>GSC Melawati Mall</option>
        						<option>GSC Berjaya Times Square</option>
      						</select>
    					</div>
  					</div>

  					<div class="form-group col-8">
    					<label for="inputName">Hall Name</label>
    					<input type="text" class="form-control col-12" id="inputName"  placeholder="Enter Name">
  					</div>

  					<div class="col-8">
  						<label for="inputRate">Hall Type</label>
   						<div class="form-group">
      						<select class="selectpicker form-control">
        						<option>Standard Hall</option>
        						<option>Premiere Class</option>
        						<option>PLatinum Movie Suites</option>
        						<option>Gold Class</option>
      						</select>
    					</div>
  					</div>
  					
  					<div class="form-group col-8">
  						<label for="inputName">Hall Price</label>
  						<input type="text" class="form-control col-12" placeholder="RM 0.00">				
					</div>



   					<button type="submit" class="btn btn-outline-success col-md-2 offset-md-5">Add</button>

				</form>

        <p></p>

        <table class="table w-75 p-3" style="margin: 0px 20px;">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Cinema</th>
                <th scope="col">Hall</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Layout</th>
                <th scope="col">Options</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Place 1</td>
                <td>*</td>
                <td>?</td>
                <td>RMXX</td>
                <td>X</td>
                <td><button type="submit" class="btn btn-outline-success col-md-5">Edit</button>
                &nbsp;
                <button type="submit" class="btn btn-outline-danger col-md-5">Delete</button>
                </td>
              </tr>
              <tr>
                <th scope="row">2</th>
                  <td>Place 2</td>
                  <td>*</td>
                  <td>?</td>
                  <td>RMXX</td>
                  <td>X</td>
                  <td><button type="submit" class="btn btn-outline-success col-md-5">Edit</button>
                &nbsp;
                <button type="submit" class="btn btn-outline-danger col-md-5">Delete</button>
                </td>
              </tr>
              <tr>
                <th scope="row">3</th>
                  <td>Place 3</td>
                  <td>*</td>
                  <td>?</td>
                  <td>RMXX</td>
                  <td>X</td>
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