<?php
 $xmlFile = "hotel.xml";
 $HTML = "";
 $count = 0;
 //$dt = simplexml_load_file($xmlFile);
 $dom = DOMDocument::load($xmlFile);
 $hotel = $dom->getElementsByTagName("hotel"); 

$display_hotel_array = array();
$i=1;
foreach($hotel as $node) 
{ 
	 $city = $node->getElementsByTagName("City");
	 $city = $city->item(0)->nodeValue;

	$type = $node->getElementsByTagName("Type");
	 $type = $type->item(0)->nodeValue;
	 
	 $name = $node->getElementsByTagName("Name");
	 $name = $name->item(0)->nodeValue;
	 
	 $price = $node->getElementsByTagName("Price");
	 $price = $price->item(0)->nodeValue;

	if (($type == $_GET["type"]) && ($city == $_GET["city"]) )
	{
		array_push($display_hotel_array, array($type, $name, $price));
	}
	
	$i++;
}



//sort the array now 
$max = sizeof($display_hotel_array);
$sort_flag = false;
if ( $max > 0 ){
	$sort_flag = true;
}

while($sort_flag){
	
	
	$sort_flag = false;
	for($i = 0; $i < ($max-1);$i++)
	{	
		
		if($display_hotel_array[$i][2] > $display_hotel_array[$i+1][2]){
			$sort_flag = true;
			$tmp_array = $display_hotel_array[$i+1];
			
			$display_hotel_array[$i+1] = $display_hotel_array[$i];
			$display_hotel_array[$i] = $tmp_array;

		}
	}
}


foreach($display_hotel_array as $hotel_node) {
	$HTML = $HTML."<br><span>Hotel: ".$hotel_node[1]."</span><br><span>Price: ".$hotel_node[2]."</span><br>";
        $count++;

}


 if ($count ==0)
 {
   $HTML ="<br><span>No hotels available</span>";
 }
           
  echo $HTML;   
?>

