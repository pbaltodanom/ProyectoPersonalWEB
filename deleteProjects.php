<?php
    include_once ('session.php');
    include_once ('connection_db.php');

    $connection = db_connect();

    if (isset($_POST['logout'])) {
    	session_start();
    	session_destroy();

    	header('location: login.php');
    }

    if(isset($_POST["submit"])) {  
        if(!empty($_POST["submit"]) ) {
            $id_project = mysqli_real_escape_string($connection, $_POST['idProject']);
            if ($id_project == "") {
                echo "<div class='warning'>Debe seleccionar un proyecto</div>";
            } else {
                $sql = "DELETE FROM `project` WHERE `id_project` = $id_project";
                if ($connection->query($sql) === TRUE) {
                    echo "<div class='success'>Proyecto eliminado</div>";
                } else {
                    echo "<div class='error'>".$connection->error."</div>";
                    //echo "Error: " . $sql . "<br>" . $connection->error;
                }
            }
        } else {
            echo "<div class='warning'>Debe seleccionar un proyecto</div>";
        }
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
            <form name="ProjectForm" action="deleteProjects.php" method="post">
                <div id="mainselection">
                    <select id="projectSelection" name="idProject"  onchange="showProject(this.value); showButton();">
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
                <div id="txtHint"><b>Ningún proyecto seleccionado</b></div>

                <br><br><br>

                <script>
    				function showProject(str) {
    					if (str=="") {
    						document.getElementById("txtHint").innerHTML="";
    						return;
    					} 
    					
    					if (window.XMLHttpRequest) {
    					// code for IE7+, Firefox, Chrome, Opera, Safari
    						xmlhttp=new XMLHttpRequest();
    					} else { // code for IE6, IE5
    						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    					}
    					
    					xmlhttp.onreadystatechange=function() {
    						if (this.readyState==4 && this.status==200) {
    							document.getElementById("txtHint").innerHTML=this.responseText;
    						}
    					}
    					
    					xmlhttp.open("GET","getProject.php?q="+str,true);
    					xmlhttp.send();
    				}

                    function showButton() {
                        var y = document.getElementById("submit");
                        y.type= "submit";
                    }
                </script>

                <div class="myButton">
                    <input type="hidden" id="submit" name="submit" style="background-color:transparent;" value="Eliminar proyecto"  hidden="hidden">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
