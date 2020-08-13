<?php require_once('inc/connection.php'); ?>
<?php 
require 'inc/function.php';
session_start();
	if (isset($_POST['password_message'])) {
		$userEmail=$_SESSION['email'];
		$token=$_SESSION['token'];
		$name=$_SESSION['first_name'];

	   sendPasswordResetLink($userEmail,$token,$name);
	   header('location:password_message.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Forgot password_message-Ceylon Trek</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/forgot_password.css">
</head>
<body style="background-image: url('img/ct1.jpg'); background-size:cover;background-position: center center;background-attachment: fixed; background-repeat:no-repeat;">
	<div class="password_message_box">
			<form action="password_message.php" method="post">
				<p>An email has been sent your email address to with a link to reset your password.<br><br> >>If you have not received the message,Please click on <b>Resend</b> button>></p>
				<button type="submit" name="password_message">Resend &raquo;</button>
				<a href="forgot_password.php">&laquo; Back</a>
			</form>

	</div><!-- password_message_box -->

</body>
</html>
<?php mysqli_close($connection);?>