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
        $budgetId = $_GET['id'];

        //query to get all budget details to display
        $select_query = "SELECT * FROM budget WHERE budget_id = '$budgetId' ";
        $select_query_result = mysqli_query($con, $select_query) or die(mysqli_error($con));
        $row = mysqli_fetch_array($select_query_result);

        //to convert date to required format
        $fromdate = strtotime($row['from_date']);
        $fromDate = date('d\t\h-M', $fromdate);
        $todate = strtotime($row['to_date']);
        $toDate = date('d\t\h-M-Y', $todate);  
       
        
        $totalAmountSpent = 0;
        

        //query to get all the expenses on given budget
        $select_totalAmount_query = "SELECT amountSpent FROM expense INNER JOIN budgetPerson_map ON budgetPerson_map.budgetPerson_id = expense.budPer_id 
        WHERE budgetPerson_map.budget_id='$budgetId'";
        $select_totalAmount_result = mysqli_query($con, $select_totalAmount_query) or die(mysqli_error($con));

        //code to calculate total amount spent and find remaning amount
        while($everyAmount = mysqli_fetch_array($select_totalAmount_result)){
             $totalAmountSpent += (int)$everyAmount['amountSpent'];
        }
        $pendingAmount = $row['initialBudget'] - $totalAmountSpent;

        //text color accoding to pending amount
        if ($pendingAmount < 0) $color = '#E24343';
        if ($pendingAmount == 0) $color = '#000000';
        if ($pendingAmount >= 1) $color = '#3DB049';
        ?>

        <div class="container-fluid" id="content">
            <div class="row">
                <div class="container centerContent">
                    <div class="col-md-7 col-xs-12 bg-success createPlanHeading row-bottom-margin formBorder">
                        <div class="col-xs-9 col-md-10">
                           <h2 class="alignCenter createPlanHeading modifyHeader"><?php echo $row['title']; ?></h2>
                        </div>
                        <div class="col-xs-3 col-md-2">
                            <h2 class="alignCenter createPlanHeading modifyHeader"><span class="glyphicon glyphicon-user"></span> <?php echo $row['noOfPeople']; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="col-md-7 col-xs-12 formBorder createPlanHeading">
                        <div class="col-xs-6">
                            <h2 class=" createPlanHeading modifyHeader black">Budget</h2>
                            <h2 class=" createPlanHeading modifyHeader black">Remaining Amount</h2>
                            <h2 class=" createPlanHeading modifyHeader black">Date</h2>
                         </div>
                         <div class="col-xs-6">
                             <h2 class="createPlanHeading modifyHeader alignRight black">&#8377 <?php echo $row['initialBudget']; ?></h2>
                             <h2 class="createPlanHeading modifyHeader alignRight"> <?php echo"<span style=\"color: $color;\">&#8377 $pendingAmount</span>" ?></h2>
                             <h2 class="createPlanHeading modifyHeader alignRight black"><?php echo $fromDate;?> - <?php echo $toDate; ?></h2>
                         </div>
                    </div>
                    <div class="col-lg-4 col-lg-offset-1 col-md-6 col-xs-12 ">
                        <div class="formPad signBtn">
                        <a href="expenseDistribution.php?id=<?php echo $budgetId ?>&amp;totalAmount=<?php echo $totalAmountSpent ?>&amp;remainingAmount=<?php echo $pendingAmount ?>" name="plan" class="btn btn-block btn-outline-success">Expense Distribution</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="container centerContent">
                    <div class="col-md-7 col-xs-12">
                        <!-- Query to get all expense details -->
                        <?php
                            
                            //query to select required details 
                            $select_expenseDetails_query = "SELECT amountSpent,expenseTitle, dateAmountSpent, personName, budPer_id FROM expense INNER JOIN budgetPerson_map ON budgetPerson_map.budgetPerson_id = expense.budPer_id 
                            INNER JOIN person ON person.person_id = budgetPerson_map.person_id WHERE budgetPerson_map.budget_id='$budgetId'";
                            $select_expenseDetails_result = mysqli_query($con, $select_expenseDetails_query) or die(mysqli_error($con));
                            while($expenseDetail = mysqli_fetch_array($select_expenseDetails_result)){
                            
                            //convert date to required format
                            $dateSpent = strtotime($expenseDetail['dateAmountSpent']);
                            $dateSpent = date('d\t\h-M-Y', $dateSpent);
                        ?>
                        <div class="col-md-5 col-xs-12 createPlanHeading formBorder pad-top-zero border-top-zero margin-right">
                            <h2 class="alignCenter createPlanHeading bg-success borderZero"><?php echo $expenseDetail['expenseTitle']; ?></h2>
                            <div class="col-lg-5 col-md-5">
                                <h2 class=" createPlanHeading modifyHeader black">Amount</h2>
                                <h2 class=" createPlanHeading modifyHeader black">Paid by</h2>
                                <h2 class=" createPlanHeading modifyHeader black">Paid on</h2>
                            </div>
                            <div class="col-lg-7 col-md-7">
                                <h2 class="createPlanHeading modifyHeader alignRight black">&#8377 <?php echo $expenseDetail['amountSpent']; ?></h2>
                                <h2 class="createPlanHeading modifyHeader alignRight black"><?php echo $expenseDetail['personName']; ?></h2>
                                <h2 class="createPlanHeading modifyHeader alignRight black"><?php echo $dateSpent; ?></h2>
                            </div>
                            <div class="col-lg-12 col-md-12 container-margin-top">
                                <div class=" signBtn alignCenter">
                                    <a href="showBill.php?budPerId=<?php echo $expenseDetail['budPer_id'];?>&amp;budId=<?php echo $budgetId?>">show bill</a>
                                </div>
                            </div>  
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-4 col-md-offset-1 col-xs-12 createFormModify container-margin-top">
                        <h2 class="alignCenter createPlanHeading bg-success">Create New Plan</h2>

                        <!-- form starting -->
                        <form action="expense_script.php?budId=<?php echo $budgetId?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group formPad">
                                <label class="control-label" for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Expense Name" name="title" required autofocus>
                            </div>
                            <div class="form-group formPad">
                                <label for="Date">Date</label>
                                <input type="date" min="<?php echo $row['from_date']; ?>" max="<?php echo $row['to_date'];?>" class="form-control" id="Date" placeholder="dd-09-2019" name="dateSpent" required>
                            </div>
                            <div class="form-group formPad">
                                <label class="control-label" for="Amount">Amount Spent</label>
                                <input type="number" class="form-control" id="Amount" placeholder="Amount Spent" min="0" name="Amount" required>
                            </div>                        
                            <div class="form-group formPad">
                                <select class="form-control" placeholder="Choose" name="personSpent" required>
                                    <option value="" selected disabled>Choose</option>

                                    <!-- Query to get all person name in a budget to create select form -->
                                    <?php 
                                     $select_allPerson_query = "SELECT personName FROM person INNER JOIN budgetPerson_map ON budgetPerson_map.person_id = person.person_id
                                     WHERE budgetPerson_map.budget_id='$budgetId'";
                                     $select_allPerson_result = mysqli_query($con, $select_allPerson_query) or die(mysqli_error($con));
                                     while($allPerson = mysqli_fetch_array($select_allPerson_result)){ ?>
                                    <option><?php echo $allPerson['personName']; ?></option>
                                    <?php } ?>
                                  </select>
                            </div>
                            <div class="form-group formPad">
                                <label class="control-label" for="upload">Upload Bill</label>
                                <label class="btn btn-default btn-block">
                                <input type="file" id="upload" name="uploadedimage">
                                </label>
                            </div>
                            <div class="formPad signBtn">
                                <button type="submit" name="submit" class="btn btn-default btn-block btn-outline-success">Add</button>
                            </div>
                        </form>
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