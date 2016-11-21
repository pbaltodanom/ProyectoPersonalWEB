<?php  
	include_once ('session.php');
	include_once ('connection_db.php');

	$connection = db_connect();

	$id = $_POST["id"];
	$text = $_POST["text"];
	$column_name = $_POST["column_name"];

	$sql = "UPDATE interest SET ".$column_name."='".$text."' WHERE id_interest='".$id."'";  
	if(mysqli_query($connection, $sql))   {  
		echo 'El interés fue actualizado';  
	}  else {
		echo 'Un error ha ocurrido';
	}
?> 