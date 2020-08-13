<?php 
require_once 'inc/connection.php';
?>
<?php
session_start();
if(isset($_GET['tokenPassword']))
{       
        $tokenPassword=$_GET['tokenPassword'];
       // echo $tokenPassword;
	    $query="SELECT * FROM admins WHERE token='{$tokenPassword}' 
        UNION SELECT * FROM tourist WHERE token='{$tokenPassword}'
        UNION SELECT * FROM tourguide WHERE token='{$tokenPassword}'LIMIT 1";

        $result_set=mysqli_query($connection,$query);

        if($result_set)
        {
            if(mysqli_num_rows($result_set)==1)
            {
                $user=mysqli_fetch_assoc($result_set);
              // print_r($user);
                $_SESSION['email']=$user['email'];  
                $_SESSION['id']=$user['id'];
                header('location:reset_password.php');  
            }
            else{
                header('location:expire_email.php');
            }
        }
       
}
else
{
    header('location:forgot_password');
}
?>


