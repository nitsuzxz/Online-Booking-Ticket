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
		<link rel="stylesheet" href="../Asset/style.css" />
		<title>Admin Dashboard</title>
		
    	
	</head>
	<body>
		
		<div class="dashboardContainer">
			<?php include 'sideNav.html'; ?>  
			
			<div id="main">
	  			<h2>Admin Dashboard</h2>
	  			<h3>Welcome <?php echo $_SESSION['username'] ?>!</h3>
			</div>
		</div>
	</body>
</html>