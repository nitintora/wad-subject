<?php
session_start();
//register
$xml = new DOMDocument('1.0');
$xml->preserveWhiteSpace = false;
$xml->formatOutput = true;
$xml->load('customer.xml');
$xmlFile = "customer.xml";
 //$dt = simplexml_load_file($xmlFile);
$dom = DOMDocument::load($xmlFile);
$emailreg = $_GET['emailreg'];
$fname = $_GET['fname'];
$surname = $_GET['surname'];
$custid = uniqid();
$password = md5(uniqid());
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

foreach($customer as $node) 
{
	 $emailCheck = $node->getElementsByTagName("Email");
	 $emailCheck = $emailCheck->item(0)->nodeValue;
	if ($emailCheck == $emailreg)
	{
		$flag = 1;
		break;
	}
}
//name element
if($flag==1)
{
	echo "false";
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
$emailxml = $xml->createElement("Email", $emailreg);
$customer->appendChild($emailxml);

//id
$idxml = $xml->createElement("id", $custid);
$customer->appendChild($idxml);

//id
$passwordxml = $xml->createElement("Password", $password);
$customer->appendChild($passwordxml);
	
$recipient = $_GET['emailreg'];
$subject = "Welcome to ShopOnline!";
$message = "Dear" .$fname. "Welcome to ShopOnline! Your Customer id is" .$custid. "and the password is:" .$password;
$header = "From registration@shoponline.com.au";
mail($recipient, $subject, $message, $header, "-r 100649911@student.swin.edu.au"); 
//echo ""

}

//echo "<xmp>" .$xml->saveXML(). "</xmp>";
$xml->save("customer.xml");

?>