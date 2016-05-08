<!--  Author : Nitin Tora
Student Number: 100649911
Booking page for Booking a cab ride  -->
<?php
session_start();

?> 
<html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<meta name="description" content="Web Application Development - Assignment 1">
	<meta name="keywords" content="Html, php, Mysql">
	<title>Cabs Online | Book the cab now| Booking</title>
	</head>
	<h1> Booking for cab</h1>
	<p> Please fill the form to register</p>
	<form method="POST" action = "">										
	<p>Hi <?=$_SESSION["email"]; ?> </p>
	Passenger name: <input type="text" name="passname" required="required"/> <br />
	Contact Phone of passenger: <input type="text" name="contact" required="required"/> <br />
	Pickup Address: Unit Number <input type="text" name="unitno"/> <br />
			Street Number <input type="text" name="streetno" required="required"/> <br />
			Street Name <input type="text" name="streetname" required="required"/> <br />
			Suburb <input type="text" name="suburb" required="required"/> <br />
	Destination Suburb <input type="text" name="destination" required="required"/> <br />
	Pickup Date: <input type="date" name="pickupdate" required="required" pattern="\d{1,2}/\d{1,2}/\d{4}" placeholder="dd/mm/yyyy"/> <br />
	Pickup Time: <input type="time" name="pickuptime" required="required" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" placeholder="HH:MM"/> <br />
	<input type="submit" value="Book" /><br />
	</form>
</html>
<?php

if(isset($_POST['passname']))
{
if(isset($_POST['passname'])) { $passname = $_POST['passname'];}	
if(isset($_POST['contact'])) { $contact = $_POST['contact'];}
if(isset($_POST['unitno'])) { $unitno = $_POST['unitno'];}
if(isset($_POST['streetno'])) { $streetno = $_POST['streetno'];} 
if(isset($_POST['streetname'])) { $streetname = $_POST['streetname'];}
if(isset($_POST['suburb'])) { $suburb = $_POST['suburb'];}
if(isset($_POST['destination'])) { $destination = $_POST['destination'];}
if(isset($_POST['pickupdate'])) { $pickupdate = $_POST['pickupdate'];}
if(isset($_POST['pickuptime'])) { $pickuptime = $_POST['pickuptime'];}
$email = $_SESSION['email'];
//validation for date
$datetime1 = new DateTime($pickupdate.' '. $pickuptime);
$datetime2 = new DateTime(date('Y-m-d H:i:s'));
$difference = $datetime1->diff($datetime2);
if($difference->h <= 1)
{
echo "<p> Difference of pickuptime and current time should be more than 1 hour </p>";
}
else if(strtotime(date($pickupdate." ".$pickuptime)) <   strtotime(date("Y-m-d H:i:s"))){ echo "<p>Cant select the previous date</p>";}
else
{

$DBConnect = @mysqli_connect("mysql.ict.swin.edu.au", "s100649911","051091", "s100649911_db")
		Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";	
$SQLstring = "insert into booking set email = '" .$email. "' ,passname = '".$passname."',contact = '".$contact."', unitno = '".$unitno."', streetno= '".$streetno."', streetname='".$streetname."', suburb= '".$suburb. "', destination = '".$destination. "', pickupdate = '" .$pickupdate. "', pickuptime = '". $pickuptime ."'";
$queryResult = @mysqli_query($DBConnect, $SQLstring)
		Or die ("<p> cant connect </p>" . mysqli_error($DBConnect));

//Confirmation for user
if($queryResult)
{
	$SQLstring = "select max(bookingref) as id from booking";
	$queryResult = @mysqli_query($DBConnect, $SQLstring)
		Or die ("<p> cant connect </p>" . mysqli_error($DBConnect));
	$result = mysqli_fetch_assoc($queryResult);
	echo "<p>Thank you! Your Booking Reference is "  .$result['id']. " . We will pick up the passenger in front of your provided address at $pickuptime on $pickupdate</p>"; 
}
//mail to the user
//$to = $email ;
//$subject = "Your Booking request with CabsOnline";
//$txt = "Dear $passname, Thanks for booking with CabsOnline! Your Booking Reference is "  .$result['id']. " . We will pick up the passenger in front of your provided address at $pickuptime on $pickupdate"; 
//$headers = "From: booking@cabsonline.com";
//mail($to,$subject,$txt,$headers, "-r 100649911@student.swin.edu.au");
}
}
?>