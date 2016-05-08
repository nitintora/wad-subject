<!--  Author : Nitin Tora
Student Number: 100649911
Admin page for list all operation  -->
<html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<meta name="description" content="Web Application Development - Assignment 1">
	<meta name="keywords" content="Html, php, Mysql">
	<title>Admin Page of Cabs Online</title>
	</head>
	
	<h1>1. Click below button to search for all unassigned booking request with a pick-up time within 2 hours.</h1>
	<form method ="POST" action="">
	<input type="submit" value="List All" name="submit" /><br/>
	<input type="hidden" name="listall" /><br/>
	</form>
</html>

<?php
$DBConnect = @mysqli_connect("mysql.ict.swin.edu.au", "s100649911","051091", "s100649911_db")
		Or die ("<p>Unable to connect to the database server.</p>". "<p>Error code ". mysqli_connect_errno().": ". mysqli_connect_error()). "</p>";

function getAllData(){
	$finalData = array();
	global $DBConnect;
	$q = mysqli_query($DBConnect, "SELECT b.bookingref, c.name, b.passname, b.contact, b.unitno, b.streetno, b.streetname, b.suburb, b.destination, b.pickuptime, b.pickupdate FROM customer c INNER JOIN booking b 
ON c.email = b.email");
	
	while($data = mysqli_fetch_assoc($q)){ 

	$datetime1 = new DateTime($data['pickupdate']. ' ' .$data['pickuptime']);
	$datetime2 = new DateTime(date('Y-m-d H:i:s'));
	$difference = $datetime1->diff($datetime2);
	if($difference->h < 2) {
			$finalData[] = $data;
		}
	 return $finalData;		
	}
}

function getData()
{
 $finalData = array();
 global $DBConnect;
 $q = mysqli_query($DBConnect, "SELECT b.bookingref, c.name, b.passname, b.contact, b.unitno, b.streetno, b.streetname, b.suburb, b.destination, b.pickuptime, b.pickupdate FROM customer c INNER JOIN booking b 
ON c.email = b.email");
 	while($data = mysqli_fetch_assoc($q)){ 
			$finalData[] = $data;
		}
	 return $finalData;
	 
}
if(isset($_POST['listall']))
{
echo "<table width='100%' border='1'>";
echo "<th>Reference#</th><th>Customer Name</th><th>Passenger Name</th><th>Passeneger Contact</th><th>Pickup Address</th><th>Destination</th><th>Pickup Time</th>";
$finalData = getData();
foreach($finalData as $value)
{
	echo "<tr><td>".$value['bookingref']."</td>";
	echo "<td>".$value['name']."</td>";
	echo "<td>".$value['passname']."</td>";
	echo "<td>".$value['contact']."</td>";
	echo "<td>".$value['unitno'] .$value['streetno'] .$value['streetname'] .$value['suburb']."</td>";
	echo "<td>".$value['destination']."</td>";
	echo "<td>".$value['pickuptime']."</td></tr>";
}
	echo "</table>";
}

else
{
echo "<table width='100%' border='1'>";
echo "<th>Reference#</th><th>Customer Name</th><th>Passenger Name</th><th>Passeneger Contact</th><th>Pickup Address</th><th>Destination</th><th>Pickup Time</th>";
$finalData = getAllData();
foreach($finalData as $value)
{
	echo "<tr><td>".$value['bookingref']."</td>";
	echo "<td>".$value['name']."</td>";
	echo "<td>".$value['passname']."</td>";
	echo "<td>".$value['contact']."</td>";
	echo "<td>".$value['unitno'] .$value['streetno'] .$value['streetname'] .$value['suburb']."</td>";
	echo "<td>".$value['destination']."</td>";
	echo "<td>".$value['pickuptime']."</td></tr>";

}
	echo "</table>";
}
// set up the SQL query string - we will retrieve the whole
// record that matches the name

if(isset($_POST['number'])){
        $id = $_POST['number']; 
        $q = mysqli_query($DBConnect,"update booking set bookingstatus ='assigned' where bookingref = $id");
        echo "<p>Taxi has been assigned to you reference id $id<p>";
    }
?>
<p>
<form method='POST'>Reference Number: <input type='text' name='number'/> <input type='submit' value='update' name='update'/><br/> </p></form>