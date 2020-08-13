<?php require_once('inc/connection.php'); ?>
<?php 
require 'inc/function.php';
session_start();

// $to="kavindyadewindi12345678@gmail.com";
// $subject="tour guide group pro"; 
// $message="Kavi hiiii";
// mail($to, $subject, $message);
//if click forgot_password?
if (isset($_POST['forgot_password'])) {
	$errors = array();

	//check username(email) has been entered
	if(!isset($_POST['email']) || strlen(trim($_POST['email']))<1){
		$errors[]= 'Username is required/Invalid';
	}
	//check if there are any errors
	if (empty($errors)) {
		//save the username into the variables
		$email=mysqli_real_escape_string($connection,$_POST['email']);
		//prepare database query
		$query= "SELECT * FROM admins WHERE email='{$email}' 
		UNION SELECT * FROM tourist WHERE email='{$email}'
		UNION SELECT * FROM tourguide WHERE email='{$email}' LIMIT 1";

		$result_set=mysqli_query($connection,$query);

		if ($result_set) {
			#//query successfull
			if (mysqli_num_rows($result_set)==1)
			{
				//valid user found
				$user=mysqli_fetch_assoc($result_set);
				$userEmail=$user['email'];
				$token=$user['token'];
				$name=$user['first_name'];
				$level=$user['level'];

				$_SESSION['email']=$userEmail;
				$_SESSION['token']=$token;
				$_SESSION['first_name']=$name;
				$_SESSION['level']=$level;

				sendPasswordResetLink($userEmail,$token,$name);  
				header('location:password_message.php');
			}else
			{
				//user name invalid
				$errors[]='Invalid Email Address';
			}
					
		}else
		{
			$errors[]='Database query failed';
		} 
	}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Forgot password-Ceylon Trek</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/forgot_password.css">
</head>
<body style="background-image: url('img/ct1.jpg'); background-size:cover;background-position: center center;background-attachment: fixed; background-repeat:no-repeat;">
	<div class="forgot_box">
			<h1>Forgot Password?</h1>
			<form action="forgot_password.php" method="post">
				<p>Please enter your email address.You will receive a link to reset your password via email.</p>
				<div class="text_box">
					<label>Email-Address</label>

					<?php 
						if(isset($_POST['forgot_password'])){
			                            
			                if(!isset($_POST['email']) || strlen(trim($_POST['email']))<1){
								echo '<p class="error"> Email address requried!</p>';
			                }
			                elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
			                    echo '<p class="error">Invalid email address!</p>';
			                } 
							else{
							echo '<p class="error"> You have not an account in this email address! </p>';        
			                }
			            }
           			 ?>   

					<input type="text" name="email" placeholder="eg:kavindyadewindi@gmail.com">
				</div><!-- text_box -->	
				<a href="Login.php">&laquo; Back</a>

				<button type="submit" name="forgot_password">Send &raquo;</button>
			
			</form>

	</div><!-- forgot_box -->

</body>
</html>
<?php mysqli_close($connection);?>