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
<link rel = stylesheet href="styles/mainPage_style.css" type="text/css">

<html>
<head>
<title>PaginaPrincipal</title>
</head>

<body>
    <form method="post" name="logout">
        <input type="submit" name="logout" value="logout">
    </form>
    
    <?php 
        echo "<p align='center' class='round'>". $_SESSION['login_user'];
    ?>
    <br>
    BACHILLER EN LA CARRERA DE INGENIERÍA EN COMPUTACIÓN-ITCR</p>

    <h2 class="offscreen">NavigationBar</h2> 
    <div id="hmenu"> 
        <ul> 
            <li><a href="mainPage.php">NUEVOS PROYECTOS</a></li> 
            <li><a href="">ACTUALIZAR PROYECTOS</a></li>
            <li><a href="">ELIMINAR PROYECTO</a></li>
        </ul>   
    </div> 

    <br><br>

    <div class="boxed">
        <div class="transbox">
            <font color="white"><h1>Portafolio de proyectos</h1></font>
            <font color="white"><h3>Actualizar proyectos</h3></font>

            <br><br>

            <?php

            $sql = "SELECT * FROM project";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo '<table cellpadding="0" cellspacing="0" class="db-table">';
                echo '<tr><th>ID</th><th>NOMBRE</th><th>RESUMEN</th><th>DESCRIPCIÓN</th><th>CURSO</th><th>TIPO DE PROYECTO</th><th>TECNOLOGÍAS USADAS</th><th>DURACIÓN</th><th>TAREAS / ROLES</th></tr>';
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    foreach($row as $key=>$value) {
                        if ($key == "id_course") {
                            getCourse($connection, $value);
                        } else if ($key == "id_type") {
                            getTypeProject($connection, $value);
                        } else if ($key == "id_technologies") {
                            getTechnologiesProject($connection, $value);
                        } else {
                            echo '<td>',$value,'</td>';
                        }
                    }
                    echo '</tr>';
                }
            } else {
                echo "0 results";
            }

            function getCourse($connection, $value) {
                $sql = "SELECT name_course FROM `course` WHERE `id_course` = $value";                
                $result = mysqli_query($connection, $sql);

                while($row = mysqli_fetch_assoc($result)) {
                    if (mysqli_num_rows($result) > 0) {
                        foreach($row as $key=>$value) {
                            echo '<td>',$value,'</td>';
                        }
                    }
                }
            }

            function getTypeProject($connection, $value) {                
                $sql = "SELECT `name_type` FROM `typeproject` WHERE `id_type` = $value";                
                $result = mysqli_query($connection, $sql);

                while($row = mysqli_fetch_assoc($result)) {
                    if (mysqli_num_rows($result) > 0) {
                        foreach($row as $key=>$value) {
                            echo '<td>',$value,'</td>';
                        }
                    }
                }
            }

            function getTechnologiesProject($connection, $value) {    
                echo '<td>';
                for($i = 0; $i < strlen($value); $i++) {
                    if ($value[$i] != " ") {
                        $val = $connection->real_escape_string($value[$i]);
                        $sql = "SELECT `name_technologies` FROM `technologiesproject` WHERE `id_technologies`  = " . $val;
                        
                        $result = mysqli_query($connection, $sql);
                        $tech = mysqli_fetch_array($result);
                        echo $tech[0];
                        if ($i+2 < strlen($value)) {
                            echo ", ";
                        }
                    }
                }
                echo '</td>';
            }

            ?>
            
        </div>
    </div>
</body>
</html>
