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
        <title>Expense Distribution | CTRL Budget</title>
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

        // store values from GET method
        $budgetId = $_GET['id'];
        $remainingAmount = $_GET['remainingAmount'];
        $totalAmount = $_GET['totalAmount'];

        //Query to select initial budget and no of peop;e
        $select_query = "SELECT initialBudget,noOfPeople FROM budget WHERE budget_id = $budgetId";
        $select_query_result = mysqli_query($con, $select_query) or die(mysqli_error($con));
        $initialBudgetArray = mysqli_fetch_array($select_query_result);

        //find individual amount and rounding it
        $individualShare = $totalAmount / $initialBudgetArray['noOfPeople'];
        $individualShare = round($individualShare);

        //different color according to remaining amount
        if ($remainingAmount < 0) $color = '#E24343';
        if ($remainingAmount == 0) $color = '#000000';
        if ($remainingAmount >= 1) $color = '#3DB049';
        ?>

        <div class="container-fluid" id="content">
            <div class="row">
                <div class="container centerContent">
                    <div class="col-xs-12 bg-success createPlanHeading row-bottom-margin formBorder">
                        <div class="col-xs-10 col-md-11">
                           <h2 class="alignCenter createPlanHeading modifyHeader">My First Plan</h2>
                        </div>
                        <div class="col-xs-2 col-md-1">
                            <h2 class="alignCenter createPlanHeading modifyHeader"><span class="glyphicon glyphicon-user"></span> 2</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="col-lg-12 col-md-12 formBorder createPlanHeading row-bottom-margin border-bottom-zero">


                        <div class="col-xs-6">
                            <h2 class=" createPlanHeading modifyHeader black">Initial Budget</h2><br>
                            <?php 

                            // query to display every person name
                            $select_person_query = "SELECT personName FROM budgetPerson_map INNER JOIN person ON person.person_id = budgetPerson_map.person_id 
                            WHERE budgetPerson_map.budget_id='$budgetId'";
                            $select_person_result = mysqli_query($con, $select_person_query) or die(mysqli_error($con));
                            while($personName = mysqli_fetch_array($select_person_result)){?>
                            <h2 class=" createPlanHeading modifyHeader black"><?php echo $personName['personName'] ?> </h2><br>
                            <?php } ?>

                            <h2 class=" createPlanHeading modifyHeader black">Total amount spent</h2><br>
                            <h2 class=" createPlanHeading modifyHeader black">Remaining Amount</h2><br>
                            <h2 class=" createPlanHeading modifyHeader black">Individual Shares</h2><br>
                           <?php 
                            //query to display every person name
                            $select_person_query = "SELECT personName FROM budgetPerson_map INNER JOIN person ON person.person_id = budgetPerson_map.person_id 
                            WHERE budgetPerson_map.budget_id='$budgetId'";
                            $select_person_result = mysqli_query($con, $select_person_query) or die(mysqli_error($con));
                            while($personName = mysqli_fetch_array($select_person_result)){?>
                            <h2 class=" createPlanHeading modifyHeader black"><?php echo $personName['personName'] ?> </h2><br>
                            <?php } ?>
                        </div>


                        <div class=" col-xs-6">
                             <h2 class="createPlanHeading modifyHeader alignRight black">&#8377 <?php echo $initialBudgetArray['initialBudget']; ?></h2><br>
                             <?php 

                             //query to get every person name
                            $select_person_query = "SELECT personName FROM budgetPerson_map INNER JOIN person ON person.person_id = budgetPerson_map.person_id 
                            WHERE budgetPerson_map.budget_id='$budgetId'";
                            $select_person_result = mysqli_query($con, $select_person_query) or die(mysqli_error($con));
                            while($personName = mysqli_fetch_array($select_person_result)){ 

                                //query to get amount spent by each person
                                $personAmountSpent = 0;
                            $select_Singleperson_query = "SELECT amountSpent FROM expense INNER JOIN budgetPerson_map ON budgetPerson_map.budgetPerson_id = expense.budPer_id
                            INNER JOIN person ON person.person_id = budgetPerson_map.person_id WHERE budgetPerson_map.budget_id='$budgetId' AND person.personName='".$personName['personName']."'";
                            $select_Singleperson_result = mysqli_query($con, $select_Singleperson_query) or die(mysqli_error($con));
                            if($select_Singleperson_result){

                                //to find total amount spent by each person
                            while($personAmount = mysqli_fetch_array($select_Singleperson_result)){
                                $personAmountSpent += (int)$personAmount['amountSpent'];
                                  }
                                  $personAmountSpent = round($personAmountSpent);
                                }
                                else{
                                    $personAmountSpent = 0;
                                }
                                  ?>
                            
                             <h2 class="createPlanHeading modifyHeader alignRight black">&#8377 <?php echo $personAmountSpent ?></h2><br>
                             <?php } ?>
                             <h2 class="createPlanHeading modifyHeader alignRight black">&#8377 <?php echo $totalAmount ?></h2><br>
                             <h2 class="createPlanHeading modifyHeader alignRight black"><?php echo"<span style=\"color: $color;\">&#8377 $remainingAmount</span>" ?></h2><br>
                             <h2 class="createPlanHeading modifyHeader alignRight black">&#8377 <?php echo $individualShare ?></h2><br>

                             <?php 

                             //query to select every person name and find person share
                            $select_person_query = "SELECT personName FROM budgetPerson_map INNER JOIN person ON person.person_id = budgetPerson_map.person_id 
                            WHERE budgetPerson_map.budget_id='$budgetId'";
                            $select_person_result = mysqli_query($con, $select_person_query) or die(mysqli_error($con));
                            while($personName = mysqli_fetch_array($select_person_result)){ 
                                $personAmountSpent = 0;
                            $select_Singleperson_query = "SELECT amountSpent FROM expense INNER JOIN budgetPerson_map ON budgetPerson_map.budgetPerson_id = expense.budPer_id
                            INNER JOIN person ON person.person_id = budgetPerson_map.person_id WHERE budgetPerson_map.budget_id='$budgetId' AND person.personName='".$personName['personName']."'";
                            $select_Singleperson_result = mysqli_query($con, $select_Singleperson_query) or die(mysqli_error($con));
                            if($select_Singleperson_result){
                            while($personAmount = mysqli_fetch_array($select_Singleperson_result)){
                                $personAmountSpent += (int)$personAmount['amountSpent'];
                                  }
                                }
                                else{
                                    $personAmountSpent = 0;
                                }

                                $personShare = $personAmountSpent - $individualShare; 
                                
                                //colors and text according to each person share
                                $personShare = round($personShare); 
                                if ($personShare == 0) {
                                    $personColor = '#000000';
                                    $personShare = "All settled up";
                                }
                                if ($personShare < 0) {
                                    $personColor = '#E24343';
                                    $personShare = abs($personShare);
                                    $personShare = "Owes " . $personShare;
                                } 
                                if ($personShare >= 1){ 
                                    $personColor = '#3DB049';
                                    $personShare = "Gets back " . $personShare;
                                }
                            
                                  ?>
                             <h2 class="createPlanHeading modifyHeader alignRight black"> <?php echo"<span style=\"color: $personColor;\">$personShare</span>" ?></h2><br>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="container">
                    <div class="col-lg-12 col-md-12 formBorder createPlanHeading border-top-zero">
                        <div class="formPad signBtn alignCenter">
                        <a href="viewPlanPage.php?id=<?php echo $budgetId ?>" class="btn btn-lg btn-outline-success"><span class="glyphicon glyphicon-arrow-left"></span> Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


       <!--Footer-->
       <?php
        include 'includes/footer.php';
        ?>
        <!--Footer end-->
    </body>
</html>