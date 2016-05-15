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
	<h1> Shop Online</h1>
	<nav>
    <a href="/html/">HTML</a> |
    <a href="/css/">CSS</a> |
    <a href="/js/">JavaScript</a> |
    <a href="/jquery/">jQuery</a>
    </nav>
	
	<p> Please fill the form to register</p>
	<form method="GET" action = "">
	Email: <input type="text" name="email" required = "required"/> <br />
	Password: <input type="password" name="password" required="required"/> <br />
	<!-- <input type="hidden" name="submitted" value="true" /> -->
	<input type="submit" value="Login" name="submitted" /><br />
	</form>
	<p> <b>New Member? <a href =register.php>Register now</a></b></p>
</html>

<?php
if(($_GET['email'] != null && $_GET['password'] != null))
{
$xmlFile = "customer.xml";
 $HTML = "";
 $count = 0;
 //$dt = simplexml_load_file($xmlFile);
 $dom = DOMDocument::load($xmlFile);
 $customer = $dom->getElementsByTagName("customer"); 
 
foreach($customer as $node) 
{ 
	 $email = $node->getElementsByTagName("Email");
	 $email = $email->item(0)->nodeValue;

	 $password = $node->getElementsByTagName("Password");
	 $password = $password->item(0)->nodeValue;

	if (($email == $_GET["email"]) && ($password == $_GET["password"]) )
	{
	$_SESSION['email'] = $email;
  	header('location: bidding.php');
	break;
	}
	
}

echo "Credentials not found! Try Again";
}