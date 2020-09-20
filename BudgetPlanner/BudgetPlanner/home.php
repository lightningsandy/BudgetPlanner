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
        <title>Home | CTRL Budget</title>
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

        //store session id into a variable
        $user_id = $_SESSION['id'];

        //query to select all buget details data for the specific user
        $select_query = "SELECT * FROM budget WHERE userBudget_id = $user_id";
        $select_query_result = mysqli_query($con, $select_query) or die(mysqli_error($con));
        $total_rows_fetched = mysqli_num_rows($select_query_result);
        if($total_rows_fetched > 0){  ?>

        <!-- if plans exists in the db , the following code runs -->
        <div class="container-fluid" id="content">
            <div class="row">
                <div class="container">
                       <h1 class="centerContent signBtn">Your Plans</h1>
                    <?php while($row = mysqli_fetch_array($select_query_result)) {

                          //convert date to required format
                          $fromdate = strtotime($row['from_date']);
                          $fromDate = date('d\t\h-M', $fromdate);
                          $todate = strtotime($row['to_date']);
                          $toDate = date('d\t\h-M-Y', $todate);   ?> 
                          
                        <div class="col-md-4 col-xs-12">
                            <div class="col-xs-12 bg-success createPlanHeading row-bottom-margin formBorder">
                                <div class="col-xs-8">
                                    <h2 class="alignCenter createPlanHeading modifyHeader"><?php echo $row['title']; ?></h2>
                                </div>
                                <div class="col-xs-4">
                                    <h2 class="alignCenter createPlanHeading modifyHeader"><span class="glyphicon glyphicon-user"></span>  <?php echo $row['noOfPeople']; ?></h2>
                                </div>
                            </div>
                            <div class="col-xs-12 formBorder createPlanHeading row-bottom-margin border-bottom-zero">
                                <div class="col-xs-2">
                                    <h2 class=" createPlanHeading modifyHeader black">Budget</h2>
                                    <h2 class=" createPlanHeading modifyHeader black">Date</h2>
                                </div>
                                <div class="col-xs-10">
                                    <h2 class="createPlanHeading modifyHeader alignRight black">&#8377 <?php echo $row['initialBudget']; ?></h2>
                                    <h2 class="createPlanHeading modifyHeader alignRight black"><?php echo $fromDate;?> - <?php echo $toDate; ?></h2>
                                </div>
                            </div>
                            <div class="col-xs-12 formBorder  border-top-zero">
                                <div class=" signBtn alignCenter">
                                    <a href="viewPlanPage.php?id=<?php echo $row['budget_id'] ?>" name="plan" class="btn btn-block btn-outline-success">View Plan</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            
        </div>
        <div class="alignRight margin-right">
                <a href="addNewPlan.php"><span class="glyphicon glyphicon-plus-sign"></span>
            </div>

        <?php
        }
        else{ ?>

        <!-- if no plans exist in dv, the following code runs -->
        <div class="container-fluid decor_bg" id="content">
            <div class="row">
                <div class="container centerAbout">
                    <div class="col-lg-8 col-md-8">
                        <h2 class="aboutHeading">You don't have any active plans</h2>
                    </div>
                    
                    <!-- centering element -->
                    <div class="container">
                        <div class="row">
                            <div class="text-center col-md-4 col-md-offset-4">
                                <div class="createPlan">
                                    <a href="addNewPlan.php"><span class="glyphicon glyphicon-plus-sign" style="font-size:15px;"></span> Create a New Plan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>



        <!--Footer-->
        <?php
        include 'includes/footer.php';
        ?>
        <!--Footer end-->
    </body>
</html>