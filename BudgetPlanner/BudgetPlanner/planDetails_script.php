<?php
//connection established
require 'includes/common.php';

//Store form values into variables
$title = mysqli_real_escape_string($con,$_POST['title']);
// $fromDate =  $_POST['fromDate'];
$fromDate = date('Y-m-d',strtotime($_POST['fromDate']));
$toDate = date('Y-m-d',strtotime($_POST['toDate']));


//store sessions value into variables
$noOfPeople = $_SESSION['noOfPeople'];
$initialBudget = $_SESSION['initialBudget'];
$id =$_SESSION['id'];

//Query to insert plan details into budget table
$plan_details_query = "insert into budget(title, from_date, to_date, initialBudget, noOfPeople, userBudget_id) 
 values ('$title', '$fromDate' , '$toDate', '$initialBudget', '$noOfPeople' , '$id')";
$plan_details_submit = mysqli_query($con, $plan_details_query) or die(mysqli_error($con));

$budget_id = $con->insert_id;

//insert every person into person table
foreach($_POST['person'] as $personname)
{
$personname = mysqli_real_escape_string($con,$personname);   
$person_details_query = "insert into person(personName) 
values ('$personname')";
$person_details_submit = mysqli_query($con, $person_details_query) or die(mysqli_error($con));

//select last person id and store it in variable
$person_id = $con->insert_id;

//insert last budget id and every person id in budgetperson_map table
$budgetPerson_details_query = "insert into budgetPerson_map(budget_id, person_id) 
values ('$budget_id', '$person_id')";
$budgetPerson_details_submit = mysqli_query($con, $budgetPerson_details_query) or die(mysqli_error($con));
}

//redirect user to home page
echo "<script>alert('Your New Budget Planner Added Successfully')</script>";
echo ("<script>location.href='home.php'</script>");

?>