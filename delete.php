<?php
	include_once ('session.php');
	include_once ('connection_db.php');

	$connection = db_connect();
	$sql = "DELETE FROM interest WHERE id_interest = '".$_POST["id"]."'";  
	
	if(mysqli_query($connection, $sql))   {  
		echo 'El interés ha sido eliminado';  
	}  else {
		echo 'Ha ocurrido un error';
	}
?> 