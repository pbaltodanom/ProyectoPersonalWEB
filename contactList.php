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
                    <li><a href="#">ELIMINAR PROYECTO</a></li>
                </ul>
            </li>
            <li><a href="interestsPage.php">INTERESES</a>
            </li>
            <li><a href="">CONTACTO</a>
            </li>
        </ul>   
    </div> 

    <br><br><br><br><br>
</body>
</html>