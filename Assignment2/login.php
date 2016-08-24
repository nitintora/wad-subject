
<?php
//login
error_log("====inside login.php=====");
session_start();
$xmlFile = "customer.xml";
 //$dt = simplexml_load_file($xmlFile);
$dom = DOMDocument::load($xmlFile);
$customer = $dom->getElementsByTagName("customer"); 
 
foreach($customer as $node) 
{ 
	 $email = $node->getElementsByTagName("Email");
	 $email = $email->item(0)->nodeValue;

	 $password = $node->getElementsByTagName("Password");
	 $password = $password->item(0)->nodeValue;

	if (($email == trim($_GET["email"])) && ($password == trim($_GET["password"])) )
	{
	$_SESSION['email'] = $email;
	$flag = true;
	break;
	}
	else {
		$flag = false;
	}
}

	$response = array();
	if($flag == true)
	{
		$response = array("login"=>"ok"); 
		error_log("=====in true condition");
		echo  "ok";
		//echo "hello";
	}
	else {
		$response = array("login"=>"fail");
		//echo json_encode($response);
		echo "fail";
}


?>