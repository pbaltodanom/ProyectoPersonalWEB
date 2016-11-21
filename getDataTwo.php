<?php
	include_once ('connection_db.php');

	$connection = db_connect();
	if (!empty($_POST["id_department"])) {
		$id_department = $_POST["id_department"];
		$query = "SELECT * FROM professor WHERE id_department = $id_department";
		?>
		<?php
		$results = mysqli_query($connection, $query);
		if (mysql_num_rows($results)==0) { 
			?><option value="" selected="true" disabled="disabled">Elija un profesor</option><?php		
		}

		foreach ($results as $professor) { 
			?><option value="<?php echo $professor["id_professor"]; ?>"><?php echo $professor["name_professor"]; ?></option> <?php
		}
	}
?>