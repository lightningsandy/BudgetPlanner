<?php
//connection established
require 'includes/common.php';

//check if user is logged in; else redirected to login page
if(!isset($_SESSION['id'])){ 
header('location: login.php');
exit; }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>View Plan | CTRL Budget</title>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body style="padding-top: 50px;" class="bgGray">

        <!-- Navigation-bar -->
        <?php
        include 'includes/header.php';
        ?>
        <!--Navigation-bar end-->

<?php 
$budPerId = $_GET['budPerId'];
$budgetId = $_GET['budId'];

//query to select image
$imageQuery=  "SELECT imageName FROM expense WHERE budPer_id = '$budPerId'";
$imageQuery_result = mysqli_query($con, $imageQuery) or die(mysqli_error($con));
if($imageQuery_result){
$row=  mysqli_fetch_array($imageQuery_result);
echo "<img src=".$row['imageName']." height = '130px' width = '130px'>";
}
else{
    //if image not found, this will be displayed
    echo "bill not available";
}
?>

<div class="formPad signBtn alignCenter">
        <a href="viewPlanPage.php?id=<?php echo $budgetId ?>" class="btn btn-lg btn-outline-success"><span class="glyphicon glyphicon-arrow-left"></span> Go Back</a>
</div>
