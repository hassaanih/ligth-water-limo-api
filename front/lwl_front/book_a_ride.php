<!doctype html>
<html lang="en">

<head>
	<title>Home Page</title>
	<meta name="keywords" content="">
	<meta name="description" content="">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" />
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


	<?php
	$srcurl = "includes/";
	$basesurl = "assets/";
	?>




	<?php
	$style = $_SERVER['HTTP_HOST'];
	$style = $srcurl . "style.php";
	include($style);

	$urhere = "homepage";
	?>



</head>

<body class="hompg">
	<!--  <?php
			$header = $_SERVER['HTTP_HOST'];
			$header = $srcurl . "header.php";
			include($header);
			?> -->




	<section class="step1">
		<div class="container">
			<div class="row mai">
				<div class="col-md-12">
					<div class="stp1_wrp">


						<form id="msform" action="thankyou_for_booking.php">
							<!-- progressbar -->
							<ul id="progressbar">
								<li class="active" id="account"><strong>WHERE & WHEN</strong></li>
								<li id="personal"><strong>SELECT VEHICLE</strong></li>
								<li id="confirm"><strong>PAYMENT & CONFIRM</strong></li>
							</ul>
							<div class="progress">
								<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
							</div> <br>
							<!-- fieldsets -->
							<fieldset>

								<div class="row form-card frm1">
									<div class="col-md-7">
										<div class="row in">
											<div class="col-7">
												<h2 class="fs-title">WHERE & WHEN</h2>
											</div>
											<div class="col-5 my-auto">
												<h2 class="steps">Step 1 - 3</h2>
											</div>
										</div>
										<div class="row in1">
											<div class="col-md-6">
												<label for="pickupdate">* Pick Up Date:</label><input type="date" id="pick" name="pick" placeholder="Pick Up Date">
											</div>
											<div class="col-md-6">
												<label for="appt">* Pickup time:</label><br>
												<input type="time" id="time" name="time">
											</div>
										</div>
										<div class="row in2">
											<div class="col-md-12">


												<div class="for">
													<label for="exampleInputEmail1">Pickup Location</label>
													<input type="text" class="form-control" id="ploc">
												</div>
												<div class="for">
													<label id="addEmail" class="link">Add Additional Pickup Location</label>
													<label id="removeEmail" class="link">Remove Additional Pickup Location</label>

												</div>
												<div id="more-email"></div>
											</div>
										</div>
										<script>
											$(document).ready(function() {
												$("#addEmail").on("click", function() {
													$("#more-email").append("<div class='for'><input type='text' class='form-control' id='' placeholder='Add Additional Pickup Location'/></div>");
												});
												$("#removeEmail").on("click", function() {
													$("#more-email").children().last().remove();
												});

											});
										</script>
										<div class="row in3">
											<div class="col-md-12">
												<label for="address">* Dropoff Location:</label>
												<br><input type="text" id="daddress" name="daddress">
											</div>
										</div>
										<div class="row in4">
											<div class="col-md-4">
												<label for="address">*Travellers:</label>
												<div class="quantity buttons_added">
													<input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="" id="travellerNumber"><input type="button" value="+" class="plus">
												</div>
											</div>
											<div class="col-md-4">
												<label for="address">*Kids:</label>
												<div class="quantity buttons_added">
													<input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="" id="kidsNumber"><input type="button" value="+" class="plus">
												</div>
											</div>
											<div class="col-md-4">
												<label for="address">*Bags:</label>
												<div class="quantity buttons_added">
													<input type="button" value="-" class="minus"><input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="" id="bagsNumber"><input type="button" value="+" class="plus">
												</div>
											</div>
										</div>
										<input type="hidden" id="totalkm">





									</div>
									<div class="col-md-5 ">
										<div class="maph">
											<h4>Check Your Distance Here</h4>
										</div>
										<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d190255.43573808152!2d-87.89677028127798!3d41.83387098157715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880e2c3cd0f4cbed%3A0xafe0a6ad09c0c000!2sChicago%2C%20IL%2C%20USA!5e0!3m2!1sen!2s!4v1681852790549!5m2!1sen!2s" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
									</div>
								</div>

								<input type="button" name="next" class="next action-button submit-details" value="Next" />
							</fieldset>










							<fieldset>

								<!-- POPUP MODAL FOR SEDAN -->
								<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLongTitle">SEDAN</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="col-md-12">
														<div class="img_pop">
															<img src="assets/images/sedan1.jpg">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="info_pop">
															<span class="icon"><i class="fa fa-users" aria-hidden="true"></i>2</span>
															<span class="icon"><i class="fa fa-suitcase" aria-hidden="true"></i>3</span>
														</div>
													</div>
													<div class="col-md-6">
														<div class="info2_pop">
															<h4>$1,306.28</h4>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<p> <strong> Disclaimer: </strong> Your Credit card will be charged at time of booking. This is an esitmation of cost and prices may differ at time of completion of trip. Thank you!</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- POP MODAL END -->
								<!-- POPUP MODAL FOR SUV -->
								<div class="modal fade" id="exampleModalCenterSuv" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLongTitle">SUV</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="col-md-12">
														<div class="img_pop">
															<img src="assets/images/suv1.jpg">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="info_pop">
															<span class="icon"><i class="fa fa-users" aria-hidden="true"></i>2</span>
															<span class="icon"><i class="fa fa-suitcase" aria-hidden="true"></i>3</span>
														</div>
													</div>
													<div class="col-md-6">
														<div class="info2_pop">
															<h4>$1,306.28</h4>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<p> <strong> Disclaimer: </strong> Your Credit card will be charged at time of booking. This is an esitmation of cost and prices may differ at time of completion of trip. Thank you!</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- POP MODAL END -->
								<!-- POPUP MODAL FOR OTHER -->
								<div class="modal fade" id="exampleModalCenterOther" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLongTitle">CARS WE HAVE</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="col-md-12">
														<div class="img_pop">
															<div class="cs-slider">
																<div><img src="assets/images/sedan1.jpg">

																</div>
																<div><img src="assets/images/sedan1.jpg"></div>
																<div><img src="assets/images/sedan1.jpg"></div>
																<div><img src="assets/images/sedan1.jpg"></div>
																<div><img src="assets/images/sedan1.jpg"></div>
															</div>
															<script>
																$(".cs-slider").slick({
																	dots: true,
																	arrows: false,
																	infinite: true,
																	speed: 1000,
																	slidesToShow: 1,
																	autoplay: true,
																	autoplaySpeed: 300,
																	adaptiveHeight: true,
																	lazyLoad: 'ondemand',
																	slidesToScroll: 1

																});
															</script>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-12">
														<p> <strong> Disclaimer: </strong> Your Credit card will be charged at time of booking. This is an esitmation of cost and prices may differ at time of completion of trip. Thank you!</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- POP MODAL END -->
								<div class="form-card frm2">
									<div class="row">
										<div class="col-7">
											<h2 class="fs-title">SELECT VEHICLE</h2>
										</div>
										<div class="col-5">
											<h2 class="steps">Step 2 - 3</h2>
										</div>
									</div>


									<div class="row fi1">
										<div class="col-md-7">
											<div class="col-md-12">
												<h3 data-toggle="modal" data-target="#kkkkkkkk">Select vehicle type by clicking on vehicle image</h3>
											</div>
											<div class="car_sel">

												<div class="col-md-12">
													<input type="hidden" value="1" class="_vehicleTypeId notranslate" id="_vehicle_1">
													<input type="hidden" value="Sedan" class="_vehicleSummary notranslate">
													<input type="hidden" value="false" class="_vehicleZeroRateDisableBooking notranslate">
													<button type="button" class="car picked">

														<div class="pop">
															<a type="popu" class="popp" data-toggle="modal" data-target="#exampleModalCenter"><span class="icon info" title="More Info"><i class="fa fa-info"></i></span></a>

														</div>

														<div class="car_img">
															<img src="assets/images/sedan.png">
														</div>
														<div class="car-info">
															<p>Sedan</p>
														</div>
														<div class="car-volume">
															<span class="icon"><i class="fa fa-users" aria-hidden="true"></i>2</span>
															<span class="icon"><i class="fa fa-suitcase" aria-hidden="true"></i>3</span>
														</div>
														<div class="car-price _vehiclePrice"><ins>USD</ins>$1,306.28</div>
													</button>
												</div>
												<div class="col-md-12">
													<input type="hidden" value="1" class="_vehicleTypeId notranslate" id="_vehicle_1">
													<input type="hidden" value="Sedan" class="_vehicleSummary notranslate">
													<input type="hidden" value="false" class="_vehicleZeroRateDisableBooking notranslate">
													<button type="button" class="car picked">
														<div class="pop">
															<a type="popu" class="popp" data-toggle="modal" data-target="#exampleModalCenterSuv"><span class="icon info" title="More Info"><i class="fa fa-info"></i></span></a>

														</div>

														<div class="car_img">
															<img src="assets/images/sedan.png">
														</div>
														<div class="car-info">
															<p>SUV</p>
														</div>
														<div class="car-volume">
															<span class="icon"><i class="fa fa-users" aria-hidden="true"></i>2</span>
															<span class="icon"><i class="fa fa-suitcase" aria-hidden="true"></i>3</span>
														</div>
														<div class="car-price _vehiclePrice"><ins>USD</ins>$1,306.28</div>
													</button>
												</div>
												<div class="col-md-12">
													<input type="hidden" value="1" class="_vehicleTypeId notranslate" id="_vehicle_1">
													<input type="hidden" value="Sedan" class="_vehicleSummary notranslate">
													<input type="hidden" value="false" class="_vehicleZeroRateDisableBooking notranslate">
													<button type="button" class="car picked own">
														<div class="pop">
															<a type="popu" class="popp" data-toggle="modal" data-target="#exampleModalCenterOther"><span class="icon info" title="More Info"><i class="fa fa-info"></i></span></a>

														</div>
														<!-- <div class="car_img">
                 								<img src="assets/images/sedan.png">
                 							</div> -->
														<div class="car-info">
															<p>Choose Your Own Car</p>
														</div>
														<!-- <div class="car-volume">
                      							<span class="icon"><i class="fa fa-users" aria-hidden="true"></i>2</span>
                        						<span class="icon"><i class="fa fa-suitcase" aria-hidden="true"></i>3</span>
                    						</div>
                    						<div class="car-price _vehiclePrice"><ins>USD</ins>$1,306.28</div> -->
													</button>
												</div>
											</div>
										</div>
										<div class="col-md-5">
											<h3>BOOKING SUMMARY</h3>
											<div class="book">
												<div class="pdate">
													<div class="row">
														<div class="col-md-6">
															<h4>Pickup Date</h4>
														</div>
														<div class="col-md-6">
															<p>10-2-2020</p>
														</div>
													</div>
												</div>

												<div class="ptime">
													<div class="row">
														<div class="col-md-6">
															<h4>Pickup time</h4>
														</div>
														<div class="col-md-6">
															<p>10:00 AM</p>
														</div>
													</div>
												</div>

												<div class="ploc">
													<div class="row">
														<div class="col-md-6">
															<h4>Pickup Location</h4>
														</div>
														<div class="col-md-6">
															<p>Lorem Ipsum</p>
														</div>
													</div>
												</div>

												<div class="dloc">
													<div class="row">
														<div class="col-md-6">
															<h4>Dropoff Location</h4>
														</div>
														<div class="col-md-6">
															<p>Lorem Ipsum</p>
														</div>
													</div>
												</div>

												<div class="pass">
													<div class="row">
														<div class="col-md-6">
															<h4>No. Of Passenger</h4>
														</div>
														<div class="col-md-6">
															<p>2</p>
														</div>
													</div>
												</div>

												<div class="kid">
													<div class="row">
														<div class="col-md-6">
															<h4>No. Of Childern</h4>
														</div>
														<div class="col-md-6">
															<p>1</p>
														</div>
													</div>
												</div>

												<div class="bag">
													<div class="row">
														<div class="col-md-6">
															<h4>No. Of Bags</h4>
														</div>
														<div class="col-md-6">
															<p>2</p>
														</div>
													</div>
												</div>

												<div class="lne"></div>
												<div class="amount">
													<div class="row">
														<div class="col-md-6">
															<h4>Total</h4>
														</div>
														<div class="col-md-6">
															<h4>$1240.20</h4>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
								<input type="button" name="next" class="next action-button" value="Next" />
							</fieldset>

							<fieldset>
								<div class="form-card frm3">

									<div class="row">
										<div class="col-7">
											<h2 class="fs-title">PAYMENT & CONFIRM:</h2>
										</div>
										<div class="col-5">
											<h2 class="steps">Step 3 - 3</h2>
										</div>
									</div>
									<div class="row">
										<div class="col-md-7">
											<div class="pinfo">
												<h4>Passenger Info</h4>
												<div class="row">
													<input type="hidden" name="booking-detail-id" id="booking-detail-id">

													<div class="col-md-6">
														<input type="text" name="pfname" id="pfname" placeholder="*First Name">
													</div>
													<div class="col-md-6">
														<input type="text" name="plname" id="plname" placeholder="*Last Name">
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<input type="tel" name="ptel" id="ptel" placeholder="*Mobile Phone">
													</div>
													<div class="col-md-6">
														<input type="email" name="pemail" id="pemail" placeholder="*Email Address">
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<input type="text" name="cname" id="cname" placeholder="*Contact Name">
													</div>
													<div class="col-md-6">
														<input type="tel" name="ctel" id="ctel" placeholder="*Contact Phone">
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<input type="email" name="cemail" id="cemail" placeholder="*Contact Email">
													</div>
													<div class="col-md-6">
														<input type="text" name="tip" id="tip" placeholder="*Enter Tip For the Driver">
													</div>
												</div>
											</div>


											<div class="payop">
												<h4>Payment Info</h4>
												<div class="row">
													<div class="col-md-6">


														<input type="text" id="owner" placeholder="Card Holder Name">

													</div>
													<div class="col-md-6">


														<input type="text" id="cvv" placeholder="CVV">

													</div>
												</div>


												<input type="text" id="cardNumber" placeholder="Credit Card Number">

												<div class="form-group" id="expiration-date">
													<label class="ex">Select Expiry Date</label> <br>
													<select class="mnth">
														<option value="01">January</option>
														<option value="02">February </option>
														<option value="03">March</option>
														<option value="04">April</option>
														<option value="05">May</option>
														<option value="06">June</option>
														<option value="07">July</option>
														<option value="08">August</option>
														<option value="09">September</option>
														<option value="10">October</option>
														<option value="11">November</option>
														<option value="12">December</option>
													</select>
													<select class="yrs">
														<option value="16"> 2016</option>
														<option value="17"> 2017</option>
														<option value="18"> 2018</option>
														<option value="19"> 2019</option>
														<option value="20"> 2020</option>
														<option value="21"> 2021</option>
														<option value="22"> 2022</option>
														<option value="23"> 2023</option>
														<option value="24"> 2024</option>
														<option value="25"> 2025</option>
														<option value="26"> 2026</option>
														<option value="27"> 2027</option>
														<option value="28"> 2028</option>
														<option value="29"> 2029</option>
														<option value="30"> 2030</option>
													</select>
												</div>
											</div>

											<div class="xtra">
												<h4>Special Instructions</h4>
												<textarea id="instr" name="instr" placeholder="Instructions"></textarea>
											</div>

										</div>
										<div class="col-md-5">
											<h3>BOOKING SUMMARY</h3>
											<div class="book">
												<div class="pdate">
													<div class="row">
														<div class="col-md-6">
															<h4>Pickup Date</h4>
														</div>
														<div class="col-md-6">
															<p>10-2-2020</p>
														</div>
													</div>
												</div>

												<div class="ptime">
													<div class="row">
														<div class="col-md-6">
															<h4>Pickup time</h4>
														</div>
														<div class="col-md-6">
															<p>10:00 AM</p>
														</div>
													</div>
												</div>

												<div class="ploc">
													<div class="row">
														<div class="col-md-6">
															<h4>Pickup Location</h4>
														</div>
														<div class="col-md-6">
															<p>Lorem Ipsum</p>
														</div>
													</div>
												</div>

												<div class="dloc">
													<div class="row">
														<div class="col-md-6">
															<h4>Dropoff Location</h4>
														</div>
														<div class="col-md-6">
															<p>Lorem Ipsum</p>
														</div>
													</div>
												</div>

												<div class="pass">
													<div class="row">
														<div class="col-md-6">
															<h4>No. Of Passenger</h4>
														</div>
														<div class="col-md-6">
															<p>2</p>
														</div>
													</div>
												</div>

												<div class="kid">
													<div class="row">
														<div class="col-md-6">
															<h4>No. Of Childern</h4>
														</div>
														<div class="col-md-6">
															<p>1</p>
														</div>
													</div>
												</div>

												<div class="bag">
													<div class="row">
														<div class="col-md-6">
															<h4>No. Of Bags</h4>
														</div>
														<div class="col-md-6">
															<p>2</p>
														</div>
													</div>
												</div>
												<div class="car_selec">
													<div class="row">
														<div class="col-md-6">
															<h4>Car Selected</h4>
														</div>
														<div class="col-md-6">
															<p>SUV</p>
														</div>
													</div>
												</div>
												<div class="pname">
													<div class="row">
														<div class="col-md-6">
															<h4>Name</h4>
														</div>
														<div class="col-md-6">
															<p>Lorem</p>
														</div>
													</div>
												</div>
												<div class="pemail">
													<div class="row">
														<div class="col-md-6">
															<h4>Email Address</h4>
														</div>
														<div class="col-md-6">
															<p>Lorem@ipsum.com</p>
														</div>
													</div>
												</div>
												<div class="card">
													<div class="row">
														<div class="col-md-6">
															<h4>Card Number</h4>
														</div>
														<div class="col-md-6">
															<p>xxxxxxxxxxx</p>
														</div>
													</div>
												</div>
												<div class="cvv">
													<div class="row">
														<div class="col-md-6">
															<h4>CVV</h4>
														</div>
														<div class="col-md-6">
															<p>xxx</p>
														</div>
													</div>
												</div>

												<div class="lne"></div>
												<div class="amount">
													<div class="row">
														<div class="col-md-6">
															<h4>Total</h4>
														</div>
														<div class="col-md-6">
															<h4>$1240.20</h4>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
								<!-- href="https://localhost/junaid/thankyou_for_booking" -->
								<a><input type="submit" name="sub" class="next action-button submit_btn submit" value="Confirm" /></a>
							</fieldset>

						</form>

					</div>
				</div>
			</div>
		</div>
	</section>



	<!-- <?php
			$footer = $_SERVER['HTTP_HOST'];
			$footer = $srcurl . "footer.php";
			include($footer);
			?> -->

	<script type="text/javascript">
		// PLUS MINUS BUTTON

		function wcqib_refresh_quantity_increments() {
			jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
				var c = jQuery(b);
				c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
			})
		}
		String.prototype.getDecimals || (String.prototype.getDecimals = function() {
			var a = this,
				b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
			return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
		}), jQuery(document).ready(function() {
			wcqib_refresh_quantity_increments()
		}), jQuery(document).on("updated_wc_div", function() {
			wcqib_refresh_quantity_increments()
		}), jQuery(document).on("click", ".plus, .minus", function() {
			var a = jQuery(this).closest(".quantity").find(".qty"),
				b = parseFloat(a.val()),
				c = parseFloat(a.attr("max")),
				d = parseFloat(a.attr("min")),
				e = a.attr("step");
			b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
		});








		// STEP FORM 
		$(document).ready(function() {

			var current_fs, next_fs, previous_fs; //fieldsets
			var opacity;
			var current = 1;
			var steps = $("fieldset").length;

			setProgressBar(current);

			

			$(".next").click(function() {
				
				current_fs = $(this).parent();
				next_fs = $(this).parent().next();

				//Add Class Active
				$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

				//show the next fieldset
				next_fs.show();
				//hide the current fieldset with style
				current_fs.animate({
					opacity: 0
				}, {
					step: function(now) {
						// for making fielset appear animation
						opacity = 1 - now;

						current_fs.css({
							'display': 'none',
							'position': 'relative'
						});
						next_fs.css({
							'opacity': opacity
						});
					},
					duration: 500
				});
				setProgressBar(++current);
			});

			$(".previous").click(function() {

				current_fs = $(this).parent();
				previous_fs = $(this).parent().prev();

				//Remove class active
				$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

				//show the previous fieldset
				previous_fs.show();

				//hide the current fieldset with style
				current_fs.animate({
					opacity: 0
				}, {
					step: function(now) {
						// for making fielset appear animation
						opacity = 1 - now;

						current_fs.css({
							'display': 'none',
							'position': 'relative'
						});
						previous_fs.css({
							'opacity': opacity
						});
					},
					duration: 500
				});
				setProgressBar(--current);
			});

			function setProgressBar(curStep) {
				var percent = parseFloat(100 / steps) * curStep;
				percent = percent.toFixed();
				$(".progress-bar")
					.css("width", percent + "%")
			}

			$(".submit").click(function() {
				var data = {
					first_name: "Hassaan",
					last_name: $('#plname').val(),
					contact_name: $('#cname').val(),
					contact_phone: $('#ctel').val(),
					mobile_number: $('#ptel').val(),
					email: $('#pemail').val(),
					tip_for_driver: $('#tip').val(),
					booking_detail_id: $('#booking-detail-id').val()
				};





				$('#cemail').val


				$.ajax({
					url: "http://localhost/ligth-weight-limo-api/public/api/booking/create",
					type: "POST",
					data: data,
					dataType: "json",
					success: function(result) {
						// result contains the response from the server-side PHP script
						// you can use this result to update the UI or perform other operations
						console.log(result);
					},
					error: function(error) {
						console.log("Error: " + error);
					}
				});
				return false;
			})
			$(".submit-details").click(function() {
				var data = {
					pickup_date: $('#pick').val(),
					pickup_time: $('#time').val(),
					pickup_location: $('#ploc').val(),
					drop_location: $('#daddress').val(),
					travellers: $('#travellerNumber').val(),
					kids: $('#kidsNumber').val(),
					bags: $('#bagsNumber').val(),
					total_km: 32
				};

				$.ajax({
					url: "http://localhost/ligth-weight-limo-api/public/api/booking/details/create",
					type: "POST",
					data: data,
					dataType: "json",
					success: function(result) {
						// result contains the response from the server-side PHP script
						// you can use this result to update the UI or perform other operations
						
						console.log(result);
					},
					error: function(error) {
						console.log("Error: " + error);
					}
				});
			});

		});
	</script>



</body>

</html>