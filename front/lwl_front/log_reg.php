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
				<div class="wrapper">
  <div class="title-text">
    <div class="title login">
      Login Form
    </div>
    <div class="title signup">
      Signup Form
    </div>
  </div>
  <div class="form-container">
    <div class="slide-controls">
      <input type="radio" name="slide" id="login" checked>
      <input type="radio" name="slide" id="signup">
      <label for="login" class="slide login">Login</label>
      <label for="signup" class="slide signup">Signup</label>
      <div class="slider-tab"></div>
    </div>
    <div class="form-inner">
      <form action="#" class="login">
        <div class="field">
          <input type="text" placeholder="Email Address" required>
        </div>
        <div class="field">
          <input type="password" placeholder="Password" required>
        </div>
        <div class="pass-link">
          <a href="#">Forgot password?</a>
        </div>
        <div class="field btn">
          <div class="btn-layer"></div>
          <input type="submit" value="Login">
        </div>
        <div class="signup-link">
          Not a member? <a href="">Signup now</a>
        </div>
      </form>
      <form action="#" class="signup">
        <div class="field">
          <input type="text" placeholder="Email Address" required>
        </div>
        <div class="field">
          <input type="password" placeholder="Password" required>
        </div>
        <div class="field">
          <input type="password" placeholder="Confirm password" required>
        </div>
        <div class="field btn">
          <div class="btn-layer"></div>
          <input type="submit" value="Signup">
        </div>
      </form>
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

<script>
const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link a");
signupBtn.onclick = (()=>{
  loginForm.style.marginLeft = "-50%";
  loginText.style.marginLeft = "-50%";
});
loginBtn.onclick = (()=>{
  loginForm.style.marginLeft = "0%";
  loginText.style.marginLeft = "0%";
});
signupLink.onclick = (()=>{
  signupBtn.click();
  return false;
});
</script>


</body>
</html>