<!doctype html>
<html lang="en">
<head>
<title>Home Page</title>
<meta name="keywords" content="">
<meta name="description" content="">



<?php
$srcurl = "includes/";
$basesurl = "assets/";
?>




<?php
$style = $_SERVER['HTTP_HOST']; 
$style = $srcurl."style.php"; 
include($style); 

$urhere = "homepage";
?>



</head>
<body class="hompg">

<!-- <?php
$header = $_SERVER['HTTP_HOST']; 
$header = $srcurl."header.php"; 
include($header); 
?> -->



<section class="screen1">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="wrp1">
					<h1>
						Welcome to online booking system
					</h1>
					<h2>
						Book your ride online in a minute!
					</h2>
					<h3>
						Please select an option below
					</h3>
					<div class="wrp1_btn">
						<a class="btn" href="<?php echo $path;?>book_a_ride">Book Online</a>
						<a class="btn" href="<?php echo $path;?>">Search Your Ride</a>
					
					</div>
					<div class="row log_sig">
						<div class="col-md-12">
							<h4>Have an account with us?</h4>
							<a class="btn" href="<?php echo $path;?>log_reg">Login / Register</a>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<!-- <?php
$footer = $_SERVER['HTTP_HOST']; 
$footer = $srcurl."footer.php"; 
include($footer); 
?> -->




</body>
</html>