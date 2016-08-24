<?php
session_start();
error_log("my listing backend");
date_default_timezone_set('Australia/Melbourne');
//declare xml doc
$xml = new DOMDocument('1.0');
$xml->preserveWhiteSpace = false;
$xml->formatOutput = true;
$xml->load('auction.xml');
$xmlFile = "auction.xml";
$dom = DOMDocument::load($xmlFile);

//declate get variables
$itemname = $_GET['itemname'];
$category = $_GET['category'];
$desc = $_GET['desc'];
$startprice = $_GET['startprice'];
$resprice = $_GET['resprice'];
$buyprice = $_GET['buyprice'];
$day = $_GET['day'];
$hour = $_GET['hour'];
$minute = $_GET['minute'];
$id = uniqid();
if(!xml)
{
	$listings= $xml->createElement('listings');
	$xml->appendChild($listings);
}
else 
{
	$listings = $xml->firstChild;	
}
//customer element
$item = $dom->getElementsByTagName("item"); 

$itemxml = $xml->createElement("Item");
$listings->appendChild($itemxml);

//password element
$idxml = $xml->createElement("Id", $id);
$itemxml->appendChild($idxml);

//First Name
$itemnamexml = $xml->createElement("Itemname", $itemname);
$itemxml->appendChild($itemnamexml);

//surname
$categoryxml = $xml->createElement("Category", $category);
$itemxml->appendChild($categoryxml);

$descxml = $xml->createElement("Description", $desc);
$itemxml->appendChild($descxml);

$startpricexml = $xml->createElement("StartPrice", $startprice);
$itemxml->appendChild($startpricexml);


$respricexml = $xml->createElement("ReservePrice", $resprice);
$itemxml->appendChild($respricexml);

$buypricexml = $xml->createElement("BuyPrice", $buyprice);
$itemxml->appendChild($buypricexml);

$status = $xml->createElement("Status", 'in_progress');
$itemxml->appendChild($status);


$presentDate = new DateTime('now');

$presentDateNode = $xml->createElement("StartDate", $presentDate->format('Y-m-d H:i'));
$itemxml->appendChild($presentDateNode);

$expiryDate = $presentDate->add(new DateInterval('P'.$day.'DT'.$hour.'H'.$minute.'M'));;

$expiryDateNode = $xml->createElement("ExpiryDate", $expiryDate->format('Y-m-d H:i:s'));
$itemxml->appendChild($expiryDateNode);


	echo "Thank You! Your Item has been listed in ShopOnline."
      ." The item number is ".$id
      .", and the bidding starts now at: ".$presentDate->format('H:i:sP')
      ." on ".$presentDate->format('Y-m-d');

//echo "<xmp>" .$xml->saveXML(). "</xmp>";
$xml->save("auction.xml");

?>