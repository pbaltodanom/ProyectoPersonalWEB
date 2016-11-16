<?php
	
	include_once ('connection_db.php');
	// Connect to the database
  	$connection = db_connect();

  	//Star a new session
	session_start();

	//Verify there's a current session
	$user_check = $_SESSION['login_user'];

	$ses_sql = mysqli_query($connection,"select username from admin where username = '$user_check' ");

	$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

	$login_session = $row['username'];

	if (!isset($_SESSION['login_user'])) {
		header("location:login.php");
	}

?>