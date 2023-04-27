<!doctype html>
<html lang="en">
<head>
<title>Home Page</title>
<meta name="keywords" content="">
<meta name="description" content="">

<style type="text/css">
.country-wrap {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: visible;
}
.push-bottom {
	position:absolute;
	bottom:0;
	height:100%;
}
.bottom-ground {
	background:#8d773e;
	width:102%;
	left:-1%;
	height:60px;
	bottom:0;
	position:absolute;
	box-shadow:0 2px 3px rgba(0,0,0,0.2) inset;
}
.street {
	
	height:80px;
	width:102%;
	position:absolute;
	top:370px;
	
}

/*styles for car*/
.car {
	position:absolute;
	
	top:-35%;
	z-index:10;
-moz-animation:myfirst 10s  linear infinite;
-webkit-animation:myfirst 10s  linear infinite;
}
@-moz-keyframes myfirst 
{
	0%   {left:-25%;}
	100% {left:100%;}
} 
@-webkit-keyframes myfirst
{
	0%   {left:-25%;}
	100% {left:100%;}
} 
.tyre {
	width:30px;
	height:30px;
	border-radius:50%;
	background:#3f3f40;
	position:absolute;
	z-index:2;
	left:9px;
	top:20px;
-moz-animation:tyre-rotate 1s infinite linear;
  -webkit-animation:tyre-rotate 1s infinite linear;
}
@-moz-keyframes tyre-rotate {
from{-moz-transform:rotate(-360deg);}
to{-moz-transform:rotate(0deg);}
	
}
@-webkit-keyframes tyre-rotate {
from{-webkit-transform:rotate(-360deg);}
to{-webkit-transform:rotate(0deg);}
	
}
.tyre:before {
	content:'';
	width:20px;
	height:20px;
	border-radius:50%;
	background:#bdc2bd;
	position:absolute;
	top:5px;
	left:5px;
}
.gap {
	background:#3f3f40;
	width:2px;
	height:4px;
	position:absolute;
	left:14px;
	top:8px;
	box-shadow:0 9px 0 #3f3f40;
}
.gap:before {
	content:'';
	display:block;
	width:2px;
	height:4px;
	position:absolute;
	background:#3f3f40;
	box-shadow:0 12px 0 #3f3f40;
	-webkit-transform:rotate(-90deg);
	-webkit-transform-origin:0 7px;
	-moz-transform:rotate(-90deg);
	-moz-transform-origin:0 7px;
	z-index:3;
}
.car-base {
	position:absolute;
	display:block;
   	width: 125px;
   	height: 30px;
	background:#000000;
   	border-radius:  10% 10% 50% 50% / 60% 100% 20% 10%;
   	-webkit-transform:rotate(-2deg);
	-moz-transform:rotate(-2deg);
   	border:solid;
   	border-color:#000000;
}
.back-bonet {
	background:  #4c4b4b;
    border-radius: 54% 25% 0 0;
    height: 22px;
    left: 11px;
    position: absolute;
    top: 8px;
    width: 40px;
}
.tyre.front {
	left:94px;
}
.car-body {
	/*width:125px;
	height:24px;
	background:#3e7d8e;
	border-top:1px solid #3e7d8e;*/
	border-bottom: 24px solid #3e7d8e;
    height: 0;
	top:10px;
    width: 120px;
	position:relative;
}
.car-body:before {
	content:'';
	display:inline-block;
	width:30px;
	height:24px;
	position:absolute;
	right:-5px;
	background:#3e7d8e;
	border-top-right-radius:4px;
	z-index:1;
}
.car-body:after {
	content:'';
	display:inline-block;
	width:121px;
	border-bottom: 1px solid #3e7d8e;
    border-right: 2px solid transparent;
    height: 0;
	z-index:2;
	position:absolute;
}
.car-gate {
	width:32px;
	height:20px;
	background:#3e7d8e;
	border-radius:0 0 2px 8px / 0 0 2px 8px;
	box-shadow:0 0 0 1px #3e7d8e;
	position:absolute;
	left:48px;
	
}
.car-gate:before {
	content:'';
	width:8px;
	height:2px;
	background:#4c4b4b;
	position:absolute;
	top:2px;
	left:4px;
	box-shadow:1px 1px 1px rgba(0,0,0,0.1);
}
.car-top-back {
	background: none repeat scroll 0 0 #4C4B4B;
    border-radius: 5px 0 0 0;
    height: 20px;
    left: 4px;
    position: absolute;
    top: -20px;
    width: 58px;
}
.car-top-back:before {
	width:30px;
	height:15px;
	background:#736f6f;
	content:'';
	position:absolute;
	top:3px;
	left:8px;
	border-radius:2px;
}
.car-top-back:after {
	content:'';
	background:#4c4b4b;
	border-radius:  30%;
    height: 5px;
    left: 3px;
    position: absolute;
    top: -1px;
    width: 62px;
}
.car-top-front {
	top:-19px;
	position:absolute;
	left:47px;
	width:20px;
	height:20px;
	background:#3e7d8e;
	border-left: 1px solid #3e7d8e;
    border-radius: 2px 0 0 0;

}
.car-top-front:after {
	width:26px;
	height:20px;
	-webkit-transform:skew(37deg);
	-moz-transform:skew(37deg);
	background:#3e7d8e;
	content:'';
	position:absolute;
	top:0;
	left:6px;
	border-radius:4px 0 4px 4px;
}
.car-top-front:before {
	width:12px;
	height:5px;
	background:#3e7d8e;
	content:'';
	position:absolute;
	top:14px;
	left:28px;
	z-index:1;
	border:solid #3e7d8e;
	border-width:0 1px 1px 0;
}
.wind-sheild {
	top:3px;
	left:3px;
	position:absolute;
	z-index:3;
	width:18px;
	height:12px;
	background:#f5e7e7;
	border-radius:0 3px 0 0;
}
.wind-sheild:after {
	width:12px;
	height:12px;
	-webkit-transform:skew(25deg);
	-moz-transform:skew(25deg);
	background:#f5e7e7;
	content:'';
	position:absolute;
	top:0;
	left:10px;
	border-radius:3px;
}
.boundary-tyre-cover {
	position:absolute;
	top:14px; left:10px;
	border-bottom: 20px solid #4c4b4b;
   	border-right: 10px solid transparent;
	height:0;
	width:20px;
}
.boundary-tyre-cover:before {
	content:'';
	position:absolute;
	display:inline-block;
	background:#4c4b4b;
	height:20px;
	width:15px;
	-webkit-transform:skewX(-20deg);
	-moz-transform:skewX(-20deg);
	border-radius:3px;
	left:-6px;
	top:0;
}
.boundary-tyre-cover:after {
	content:'';
	position:absolute;
	display:inline-block;
	background:#4c4b4b;
	height:20px;
	width:20px;
	-webkit-transform:skewx(40deg);
	-moz-transform:skewX(40deg);
	border-radius:3px;
	right:-14px;
	top:0;
}
.boundary-tyre-cover-inner {
	position:absolute;
	top:4px; left:4px;
	border-bottom: 16px solid black;
   	border-right: 10px solid transparent;
	height:0;
	width:15px;
	z-index:2;
}
.boundary-tyre-cover-inner:before {
	content:'';
	position:absolute;
	display:inline-block;
	background:black;
	height:16px;
	width:15px;
	-webkit-transform:skewX(-20deg);
	-moz-transform:skewX(-20deg);
	border-radius:3px 3px 0 0;
	left:-6px;
	top:0;
}
.boundary-tyre-cover-inner:after {
	content:'';
	position:absolute;
	display:inline-block;
	background:black;
	height:16px;
	width:20px;
	-webkit-transform:skewx(40deg);
	-moz-transform:skewX(40deg);
	border-radius:3px 3px 0 0;
	right:-11px;
	top:0;
}
.boundary-tyre-cover-back-bottom {
	position: absolute;
	width: 14px;
	height: 8px;
	background: #4c4b4b;
	top: 12px;
	left: -19px;
}
.bonet-front {
	background: #3e7d8e;
    border-radius: 5px 258px 0 38px / 36px 50px 0 0;
    height: 4px;
    position: absolute;
    right: 0;
    top: -4px;
    width: 40px;
    z-index: 0;
}
.back-curve {
	background: none repeat scroll 0 0 #4C4B4B;
    border-radius: 960% 100% 0 0;
    height: 20px;
    left: -3px;
    position: absolute;
    top: 1px;
    transform: rotate(6deg);
    width: 5px;
}
.stepney {
	height: 6px;
    left: -4px;
    position: absolute;
    top: 6px;
    width: 8px;
    z-index: -1;
	background:#3f3f40;
}
.stepney:before {
	width:8px;
	height:12px;
	background:#3f3f40;
	content:'';
	position:absolute;
	top:-10px;
	left:-7px;
	border-radius:3px 3px 0 0;
}
.stepney:after {
	width:8px;
	height:12px;
	background:#0d0c0d;
	content:'';
	position:absolute;
	top:0px;
	left:-7px;
	border-radius:0 0 3px 3px;
}
.tyre-cover-front {
	background:#4c4b4b;
	height: 4px;
    left: 97px;
    position: absolute;
    top: 13px;
    width: 22px;
    z-index: 1;
}
.tyre-cover-front:before {
	background: none repeat scroll 0 0 #4c4b4b;
    content: "";
    display: inline-block;
    height: 21px;
    left: -10px;
    position: absolute;
    top: 0;
    transform: skewX(-30deg);
    width: 10px;
    z-index: 6;
	border-radius:4px 0 0 0;
}
.tyre-cover-front:after {
	background: none repeat scroll 0 0 #4c4b4b;
    content: "";
    display: inline-block;
    height: 6px;
    left: 14px;
    position: absolute;
    top: 0;
    transform: skewX(30deg);
    width: 17px;
    z-index: 6;
	border-radius:0 4px 2px 0;
}
.boundary-tyre-cover-inner-front {
	position:absolute;
	top:4px; left:4px;
	border-bottom: 16px solid black;
   	border-right: 10px solid transparent;
	height:0;
	width:15px;
	z-index:7;
}
.boundary-tyre-cover-inner-front:before {
	background: none repeat scroll 0 0 #000000;
    border-radius: 3px 3px 0 0;
    content: "";
    display: inline-block;
    height: 17px;
    left: -10px;
    position: absolute;
    top: 0;
    transform: skewX(-30deg);
    width: 15px;
}
.boundary-tyre-cover-inner-front:after {
	content:'';
	position:absolute;
	display:inline-block;
	background:black;
	height:16px;
	width:20px;
	-webkit-transform:skewx(25deg);
	-moz-transform:skewX(25deg);
	border-radius:3px 3px 0 0;
	right:-12px;
	top:0;
}
.base-axcel {
	background: none repeat scroll 0 0 black;
    bottom: -15px;
    height: 10px;
    left: 30px;
    position: absolute;
    transform: rotate(-2deg);
    width: 70px;
	z-index:-1;
}
.base-axcel:before {
	background: none repeat scroll 0 0 black;
    border-radius: 0 0 0 10px / 0 0 0 5px;
    content: "";
    height: 10px;
    left: -35px;
    position: absolute;
    top: -2px;
    transform: rotate(6deg);
    width: 30px;	
}
.base-axcel:after {
	background: none repeat scroll 0 0 black;
    border-radius: 0 0 0 10px / 0 0 0 5px;
    content: "";
    height: 10px;
    right: -33px;
    position: absolute;
    top: -1px;
    transform: rotate(-4deg);
    width: 40px;
	border-radius:0 10px 5px 0;	
}
.front-bumper {
	background: none repeat scroll 0 0 #4c4b4b;
    border-radius: 0 2px 2px 0;
    height: 8px;
    position: absolute;
    right: -15px;
    width: 11px;
    z-index: 1;
	-moz-transform:rotate(-5deg);
	-webkit-transform:rotate(-5deg);
}
.front-bumper:before {
	background: none repeat scroll 0 0 #000000;
    content: "";
    height: 10px;
    left: -7px;
    position: absolute;
    transform: rotate(-22deg);
    width: 9px;
    z-index: 1;
}
.car-shadow {
	background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    bottom: -15px;
    box-shadow: -5px 10px 15px 3px #000000;
    left: -7px;
    position: absolute;
    width: 136px;
}

</style>

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


<div class="country-wrap">

	

	
	<div class="street">
		<div class="car">

		<div class="car-body">
			<div class="car-top-back">
				<div class="back-curve"></div>
			</div>
			<div class="car-gate"></div>
			<div class="car-top-front">
				<div class="wind-sheild"></div>
			</div>
			<div class="bonet-front"></div>
			<div class="stepney"></div>
		</div>
		<div class="boundary-tyre-cover">
			<div class="boundary-tyre-cover-back-bottom"></div>
			<div class="boundary-tyre-cover-inner"></div>	
		</div>
		<div class="tyre-cover-front">
			<div class="boundary-tyre-cover-inner-front"></div>
		</div>
		<div class="base-axcel">
			
		</div>
		<div class="front-bumper"></div>
		<div class="tyre">		
			<div class="gap"></div>	
		</div>
		<div class="tyre front">
			<div class="gap"></div>	
		</div>
		<div class="car-shadow"></div>
	</div>
	</div>
	</div>
	
</div>

<section class="screen1">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="wrp1">
					<h1>
						THANKYOU FOR BOOKING YOUR RIDE WITH US
					</h1>
					<div class="wrp1_btn">
						<a class="btn" href="<?php echo $path;?>log_reg">Log In/Register</a>
						<a class="btn" href="<?php echo $path;?>">Search Your Ride</a>
					
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