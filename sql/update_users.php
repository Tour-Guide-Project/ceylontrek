<?php require_once('C:/xampp/htdocs/ceylon trek/inc/connection.php'); ?>
<?php 
   /*  UPDATE table name
   	   SET column 1=value1,column2=value2
   	   WHERE column_name=value
   	   LIMIT 1
	*/
         $newtoken= bin2hex(random_bytes(50));
   	   $query= "UPDATE user SET token='{$newtoken}' WHERE id=4";
   	   $result_set=mysqli_query($connection,$query);

   	   //mysqli_affected_rows($connection)==returns no of record of row affected
   	   if($result_set)
   	   {
   	   	echo mysqli_affected_rows($connection)." Record updated";
   	   }
   	   else
   	   {
   	   	echo "Database query failed";
   	   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>update_query</title>
</head>
<body>
	
</body>
</html>
<?php mysqli_close($connection); ?>