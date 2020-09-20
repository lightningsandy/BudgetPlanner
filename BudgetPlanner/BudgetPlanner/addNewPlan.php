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
        <title>Create Plan | CTRL Budget</title>
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
                    <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 createFormModify">
                        <h2 class="alignCenter createPlanHeading bg-success">Create New Plan</h2>

                        <!-- form starting -->
                        <form  action="addplan_script.php" method="POST">
                            <div class="form-group formPad">
                                <label class="control-label" for="Budget">Initial Budget</label>
                                <input type="number" class="form-control" id="Budget" placeholder="Initial Budget(Ex. 4000)" min="50" name="Budget" title="value must be greater than or equal to 50" required autofocus>
                            </div>
                            <div class="form-group formPad">
                                <label for="addPeople">How many people you want to add in your group?</label>
                                <input type="number" class="form-control" id="addPeople" placeholder="No. of people"  name="addPeople" title="value must be greater than or equal to 1" min="1" required>
                            </div>
                            <div class="formPad signBtn">
                               <button type="submit" name="submit" class="btn btn-default btn-block btn-outline-success">Next</button>
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