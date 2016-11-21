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
        if(!empty($_POST["language"]) ) {
            foreach($_POST["language"] as $language) {
                $cont = $cont + 1;
                $projectTechnologies .= $cont." ";
            }
        }

        if(!empty($_POST["idCourse"]) ) {
            $courseID = mysqli_real_escape_string($connection, $_POST['idCourse']);
            $projectName = mysqli_real_escape_string($connection, $_POST['pname']);
            $projectSummary = mysqli_real_escape_string($connection, $_POST['psummary']);
            $projectDescription = mysqli_real_escape_string($connection, $_POST['pdesc']);
            $projectType = mysqli_real_escape_string($connection, $_POST['ptype']);
            //$projectTechnologies = $_POST['courseSelection']
            $projectDuration = mysqli_real_escape_string($connection, $_POST['pduration']);
            $projectRoles = mysqli_real_escape_string($connection, $_POST['prole']);
            if ($courseID == "" ||  $projectName == "" || $projectSummary == "" || $projectDescription == "" || $projectType == "" || $projectDuration == "") {
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
        } else {
            echo "<div class='warning'>Se deben llenar todos los campos</div>";
        }
    }

    if(isset($_POST["course-submit"])) {  
        if(!empty($_POST["idProfessor"]) ) {
            $departmentID = mysqli_real_escape_string($connection, $_POST['idDepartment']);
            $courseName = mysqli_real_escape_string($connection, $_POST['course']);
            $courseCredits = mysqli_real_escape_string($connection, $_POST['credits']);
            $courseDay = mysqli_real_escape_string($connection, $_POST['day']);
            $courseSchedule = mysqli_real_escape_string($connection, $_POST['schedule']);
            $courseProfessor = mysqli_real_escape_string($connection, $_POST['idProfessor']);            
            if ($departmentID == "" ||  $courseName == "" || $courseCredits == "" || $courseDay == "" || $courseSchedule == "" || $courseProfessor == "") {
                echo "<div class='warning'>Todos los campos de curso deben ser llenados</div>";
            } else {
                $sql = "INSERT INTO `course`(`name_course`, `credits`, `day`, `schedule`, `id_professor`, `id_department`) VALUES  ('$courseName','$courseCredits','$courseDay','$courseSchedule','$courseProfessor', '$departmentID')";
                if ($connection->query($sql) === TRUE) {
                    echo "<div class='success'>Nuevo curso creado</div>";
                } else {
                    echo "<div class='error'>".$connection->error."</div>";
                    //echo "Error: " . $sql . "<br>" . $connection->error;
                }
            }
        } else {
            echo "<div class='warning'>Todos los campos de curso deben ser llenados</div>";
        }
    }

?>

<!DOCTYPE html>
<meta charset="utf-8">

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>

<link rel="stylesheet" href="styles/base_style.css" type="text/css">
<link rel="stylesheet" href="styles/createProjects.css" type="text/css">
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

    <div class="boxed">
        <div class="transbox">
            <font color="white"><h1>Portafolio de proyectos</h1></font>
            <font color="white"><h3>Ingreso de nuevos proyectos</h3></font>

            <br><br>

            <form name="NewProjectForm" action="createProjects.php" method="post">
                <div id="mainselection">
                    <select id="departmentSelection" name="idDepartment" onchange="validateCourse(); getIdCourse(this.value);">
                    <option value="" selected="true" disabled="disabled">Elija una escuela</option> 
                        <?php 
                            $sql = "SELECT id_department, name_department FROM department";
                            $result = mysqli_query($connection,$sql);
                            while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {                                                 
                               echo "<option value='".$row['id_department']."'>".$row['name_department']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <br><br><br>
                <div id="mainselection">
                    <select id="courseSelection" name="idCourse" onchange="validate(); showhide(); getIdProfessor();">
                    <option value="" selected="true" disabled="disabled">Elija un curso</option> 
                    <option value="course4" onclick="showhide();">Nuevo Curso</a>
                    </select>
                </div>
                <br><br>

                <div id="showform" style="display:none">
                    <br>
                    <font color="white">Nombre: </font> <br>
                    <input type="text" name="course" placeholder="Nombre del curso"> <br>
                    <font color="white">Créditos: </font> <br>
                    <input type="number" name="credits" placeholder="Número de créditos"> <br>
                    <font color="white">Día: </font> <br>
                    <select name="day">
                        <option value="lunes">Lunes</option>
                        <option value="martes">Martes</option>
                        <option value="miercoles">Miércoles</option>
                        <option value="jueves">Jueves</option>
                        <option value="viernes">Viernes</option>
                        <option value="sabado">Sábado</option>
                    </select>
                    <br>
                    <font color="white">Horario: </font> <br>
                    <input type="text" name="schedule" placeholder="e.g 7:30-9:20"> <br>
                    <font color="white">Profesor: </font> <br>
                    <select id="professorSelection" name="idProfessor">
                    <option value="" selected="true" disabled="disabled">Elija un profesor</option>
                    </select>
                    <br><br>
                    <input type="submit" name="course-submit" value="Agregar Curso" />
                    <br><br>
                </div>
                <br><br>
                <font color="white">Nombre del proyecto:  </font>
                <input type="text" name="pname" placeholder="Proyecto1"> <br><br>

                <font color="white">Resumen del proyecto:</font> <br><br>
                <textarea rows="4" name="psummary" cols="50" placeholder="Resumen..."></textarea> <br><br>

                <font color="white">Descripción del proyecto:</font> <br><br>
                <textarea rows="4" name="pdesc"cols="50" placeholder="Descripción..."></textarea> <br><br>

                <font color="white"><h2>Tipo de proyecto</h2></font>
                <div class="radiobuttons">
                    <label><input type="radio"  name="ptype"  value="1" checked/> <span>Investigación</span></label>
                    <label><input type="radio" name="ptype" value="2"/> <span>Proyecto Programado</span></label>
                    <label><input type="radio" name="ptype" value="3" /> <span>Grupal</span></label>
                    <label><input type="radio" name="ptype" value="4"/> <span>Individual</span></label>
                </div>                
                <br><br><br><br>

                <font color="white"><h3>Tecnologías usadas</h3></font>
                <input type="checkbox" name="language[]" value="PHP"><font color="white">PHP</font><br>
                <input type="checkbox" name="language[]" value="JQuery"><font color="white">JQuery</font><br>
                <input type="checkbox" name="language[]" value="RubyRails"><font color="white">Ruby & Rails</font><br>
                <input type="checkbox" name="language[]" value="HTML5"><font color="white">HTML5</font><br>
                <input type="checkbox" name="language[]" value="MYSQL"><font color="white">MySQL</font><br><br>

                <font color="white">Duración (en semanas) </font>
                <input type="text" name="pduration"> <br><br>

                <font color="white">Tareas / Roles </font>
                <input type="text" name="prole"> <br><br><br>

                <div class="myButton">
                    <input type="submit" name="submit" style="background-color:transparent;" value="Añadir nuevo proyecto">
                </div> <br><br><br><br>
            </form>
        </div>
    </div>
</body>
</html>
