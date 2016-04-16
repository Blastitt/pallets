<?php

$pal_name = $_GET["pal_name"];
$pal_id = $_GET["pal_id"];
$pal_desc = $_GET["pal_desc"];
$longitude = $_GET["long"];
$latitude = $_GET["lat"];
$pic1 = $_GET["pic1"];
$pic2 = $_GET["pic2"];
$pack_id = $_GET["pack_id"];
$pack_name = $_GET["pack_name"];
$pack_desc = $_GET["pack_desc"];
$pack_date = $_GET["pack_date"];
$project = $_GET["project"];

// Connect to MySQL
$conn = new mysqli("localhost", "pallet", "welcome@123", "pallets");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$addquery = "INSERT INTO pallets VALUES (%s, %d, %s, %s, %s, %s, %s, %s, %d, %s, %s, %s)";
$addquery = sprintf($addquery, $pal_name, $pal_id, $pal_desc, $longitude, $latitude, $pic1, $pic2, $pack_name, $pack_id, $pack_desc, $pack_date, $project);

$conn->query($addquery);

?>