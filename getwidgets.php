<?php
$packSizes = array(5000,2000,1000,500,250);
$quantities = array(0,0,0,0,0);
$max = count($packSizes)-1;

function getQuantities($widgetsOrdered) {
	$control = true;
	$index = 0;
	$initWidgets = $widgetsOrdered;
	
	global $packSizes, $quantities, $max;
	

	while ($control) {
		if ($widgetsOrdered - $packSizes[$index] > 0) { //Repeatedly called until widgetsOrdered is less than the current max pack size
		    $widgetsOrdered = $widgetsOrdered - $packSizes[$index];
			$quantities[$index]++;
		} else if ($widgetsOrdered - $packSizes[$index] > -$packSizes[$max]) { //If ordering another pack of the current size will result in a smaller number of excess widgets, do so and then break
			$quantities[$index]++;
			$control = false;			
		} else if (($index+1) == count($packSizes)) { //Called if we're at the end of the available pack sizes array.
			$quantities[count($packSizes)-1]++;
			$control = false;
		} else { //Called if we're done with the current pack size and moving on to the next smallest.
			$index++;
		}
	}
	
	echo "For an order of $initWidgets widgets, send the following packs: <br>";
	
	for ($i = 0; $i <= $max; $i++) {
		echo "$quantities[$i] packs of $packSizes[$i] widgets<br>";
	}

}

getQuantities($_POST["widgets"]);


?>
