<?php require_once('inc/connection.php'); ?>
<?php 
//check the sumbit button has been pressed
if (isset($_POST['submit'])) {

	$errors = array();

	//check usrrname and password has been entered
	if(!isset($_POST['email']) || strlen(trim($_POST['email']))<1){
		$errors[]= 'Username is required/Invalid';
	}

	if(!isset($_POST['password']) || strlen(trim($_POST['password']))<1){
		$errors[]= 'Password is required/Invalid';
	}

	//check if there are any errors
	if (empty($errors)) 
	{
		//save the username and password into the variables
		$email=mysqli_real_escape_string($connection,$_POST['email']);
		$password=mysqli_real_escape_string($connection,$_POST['password']);
		$hashed_password=sha1($password);

		//prepare database query
		$query= "SELECT * FROM admins WHERE email='{$email}' AND password='{$hashed_password}'
		UNION  SELECT * FROM tourguide WHERE email='{$email}' AND password='{$hashed_password}'
		UNION  SELECT * FROM tourist WHERE email='{$email}' AND password='{$hashed_password}'
		LIMIT 1"; 

		$result_set=mysqli_query($connection,$query);
			
		if($result_set)
		{
			//query successfull
			if (mysqli_num_rows($result_set)==1)
			{
				//valid user found
				$record=mysqli_fetch_assoc($result_set);
				//print_r($record);
				if($record['level']=='admins')
				{
					header('Location: home-admin.php');
				}
				elseif($record['level']=='tourist')
				{
					header('Location: home-tourist.php');
				}
				elseif($record['level']=='tourguide')
				{
					header('Location: home-tour-guide.php');
				}  
			}else
			{
				//user name and password invalid
				$errors[]='Invalid Username /Password';
			}
					
		}
		else
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
	<title>Log In-Ceylon Trek</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body style="background-image: url('img/ct.jpg'); background-size:cover;background-position: center center;background-attachment: fixed; background-repeat:no-repeat;">
	<div class="login_box">
		<form action="login.php" method="post">
			<h1>Login</h1>
			<?php 
			if(isset($errors)&& !empty($errors))
			{
				echo '<p class="error">Invalid Username/Password</p>';
			 
			}
			?>
			<div class="text_box one focus">
				<div class="i">
					<i class="fa fa-user fa-2x" aria-hidden="true"></i>
				</div><!-- i class -->
				<div>
					<h5>Username</h5>
					<input class="input" type="text" name="email" placeholder="Email Address" required="">
				</div>
			</div><!-- text_box -->	

			<div class="text_box two focus">
				<div class="i">
					<i class="fa fa-lock fa-2x" aria-hidden="true"></i>
				</div><!-- i class -->
				<div>
					<h5>Password</h5>
					<input class="input" type="password" name="password" placeholder="password" required="">
				</div>
			</div><!-- text_box -->	

			<button type="submit" name="submit">Log in</button>

			<a href="forgot_password.php">Forgot Password?</a>

			<p>Don't have an account yet? <a href="sign_up.php">Sign up</a></p>
			
			</form>

	</div><!-- login_box -->

</body>
<script type="text/javascript" src="js/jscript.js"></script>
</html>
<?php mysqli_close($connection);?>