<?php
	include_once ('session.php');
	include_once ('connection_db.php');

	if(isset($_POST["submit"])) {  
		$cont = 0;
		$projectTechnologies = "";
	    echo '<h3>You have select following language</h3>';  
	    foreach($_POST["language"] as $language) {
	        $cont = $cont + 1;
	        $projectTechnologies .= $cont." ";
	    }

	    echo $projectTechnologies;

		$courseID = $_POST['idCourse'];
		$projectName = $_POST['pname'];
		$projectSummary = $_POST['psummary'];
		$projectDescription = $_POST['pdesc'];
		$projectType = $_POST['ptype'];
		//$projectTechnologies = $_POST['courseSelection']
		$projectDuration = $_POST['pduration'];
		$projectRoles = $_POST['prole'];

		$sql = "INSERT INTO `project`(`name_project`, `summary_project`, `description_project`, `id_course`, `id_type`, `id_technologies`, `duration_project`, `role_project`) VALUES ('$projectName', '$projectSummary', '$projectDescription', '$courseID', '$projectType', '$projectTechnologies','$projectDuration', '$projectRoles')";
		echo $sql;
		if ($connection->query($sql) === TRUE) {
			echo "<div class='success'>Nuevo proyecto agregado</div>";
		} else {
			echo "Error: " . $sql . "<br>" . $connection->error;
		}
	}
?>