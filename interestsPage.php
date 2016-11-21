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
<link rel="stylesheet" href="styles/base_style.css" type="text/css">
<link rel="stylesheet" href="styles/interestsPage.css" type="text/css">
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
    <br><br><br>
    <div id="tableInterests"></div>
</body>
</html>

 <script>  
 $(document).ready(function(){  
      function fetch_data()  
      {  
           $.ajax({  
                url:"select.php",  
                method:"POST",  
                success:function(data){  
                     $('#tableInterests').html(data);  
                }  
           });  
      }  
      fetch_data();  
      $(document).on('click', '#btn_add', function(){  
           var name_interest = $('#name_interest').text();  
           var description_interest = $('#description_interest').text();  
           var other_info = $('#other_info').text();  
           if(name_interest == '')  
           {  
                alert("Ingrese un nuevo interés");  
                return false;  
           }  
           if(description_interest == '')  
           {  
                alert("Ingrese la descripción");  
                return false;  
           }  
           $.ajax({  
                url:"insert.php",  
                method:"POST",  
                data:{name_interest:name_interest, description_interest:description_interest, other_info:other_info},  
                dataType:"text",  
                success:function(data)  
                {  
                     alert(data);  
                     fetch_data();  
                }  
           })  
      });  
      function edit_data(id, text, column_name)  
      {  
           $.ajax({  
                url:"edit.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:column_name},  
                dataType:"text",  
                success:function(data){  
                     alert(data);  
                }  
           });  
      }  

      $(document).on('blur', '.name_interest', function(){  
          var id = $(this).data("id1");
          var name_interest = $(this).text();
          edit_data(id, name_interest, "name_interest");
      });
      $(document).on('blur', '.description_interest', function(){  
          var id = $(this).data("id2");
          var description_interest = $(this).text();
          edit_data(id,description_interest, "description_interest");
      });
      $(document).on('blur', '.other_info', function(){          
          var id = $(this).data("id3");
          var other_info = $(this).text();
          edit_data(id,other_info, "other_info");
      });  
      $(document).on('click', '.btn_delete', function(){  
           var id=$(this).data("id4");  
           if(confirm("Seguro que desea eliminar?"))  
           {  
                $.ajax({  
                     url:"delete.php",  
                     method:"POST",  
                     data:{id:id},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          fetch_data();  
                     }  
                });  
           }  
      });  
 });  
 </script>  