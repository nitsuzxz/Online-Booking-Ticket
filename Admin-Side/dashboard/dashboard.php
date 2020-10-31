<?php
include ('../../Config/db_config.php');

$q="SELECT count(cinema_id) AS  total_cinema FROM cinema";
$result=mysqli_query($conn,$q);
$fetch=mysqli_fetch_all($result,MYSQLI_ASSOC);

$total_cinema='';

foreach($fetch as $cinema){

    $total_cinema=$cinema['total_cinema'];

}

$q="SELECT count(hall_id) AS  total_hall FROM hall";
$result=mysqli_query($conn,$q);
$fetch=mysqli_fetch_all($result,MYSQLI_ASSOC);

$total_hall='';

foreach($fetch as $hall){

    $total_hall=$hall['total_hall'];

}

$q="SELECT count(movie_id) AS  total_movie FROM movie";
$result=mysqli_query($conn,$q);
$fetch=mysqli_fetch_all($result,MYSQLI_ASSOC);

$total_movie='';

foreach($fetch as $movie){

    $total_movie=$movie['total_movie'];

}



?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<!-- Bootstrap CSS CDN -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		
		<link rel="stylesheet" href="../../Asset/style.css" />
		<title>Dashboard</title>	
		<style>
		.counter
{
    text-align: center;
}

.counter-count
{
    font-size: 50px;
    font-weight: bold;
    position: relative;
    color: #000000;
    text-align: center;
    display: inline-block;
}
		</style>
	</head>

	<body>
		
		<div class="dashboardContainer">
			<?php include '../../Asset/sideNav.php'; ?>  
			
			<div id="main">
	  			<h1>Dashboard</h1>
	  			<h3>Welcome <?php echo $_SESSION['username'] ?>!</h3>

				<div class="card">
				  <div class="card-body">
				   <div class="counter">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="count-up">
                    <p class="counter-count"><?php echo $total_cinema ?></p>
                    <h3>Total Cinema</h3>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="count-up">
                    <p class="counter-count"><?php echo $total_hall ?></p>
                    <h3>Total Hall</h3>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="count-up">
                    <p class="counter-count"><?php echo $total_movie?></p>
                    <h3>Total Movie</h3>
                </div>
            </div>
        </div>
    </div>
</div>
				  </div>
				</div>

			</div>
		</div>
	</body>
	<script>
	$('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
          
          //chnage count up speed here
            duration: 400,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
	</script>
	
</html>