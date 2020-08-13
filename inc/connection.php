<?php 

$connection=mysqli_connect('localhost','root','','userdb');
	if(mysqli_connect_errno())
		die("Data base connection failed".mysqli_connect_errno());
	// else{
	// 	echo "Data base connection successfull";
	// }
 ?>