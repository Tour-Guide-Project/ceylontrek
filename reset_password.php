<?php  require_once 'inc/connection.php';?>
<?php
require 'inc/function.php';
session_start();

	if(isset($_POST['submit']))
	{
		$errors=array();
		$newPassword=$_POST['newpassword'];
		$confirmPassword=$_POST['confirmpassword'];

		if(empty($newPassword || $confirmPassword))
		{
			$errors[]="Password required!";
		}
		if($newPassword != $confirmPassword)
		{
			$errors[]="Please enter the same password!";
		}
		if((strlen(trim($newPassword))<6))
		{
	        $errors[]="Password must contain at least 6 characters!";
		}
	    if(empty($errors))
	    {
			$hashed_password = sha1($confirmPassword);
			$email=$_SESSION['email'];
			$level=$_SESSION['level'];
	        $newtoken= bin2hex(random_bytes(50));
	                        
			$query="UPDATE ".$level." SET password='{$hashed_password}',token='{$newtoken}' WHERE email='{$email}' Limit 1";

			$result_set=mysqli_query($connection,$query);
	            if($result_set)
	            {
					header('location:login.php'); 
	            }
	            else
	            {
	                header('location:reset_password.php');
	            }
	                       
	    }
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Reset password-Ceylon Trek</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/reset_password.css">
</head>
<body style="background-image: url('img/ct2.jpg'); background-size:cover;background-position: center center;background-attachment: fixed; background-repeat:no-repeat;">
	<div class="reset_password_box">
			<h1>Reset Password</h1>
			<form action="reset_password.php" method="post">
				<?php 
					if(isset($_POST['submit'])){
			            if(empty($newPassword) || empty($confirmPassword))
						{
							echo '<p  class="error">Password requried!</p>';
						}
			       
			        	if($newPassword != $confirmPassword)
						{
							echo '<p class="error">Please enter the same password!</p>';
						}
						if((strlen(trim($newPassword))<6))
						{
					        echo '<p class="error">Password must contain at least 6 characters!</p>';
						}
					}
				?>
				<div class="text_box">
					<i class="fa fa-lock fa-2x" aria-hidden="true"></i>
					<input type="password" name="newpassword" placeholder="New Password" id="myInput1" >
					<span class="eye" onclick="myFunction1()">
						<i id="hide1" class="fa fa-eye"></i>
						<i id="hide2" class="fa fa-eye-slash"></i>
					</span>
					<script>
						function myFunction1(){
							var x=document.getElementById("myInput1");
							var y=document.getElementById("hide1");
							var z=document.getElementById("hide2");
						
						if(x.type === "password"){
							x.type ="text";
							y.style.display = "block";
							z.style.display = "none";
						}
						else{
							x.type ="password";
							y.style.display = "none";
							z.style.display = "block";
						}
					}
					</script>
				</div><!-- text_box -->	

				<div class="text_box">
					<i class="fa fa-lock fa-2x" aria-hidden="true"></i>
					<input type="password" name="confirmpassword" placeholder="Confirm Password" id="myInput2">
					<span class="eye" onclick="myFunction2()">
						<i id="hide-1" class="fa fa-eye"></i>
						<i id="hide-2" class="fa fa-eye-slash"></i>
					</span>
					<script >
						function myFunction2(){
							var x=document.getElementById("myInput2");
							var y=document.getElementById("hide-1");
							var z=document.getElementById("hide-2");
						
							if(x.type === "password"){
								x.type ="text";
								y.style.display = "block";
								z.style.display = "none";
							}
							else{
								x.type ="password";
								y.style.display = "none";
								z.style.display = "block";
							}
						}
					</script>
				</div><!-- text_box -->	
				<a href="Login.php">&laquo; Back</a>

				<button type="submit" name="submit">Submit</button>
			
			</form>

	</div><!-- reset_password_box -->
</body>
</html>
<?php mysqli_close($connection);?>
