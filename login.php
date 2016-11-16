<?php
  include 'connection_db.php';
  // Connect to the database
  $connection = db_connect();

  //Star a new session
  session_start();

  //Get and error flag
  $error = 0;

  //When user press the submit button
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //user name and password sent from form
    
    $myusername = mysqli_real_escape_string($connection, $_POST['username']);
    $mypassword = mysqli_real_escape_string($connection, $_POST['password']);

    //Fecth the user on the database
    $sql = "SELECT id_user FROM admin WHERE username = '$myusername' AND password = '$mypassword'";

    $result = mysqli_query($connection,$sql);
    //Execute the query
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //$active = $row['active'];

    $count = mysqli_num_rows($result);

    // If the result matched $myusername and $mypassword, table row must be 1 row

    if ($count == 1) {
      $_SESSION['login_user'] = $myusername;
      header("location: mainPage.php");
    } else {
      $error = 1;
    }

  }
?>

<!DOCTYPE html>
<meta charset="utf-8">

<link rel = stylesheet href="styles/login_style.css" type="text/css">

<html>
<head>

<title>PaginaPrincipal</title>
</head>
<body>
  <div class="container">
    <section id="content">
      <?php 
        if ($error == 1) {
          echo "<div class='error'>El nombre de usuario o contraseña son incorrectos</div>";
        }
      ?>
      <form method="post" name="login">
      <font color="white"><h1 align="center">Inicio de sesión</h1>

       <div class="imgcontainer">
          <img src="images/avatar.png" alt="Avatar" class="avatar">
      </div>

      <div class="container" align="center">
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>
        <br>
        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <br>
        <button type="submit" name="login">Login</button>
      </div>

      </form>
    </section>
  </div>
</body>
</html>