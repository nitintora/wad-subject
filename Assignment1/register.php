<!--  Author : Nitin Tora
Student Number: 100649911
Registers the new customer  -->

<?php session_start(); ?>
<html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<meta name="description" content="Web Application Development - Assignment 1">
	<meta name="keywords" content="Html, php, Mysql">
	<title>Cabs Online | Book the cab now</title>
	</head>
	
	<h1> customer for Cabs Online</h1>
	<p> Please fill the form to customer</p>
	<form method ="POST" action="">
	<fieldset>	
		Name*: <input type="text" name="customername" required="required"/><br/>
		Password*: <input type="password" name="password" required="required"/> <br/>
		Confirm Password* : <input type="password" name="confirmpassword" required="required"/> <br/>
		Email*: <input type="text" name="email" required="required" placeholder = "example@example.com"/> <br/>
		Phone: <input type="text" name="phone"/> <br/>
	<input type="submit" value="submit"/><br/>
	</fieldset>
	</form>
	
	<p> Already a customer ? <a href="login.php"><b>Login here</b></a></b></a></p>
</html>


<?php
$DBConnect = @mysqli_connect("mysql.ict.swin.edu.au", "s100649911","051091", "s100649911_db")
		Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";	
//declaring all variables
if(isset($_POST['email']))
{
if(isset($_POST['customername'])) { $name = $_POST['customername'];}
if(isset($_POST['password'])) { $password = $_POST['password'];}
if(isset($_POST['confirmpassword'])) { $confirmpassword = $_POST['confirmpassword'];} 
if(isset($_POST['email'])) { $email = $_POST['email'];}
if(isset($_POST['phone'])) { $phone = $_POST['phone'];}
if($password != $confirmpassword) { echo"<p>Password Mismatch! Please try again! </p><br/>"; } //checks the password
else if (!preg_match("/^[a-zA-Z ]*$/",$name)) { echo"Only letters and white space allowed in name <br/>";} //validation for name
else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { echo "<p>Invalid email format </p><br/>"; } //validation for email 
else if (!is_numeric($phone)) { echo"<p>Enter the correct format for phone</p>"; }
else
{
	$SQLstring = mysqli_query($DBConnect, "select name from customer where email = '$email'");
	$result = mysqli_num_rows($SQLstring);
	if($result == 0)
	{
		$_SESSION['name']=$name;
		$_SESSION['email']=$email;
		$SQLstring = "insert into customer set name = '".$name."', password = '".$password."', email= '".$email."', phone='".$phone."'";
		$queryResult = @mysqli_query($DBConnect, $SQLstring)
			Or die ("<p> cant connect </p>" . mysqli_error($DBConnect));
		if($queryResult)
		{
			echo "<p>New User Rgistered. <br/> Please <a href=login.php> Login here </a></p>";
		}
	}

	else
	{
	 	echo "<p> User already exists. <br/> Please <a href=login.php> Login here </a></p> ";
	}

}

}
mysqli_close();

?>