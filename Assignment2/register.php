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
	<form method ="GET" action="">
	<fieldset>	
		First Name*: <input type="text" name="fname" required="required"/><br/>
		Surname*: <input type="text" name="surname" required="required"/> <br/>
		Email*: <input type="text" name="email" required="required" placeholder = "example@example.com"/> <br/>
	<input type="submit" value="submit"/><br/>
	</fieldset>
	</form>
	
	<p> Already a customer ? <a href="login.php"><b>Login here</b></a></b></a></p>
</html>


<?php
if(isset($_GET['fname']) && isset($_GET['surname']) && isset($_GET['email']))
{
	//declaring variables
$xml = new DOMDocument('1.0');
$xml->preserveWhiteSpace = false;
$xml->formatOutput = true;

$xml->load('customer1.xml');
$xmlFile = "customer1.xml";
 //$dt = simplexml_load_file($xmlFile);
$dom = DOMDocument::load($xmlFile);
if(!xml)
{
	$customers= $xml->createElement('customers');
	$xml->appendChild($customers);
}
else 
{
	$customers = $xml->firstChild;	
}
//customer element
$customer = $dom->getElementsByTagName("customer"); 
	
$email = $_GET['email'];
$fname = $_GET['fname'];
$surname = $_GET['surname'];
$custid = uniqid();
$password = md5(uniqid());

foreach($customer as $node) 
{
	 $emailCheck = $node->getElementsByTagName("Email");
	 $emailCheck = $emailCheck->item(0)->nodeValue;

	if ($emailCheck == $email)
	{
		$flag = 1;
		break;
		
	}
}
//name element
if($flag==1)
{
	echo "Email Already Exists";
}
else
{
$customer = $xml->createElement("customer");
$customers->appendChild($customer);

//password element
$fnamexml = $xml->createElement("Firstname", $fname);
$customer->appendChild($fnamexml);

//First Name
$surnamexml = $xml->createElement("Surname", $surname);
$customer->appendChild($surnamexml);

//surname
$emailxml = $xml->createElement("Email", $email);
$customer->appendChild($emailxml);

//id
$idxml = $xml->createElement("id", $custid);
$customer->appendChild($idxml);

//id
$passwordxml = $xml->createElement("Password", $password);
$customer->appendChild($passwordxml);
	
$recipient = $_GET['email'];
$subject = "Welcome to ShopOnline!";
$message = "Dear" .$fname. "Welcome to ShopOnline! Your Customer id is" .$custid. "and the password is:" .$password;
$header = "From registration@shoponline.com.au";
mail($recipient, $subject, $message, $header, "-r 100649911@student.swin.edu.au"); 

}

echo "<xmp>" .$xml->saveXML(). "</xmp>";
$xml->save("customer1.xml");
}
?>