<?php  
	include_once ('session.php');
	include_once ('connection_db.php');

	$connection = db_connect();

	$sql = "INSERT INTO interest(name_interest, description_interest, other_info) 
	VALUES('".$_POST["name_interest"]."', '".$_POST["description_interest"]."', '".$_POST["other_info"]."')";	

	if(mysqli_query($connection, $sql)) {  
		echo 'Nuevo interest agregado';  
	}  
?> 