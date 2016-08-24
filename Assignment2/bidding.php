<?php
$url = "auction.xml";
$xml = simplexml_load_file($url);

// loop begins
foreach($xml->Item as $item)
{
// begin new paragraph
echo "<fieldset>";
echo "<p>";
// show author
echo "<strong>Category:</strong> ".$item->Category."<br/>";
// show publisher
echo "<strong>Description:</strong> ".$item->Description."<br/>";
// show price
echo "<strong>Start Price:$</strong> ".$item->StartPrice."<br/>";
echo "<strong>Reserve Price: $</strong>".$item->ReservePrice."<br/>";
echo "<strong>Buy it now Price: $</strong>".$item->BuyPrice."<br/>";
$date1 = new DateTime($item->StartDate);
$date2 = new DateTime($item->ExpiryDate);
$interval = date_diff($date1, $date2);
//$interval = $date1->diff($date2);

echo $interval->d." Days, ".$interval->h." Hours " .$interval->i. " minutes " .$interval->s.  " seconds remaining"; 

// shows the total amount of days (not divided into years, months and days like above)
echo "<br /><input type='submit' value='Buy it now' name='submitted' onclick='buyItNow()' />";
echo "<input type='submit' value='Place Bid' name='submitted' onclick='placeBid()' />";
echo "</p>";
echo "</fieldset>";
// end paragraph
}
// loop ends

?>