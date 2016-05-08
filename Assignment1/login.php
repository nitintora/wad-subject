<!--  Author : Nitin Tora
Student Number: 100649911
Login page for existing customers  -->

<html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<meta name="description" content="Web Application Development - Assignment 1">
	<meta name="keywords" content="Html, php, Mysql">
	<title>Cabs Online | Book the cab now| Login</title>
	</head>
	<h1> Register for Cabs Online</h1>
	<p> Please fill the form to register</p>
	<form method="POST" action = "">
	Email: <input type="text" name="email" required = "required"/> <br />
	Password: <input type="password" name="password" required="required"/> <br />
	<input type="hidden" name="submitted" value="true" />
	<input type="submit" value="Login" /><br />
	</form>
	<p> <b>New Member? <a href =register.php>Register now</a></b></p>
</html>

<?php
session_start();
if(isset($_POST['email']))
{
if(isset($_POST['email'])) 
{ 
$email = $_POST['email']; 
$password = $_POST['password'];
}


$DBConnect = @mysqli_connect("mysql.ict.swin.edu.au", "s100649911","051091", "s100649911_db")
Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";	

$SQLstring = "select * from customer where email ='" . $email. "' AND password = '" . $password. "'";
$result = mysqli_query($DBConnect,$SQLstring);	
$row = mysqli_num_rows($result);
if($row > 0)
{
 	$_SESSION['email'] = $email;
  	header('location: booking.php');
}
else
{
	
	echo '<p>Wrong Credentials, Try again or Sign up <a href = "register.php"> here</a> </p>';
	exit();
}
}
?>