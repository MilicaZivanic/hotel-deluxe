<?php
  session_start();
	require_once "../config/connection.php";
	//  if($conn){
	//  	echo "Uspela konekcija";
    //  }
    if($_SERVER['REQUEST_URI'] == "/deluxe/admin/index.php" || $_SERVER['REQUEST_URI'] == "/deluxe/admin/"){
        echo "<script>window.open('index.php?dashboard','_self')</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Paradise Admin Area</title>
    <link rel="stylesheet" href="css/bootstrap-337.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<div id="wrapper">