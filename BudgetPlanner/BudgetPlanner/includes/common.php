<?php
$servername="localhost";
$username="root";
$password="";
$con = mysqli_connect($servername, $username, $password, "ctrlBudget_db") or die(mysqli_erroe($con));
session_start();
?>