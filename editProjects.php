<?php
    include_once ('session.php');
    include_once ('connection_db.php');

    $connection = db_connect();

    if (isset($_POST['logout'])) {
    	session_start();
    	session_destroy();

    	header('location: login.php');
    }
?>

<!DOCTYPE html>
<meta charset="utf-8">

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
<link rel = stylesheet href="styles/base_style.css" type="text/css">
<link rel = stylesheet href="styles/editProjects_style.css" type="text/css">
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
            <font color="white"><h3>Actualizar proyectos</h3></font>

            <br><br>

            <div id="mainselection">
                <select id="projectSelection" name="idProject">
                <option value="" selected="true" disabled="disabled">Elija un proyecto</option> 
                    <?php 
                        $sql = "SELECT id_project, name_project FROM project";
                        $result = mysqli_query($connection,$sql);
                        while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {                                                 
                           echo "<option value='".$row['id_project']."'>".$row['name_project']."</option>";
                        }
                    ?>
                </select>
            </div>

            <br><br><br>

            <form name="NewProjectForm" method="post" display="none">
                <div id="mainselection">
                    <select id="courseSelection" name="idCourse" disabled>
                    <option value="" selected="true" disabled="disabled">Elija un curso</option> 
                    </select>
                </div>
                <br><br>
                <script type="text/javascript" src="js/validations.js"></script>
                
                <br><br>
                <font color="white">Nombre del proyecto:  </font>
                <input type="text" name="pname" value="" disabled><br><br>

                <font color="white">Resumen del proyecto:</font> <br><br>
                <textarea rows="4" name="psummary" cols="50" placeholder="Resumen..." disabled></textarea> <br><br>

                <font color="white">Descripción del proyecto:</font> <br><br>
                <textarea rows="4" name="pdesc"cols="50" placeholder="Descripción..." disabled></textarea> <br><br>

                <font color="white"><h2>Tipo de proyecto</h2></font>
                <div id="mainselection">
                <select id="typeProjectSelection" name="typeProject" disabled>
                <option value="" selected="true" disabled="disabled">Elija un tipo de proyecto</option> 
                    <?php 
                        $sql = "SELECT id_type, name_type FROM typeproject";
                        $result = mysqli_query($connection,$sql);
                        while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {                                                 
                           echo "<option value='".$row['id_type']."'>".$row['name_type']."</option>";
                        }
                    ?>
                </select>
                </div>

                 <br><br><br>

                <div id="mainselection">
                <select id="tecProjectSelection" name="tecProject" disabled multiple>
                    <?php 
                        $sql = "SELECT id_technologies, name_technologies FROM technologiesproject";
                        $result = mysqli_query($connection,$sql);
                        while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {                                                 
                           echo "<option value='".$row['id_technologies']."'>".$row['name_technologies']."</option>";
                        }
                    ?>
                </select>
                </div>

                <br><br><br>

                <font color="white">Duración (en semanas) </font>
                <input type="text" name="pduration" disabled> <br><br>

                <font color="white">Tareas / Roles </font>
                <input type="text" name="prole" disabled> <br><br><br>

                <div class="myButton">
                    <input type="submit" name="submit" style="background-color:transparent;" value="Añadir nuevo proyecto" disabled>
                </div> <br><br><br><br>
            </form>
            
        </div>
    </div>
</body>
</html>
