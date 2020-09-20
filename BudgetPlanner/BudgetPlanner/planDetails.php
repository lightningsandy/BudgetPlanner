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
        <title>Plan Details | CTRL Budget</title>
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


        <div class="container-fluid" id="content">
            <div class="row">
                <div class="container">
                    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 formModify">

                       <!-- form starting -->
                        <form action="planDetails_script.php" method="POST">
                            <div class="form-group formPad">
                                <label class="control-label" for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter Title(Ex. Trip to Goa)" name="title" required autofocus>
                            </div>
                            <div class="form-row">
                                <div class="form-group formPad col-md-6">
                                    <label for="fromDate">From</label>
                                    <input type="date" min="2020-08-24" max="2021-01-01" class="form-control" id="fromDate" name="fromDate" placeholder="dd/mm/yyyy" required>
                                </div>
                                <div class="form-group formPad col-md-6">
                                    <label for="toDate">To</label>
                                    <input type="date" min="2020-08-24" max="2021-01-01" class="form-control" id="toDate" name="toDate" placeholder="dd/mm/yyyy" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group formPad col-md-8">
                                   <label for="intialBudget">Initial Budget</label>
                                   <input type="number" class="form-control" id="initialBudget" value="<?php echo $_SESSION['initialBudget']?>" readonly>
                                </div>
                                <div class="form-group formPad col-md-4">
                                  <label for="noPeople">No. of people</label>
                                  <input type="number" class="form-control" id="noPeople" value="<?php echo $_SESSION['noOfPeople']?>" readonly>
                                </div>
                            </div>
                             
                            <!-- create an input tag for no of person Mentioned in previous form using sessions -->
                            <?php     
                            foreach(range(1,$_SESSION['noOfPeople']) as $index) { ?>
                               <div class="form-group formPad">
                              <label for="person1">Person <?php echo $index; ?></label>
                              <input type="text" class="form-control" id="person1" placeholder="Person <?php echo $index; ?> Name" name="person[<?php $index ?>]" required>
                            </div>

                            <?php } ?>
                            
                            <div class="formPad signBtn">
                                <button type="submit" name="submit" class="btn btn-default btn-block btn-outline-success">Submit</button>
                            </div>
                          </form>
                          <!-- form ending -->

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