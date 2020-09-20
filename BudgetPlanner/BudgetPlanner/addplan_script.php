<?php
//connection established
require 'includes/common.php';

//Store form values into variables
$initialBudget =$_POST['Budget'];
$noOfPeople =$_POST['addPeople'];

//back-end validation:
if ($initialBudget < 50) {
    echo "<script>alert('value must be greater than or equal to 50')</script>";
    echo ("<script>location.href='addNewPlan.php'</script>");
}

if ($noOfPeople < 1) {
    echo "<script>alert('value must be greater than or equal to 1')</script>";
    echo ("<script>location.href='addNewPlan.php'</script>");
}

$initialBudget = mysqli_real_escape_string($con,$_POST['Budget']);
$noOfPeople = mysqli_real_escape_string($con,$_POST['addPeople']);

//create session variables
$_SESSION['initialBudget'] = $initialBudget;
$_SESSION['noOfPeople'] = $noOfPeople;

//send user to plandetails after plan added succesfully
echo ("<script>location.href='planDetails.php'</script>");
?>