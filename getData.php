<?php
	include_once ('connection_db.php');

	$connection = db_connect();
	if (!empty($_POST["id_department"])) {
		$id_department = $_POST["id_department"];
		$query = "SELECT * FROM course WHERE id_department = $id_department";
		?>
		<?php
		$results = mysqli_query($connection, $query);
		if (mysql_num_rows($results)==0) { 
			?><option value="" selected="true" disabled="disabled">Elija un curso</option> 
			<option value="course4" onclick="showhide();">Nuevo Curso</a><?php
		}

		foreach ($results as $courses) { 
			?><option value="<?php echo $courses["id_course"]; ?>"><?php echo $courses["name_course"]; ?></option> <?php
		}
	}
?>