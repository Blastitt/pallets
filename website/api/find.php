<?php

// REMOVE ABOVE BEFORE PRODUCTION
error_reporting(E_ALL);
ini_set('display_errors', '1');
// REMOVE ABOVE BEFORE PRODUCTION


$pal_name = $_GET["pal_name"];
$pal_id = $_GET["pal_id"];


// Connect to MySQL
$conn = new mysqli("localhost", "pallet", "welcome@123", "pallets");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if($pal_name && $pal_id){
	$searchquery = "SELECT * FROM pallets WHERE pal_name = '%s' AND pal_id = %d";
	$searchquery = sprintf($searchquery, $pal_name, $pal_id);
}
elseif(!$pal_name){
	$searchquery = "SELECT * FROM pallets WHERE pal_id = %d";
	$searchquery = sprintf($searchquery, $pal_id);
}
else{
	$searchquery = "SELECT * FROM pallets WHERE pal_name = '%s'";
	$searchquery = sprintf($searchquery, $pal_name);
}

$result = $conn->query($searchquery);

$resultArray = array();

$count = 1;

if($result->num_rows>0){
	while($item = $result->fetch_assoc()){
		array_push($resultArray, ('item' . $count) => array(
			 'item_name' => $item["pal_name"], 'item_id' => $item["pal_id"], 'item_desc' => $item["pal_desc"]
			));

		count++;
	}
}
else{
	echo "No results.";
}

$result->close();

echo json_encode($resultArray);

?>