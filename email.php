<?php
	include "methods.php";
	if (!login()) {
		header("location:login.php");
		die();
	}
	$server_host = 'http://localhost:82/image/';
	if(isset($_POST['to']) && !empty($_POST['to']) && isset($_POST['Subject']) && isset($_POST['text-email'])){
		$to = $_POST['to'];
		$subject = $_POST['Subject'];
		$email = $_POST['text-email'];
		// $messgae = $email.
		$db = new DB();
		while (!isset($tracking_hash) || !$db->ask($q)) {
			$tracking_hash = sha1(uniqid(time(), true));
			$viewing_hash = sha1(uniqid(time(), true));
			$current_time = new Datetime("now");
			$q = "INSERT into tracking_details(hash, created_at, viewing_hash, receipt_email, messgae, subject) values('".$tracking_hash."', '".date_format($current_time,"Y/m/d H:i:s")."','".$viewing_hash."', '".$to."', '".$email."', '".$subject."')";
		}
		$messgae = $email.'<img src="'.$server_host.$tracking_hash.'" />';
		if(send_mail($to, $subject, $messgae)){
			$status = 9;
		}else{
			$status = 1;
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Send a email</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100" style="position: relative;padding: 2% 10%;">
				<div style="position: absolute;right: 2%;top: 2%;display: inline-flex;width: 250px;">
					<span style="width: 33%;padding: 2%; width: fit-content;"><a href="email" style="">Send a Mail</a></span>
					<span style="padding: 2%;width: 33%;"><a href="sent" style="">Sent Mails</a></span>
					<span style="padding: 2%;"><a href="logout" style="padding: 0px 10%;width: 33%;">Logout</a></span>
				</div>

				<form class="login100-form validate-form" method="post" action="email.php" style="width: inherit;">
					<span class="login100-form-title">Start Typing
						<?php
							if( isset($tracking_hash) ){
								if($status == 1){
									?>
									<p style=" margin-top: 4%; color: #f00; "> Email sendding faild </p>
									<?php
								}elseif($status == 9){
									?>
									<p style=" margin-top: 4%; color: #0f0; "> Email sent! </p>
									<?php									
								}
							}
						?>
					</span>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="to" required placeholder="To:">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-address-card" aria-hidden="true"></i>
						</span>
					</div>


					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="Subject" required placeholder="Subject:">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>


					<div class="wrap-input100 validate-input">
						<textarea class="input100" type="text" name="text-email" required="" placeholder="Start Typing your messgae:" spellcheck="true" style="height: 164px; padding-top: 3%;"></textarea>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Send Email
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							<!-- Forgot -->
						</span>
						<a class="txt2" href="#">
							<!-- Username / Password? -->
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							<!-- Create your Account -->
							<!-- <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> -->
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>