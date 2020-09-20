<?php
//connection established
require 'includes/common.php';

//Store form values into variables
$title = mysqli_real_escape_string($con,$_POST['title']);
$dateSpent = date('Y-m-d',strtotime($_POST['dateSpent']));
$amount = mysqli_real_escape_string($con,$_POST['Amount']);
$personSpent = mysqli_real_escape_string($con,$_POST['personSpent']);
$budgetId = $_GET['budId'];

//store session value into variables
$id = $_SESSION['id'];

//Query to get budgetperson_id for the mentioned person from budgetPerson_map table
$select_budper_query = "SELECT budgetPerson_id FROM budgetPerson_map INNER JOIN budget ON budget.budget_id = budgetPerson_map.budget_id 
INNER JOIN person ON person.person_id = budgetPerson_map.person_id WHERE person.personName='$personSpent'";
$select_budper_result = mysqli_query($con, $select_budper_query) or die(mysqli_error($con));
$budgetPersonid = mysqli_fetch_array($select_budper_result);
$budgetPerson_id = $budgetPersonid['budgetPerson_id'];


//code to store image file in db
function GetImageExtension($imagetype){
    if(empty($imagetype)) return false;
    switch($imagetype){
    case 'image/bmp': return '.bmp';
    case 'image/gif': return '.gif';
    case 'image/jpeg': return '.jpg';
    case 'image/png': return '.png';
    default: return false;
    }
    }

    if (!empty($_FILES["uploadedimage"]["name"])) {
        echo $_SERVER['DOCUMENT_ROOT'];
    $file_name=$_FILES["uploadedimage"]["name"];
    $temp_name=$_FILES["uploadedimage"]["tmp_name"];
    $imgtype=$_FILES["uploadedimage"]["type"];
    $ext= GetImageExtension($imgtype);
    $imagename=date("d-m-Y")."-".time().$ext;
    $target_path = $_SERVER['DOCUMENT_ROOT']. "/img/".$imagename;
    if(move_uploaded_file($temp_name, $target_path)){
       
        //if bill is added, the details of expense is added to expense table along with bill
       $expense_details_query = "insert into expense(expenseTitle, dateAmountSpent, amountSpent, imageName, budPer_id) 
       values ('$title', '$dateSpent','$amount', '.$temp_name.', '$budgetPerson_id')";
       $expense_details_submit = mysqli_query($con, $expense_details_query) or die(mysqli_error($con));

       //user redirected to viewplanpage on success
        echo "<script>alert('expense successfully added')</script>";
        echo ("<script>location.href='viewPlanPage.php'</script>");
    }
    }
    else{
        //if bill is not added, the details of expense is added to expense table without bill
        $expense_details_query = "insert into expense(expenseTitle, dateAmountSpent, amountSpent, budPer_id) 
        values ('$title', '$dateSpent','$amount', '$budgetPerson_id')";
        $expense_details_submit = mysqli_query($con, $expense_details_query) or die(mysqli_error($con));

        //user redirected to viewplanpage on success
        echo "<script>alert('expense successfully added')</script>";
        echo ("<script>location.href='viewPlanPage.php?id= $budgetId'</script>");
    }

?>