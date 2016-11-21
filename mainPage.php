<?php
    include_once ('session.php');
    include_once ('connection_db.php');

    //echo "Welcome ". $_SESSION['login_user'];

    $connection = db_connect();

    if (isset($_POST['logout'])) {
    	session_start();
    	session_destroy();

    	header('location: login.php');
    }

    if(isset($_POST["submit"])) {  
        $cont = 0;
        $projectTechnologies = "";
        foreach($_POST["language"] as $language) {
            $cont = $cont + 1;
            $projectTechnologies .= $cont." ";
        }

        $courseID = mysqli_real_escape_string($connection, $_POST['idCourse']);
        $projectName = mysqli_real_escape_string($connection, $_POST['pname']);
        $projectSummary = mysqli_real_escape_string($connection, $_POST['psummary']);
        $projectDescription = mysqli_real_escape_string($connection, $_POST['pdesc']);
        $projectType = mysqli_real_escape_string($connection, $_POST['ptype']);
        //$projectTechnologies = $_POST['courseSelection']
        $projectDuration = mysqli_real_escape_string($connection, $_POST['pduration']);
        $projectRoles = mysqli_real_escape_string($connection, $_POST['prole']);
        if ($courseID == "" ||  $projectName=="" || $projectSummary="" || $projectDescription="" || $projectType="" || $projectDuration=""|| $projectRoles="") {
            echo "<div class='warning'>Se deben llenar todos los campos</div>";
        } else {
            $sql = "INSERT INTO `project`(`name_project`, `summary_project`, `description_project`, `id_course`, `id_type`, `id_technologies`, `duration_project`, `role_project`) VALUES ('$projectName', '$projectSummary', '$projectDescription', '$courseID', '$projectType', '$projectTechnologies','$projectDuration', '$projectRoles')";        
            if ($connection->query($sql) === TRUE) {
                echo "<div class='success'>Nuevo proyecto agregado</div>";
            } else {
                echo "<div class='error'>".$connection->error."</div>";
                //echo "Error: " . $sql . "<br>" . $connection->error;
            }
        }
    }

    if(isset($_POST["course-submit"])) {  
        $departmentID = mysqli_real_escape_string($connection, $_POST['idDepartment']);
        $courseName = mysqli_real_escape_string($connection, $_POST['course']);
        $courseCredits = mysqli_real_escape_string($connection, $_POST['credits']);
        $courseDay = mysqli_real_escape_string($connection, $_POST['day']);
        $courseSchedule = mysqli_real_escape_string($connection, $_POST['schedule']);
        $courseProfessor = mysqli_real_escape_string($connection, $_POST['idProfessor']);
        $courseDepartment = mysqli_real_escape_string($connection, $_POST['idDepartment']);
        if ($departmentID == "" ||  $courseName=="" || $courseCredits="" || $courseDay="" || $courseSchedule="" || $courseProfessor=""|| $courseDepartment="") {
            echo "<div class='warning'>Se deben llenar todos los campos</div>";
        } else {
            $sql = "INSERT INTO `course`(`id_course`, `name_course`, `credits`, `day`, `schedule`, `id_professor`, `id_department`) VALUES  ('$departmentID','$courseName','$courseCredits','$courseDay','$courseSchedule','$courseProfessor', '$courseDepartment')";
            if ($connection->query($sql) === TRUE) {
                echo "<div class='success'>Nuevo curso creado</div>";
            } else {
                echo "<div class='error'>".$connection->error."</div>";
                //echo "Error: " . $sql . "<br>" . $connection->error;
            }
        }
    }

?>

<!DOCTYPE html>
<meta charset="utf-8">

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>

<link rel="stylesheet" href="styles/base_style.css" type="text/css">
<link rel="stylesheet" href="styles/mainPage_style.css" type="text/css">
<script type="text/javascript" src="js/validations.js"></script>

<html>
<head>
<title>PaginaPrincipal</title>
</head>

<body>
    <form method="post" name="logout">
        <input type="submit" name="logout" value="logout">
    </form>
    
    <p align='center' class='round'>PÁGINA PERSONAL ADMINISTRADOR</p>
    <div id="rectangle"></div>
    <div id="menu"> 
        <ul> 
            <li><a href="mainPage.php">PROYECTOS</a>
                <ul class="hidden">
                    <li><a href="createProjects.php">CREAR PROYECTO</a></li>
                    <li><a href="editProjects.php">ACTUALIZAR PROYECTO</a></li>
                    <li><a href="deleteProjects.php">ELIMINAR PROYECTO</a></li>
                </ul>
            </li>
            <li><a href="interestsPage.php">INTERESES</a>
            </li>
            <li><a href="">CONTACTO</a>
            </li>
        </ul>   
    </div> 

    <br><br><br><br><br>

    <?php 
        echo "<h1 align='center' class='text'>BIENVENID@ ". $_SESSION['login_user'] . " - ADMIN !!! <h1>";
    ?>

</body>
</html>
