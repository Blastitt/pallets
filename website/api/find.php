<?php

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

while($item = $result->fetch_assoc()){
	array_push($resultArray, ('item' . $count) => array(
		 'item_name' => $item["pal_name"], 'item_id' => $item["pal_id"], 'item_desc' => $item["pal_desc"]
		));

	count++;
}

$result->close();

echo json_encode($resultArray);

?>