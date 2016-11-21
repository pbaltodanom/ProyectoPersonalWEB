<!DOCTYPE html>
<html>
<head>
<style>
	table {
	    width: 95%;
	    border-collapse: collapse;
	}

	table, td, th {
	    border: 1px solid black;
	    padding: 5px;
	}

	th {text-align: left;}
	</style>
	</head>
<body>

<?php
	include_once ('session.php');
    include_once ('connection_db.php');

    $connection = db_connect();

    $q = intval($_GET['q']);

	if (!$connection) {
	    die('Could not connect: '. mysqli_error($connection));
	}

	$sql="SELECT `project`.`id_course`,`project`.`name_project`, `project`.`description_project`, `course`.`name_course` FROM `project` INNER JOIN `course` ON project.`id_course` = course.`id_course` WHERE id_project = '".$q."'";	
	$result = mysqli_query($connection,$sql);

	echo "<table>
	<tr>
	<th>Nombre</th>	
	<th>Descripcion</th>
	<th>Curso</th>
	</tr>";
	while($row = mysqli_fetch_array($result)) {
	    echo "<tr>";
	    echo "<td>" . $row['name_project'] . "</td>";
	    echo "<td>" . $row['description_project'] . "</td>";
	    echo "<td>" . $row['name_course'] . "</td>";
	    echo "</tr>";
	}
	echo "</table>";
	mysqli_close($connection);
?>
</body>
</html>