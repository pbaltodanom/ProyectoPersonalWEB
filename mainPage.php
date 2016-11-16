<?php

include_once ('session.php');
include_once ('connection_db.php');

//echo "Welcome ". $_SESSION['login_user'];

if (isset($_POST['logout'])) {
	session_start();
	session_destroy();

	header('location: login.php');
}
?>

<!DOCTYPE html>
<meta charset="utf-8">

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
            <li><a href="home.html">HOME</a></li> 
            <li><a href="informacion.html">INFORMACIÓN PERSONAL</a></li> 
            <li><a href="portafolio.html">PORTAFOLIO DE PROYECTOS</a></li> 
            <li><a href="contacto.html">CONTACTO</a></li> 
        </ul>   
    </div> 

    <br><br>

    <div class="boxed">
        <div class="transbox">
            <font color="white"><h1>Edición portafolio de proyectos</h1></font>

            <br><br>

            <form action="">

                <div id="mainselection">
                    <select id="mySelect" onchange="showhide()">
                        <option disabled selected value></option>
                        <option value="curso1">Curso 1</a>
                        <option value="curso2">Curso 2</a>
                        <option value="curso3">Curso 3</a>
                        <option value="curso4" onclick="showhide();">Nuevo Curso</a>
                    </select>
                </div>
                <script>
                    function showhide() {
                        var option = document.getElementById("mySelect").value;
                        var div = document.getElementById("showform");
                        if (option == "curso4") {
                            div.style.display = "block";
                        } else {
                            div.style.display = "none";
                        }
                    }
                </script>
                <div id="showform" style="display:none">
                    <font color="white">Curso: </font> <br>
                    <input type="text" name="Curso" placeholder="Curso"> <br>
                    <font color="white">Proyecto:  </font> <br>
                    <input type="text" name="Proyecto" placeholder="Proyecto"> <br>
                    <font color="white">Horario: </font> <br>
                    <input type="text" name="Horario" placeholder="Horario"> <br>
                    <button type="button" >Agregar Curso</button>
                </div>

                <br><br>
                <font color="white">Nombre del proyecto:  </font>
                <input type="text" name="Nombre" placeholder="Proyecto1"> <br><br>

                <font color="white">Resumen del proyecto:</font> <br><br>
                <textarea rows="4" cols="50" placeholder="Resumen..."></textarea> <br><br>

                <font color="white">Descripción del proyecto:</font> <br><br>
                <textarea rows="4" cols="50" placeholder="Descripción..."></textarea> <br><br>

                <font color="white"><h2>Tipo de proyecto</h2></font>
                <div class="checkboxes">
                    <label for="Inv"><input type="checkbox" id="Inv" /> <span>Investigación</span></label>
                    <label for="PP"><input type="checkbox" id="PP" /> <span>Proyecto Programado</span></label>
                    <label for="G"><input type="checkbox" id="G" /> <span>Grupal</span></label>
                    <label for="Ind"><input type="checkbox" id="Ind" /> <span>Individual</span></label>
                </div>
                <br><br><br><br>

                <font color="white"><h3>Tecnologías usadas</h3></font>
                <input type="checkbox" name="PHP" value="PHP"><font color="white">PHP</font><br>
                <input type="checkbox" name="JQuery" value="JQuery"><font color="white">JQuery</font><br>
                <input type="checkbox" name="RubyRails" value="RubyRails"><font color="white">Ruby & Rails</font><br>
                <input type="checkbox" name="HTML5" value="HTML5"><font color="white">HTML5</font><br>
                <input type="checkbox" name="MySQL" value="JQuMySQLery"><font color="white">MySQL</font><br><br>

                <font color="white">Duración (en semanas) </font>
                <input type="text" name="Duracion"> <br><br>

                <font color="white">Tareas / Roles </font>
                <input type="text" name="Tareas"> <br><br><br>

                <div class="myButton"> Actualizar datos </div> <br><br><br><br>
            </form>
        </div>
    </div>
</body>
</html>