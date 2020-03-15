<?php
	include "methods.php";
	if (!login()) {
		header("location:login.php");
		die();
	}
	$db = new DB();
	$data = "SELECT * from tracking_details order by id desc";
	$data = $db->convert($db->ask($data));
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sent mails</title>
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
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
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
				<form class="login100-form validate-form"  style="width: inherit;">
					<span class="login100-form-title">Sent mails
					</span>
					<table id="sent_mails" class="display">
					    <thead>
					        <tr>
					            <th>Sl</th>
					            <th>To</th>
					            <th>Read at</th>
					            <th>Views</th>
					            <th>Sent at</th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php
					    		$i=1;
					    		foreach ($data as $key => $value) {
					    			?>
					    			<tr>
							            <td><?php echo $i++; ?></td>
							            <td><?php echo $value['receipt_email']; ?></td>
							            <td><?php echo $value['read_time']; ?></td>
							            <td><?php echo $value['views']; ?></td>
							            <td><?php echo $value['created_at']; ?></td>
							        </tr>
					    			<?php
					    		}
					        ?>
					    </tbody>
					</table>
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
	<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
		$(document).ready( function () {
		    $('#sent_mails').DataTable();
		} );
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>