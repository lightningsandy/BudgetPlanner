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
        <title>Change Password | CTRL Budget</title>
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
                    <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 formModify">
                        <h2 class="alignCenter signup ">Change Password</h2>
                        <hr>

                        <!-- form starting -->
                        <form  action="updatePassword.php" method="POST">
                            <div class="form-group formPad">
                                <label class="control-label" for="oldPass">Old Password</label>
                                <input type="password" class="form-control" id="oldPass" placeholder="Old Password" name="oldPass" required autofocus>
                            </div>
                            <div class="form-group formPad">
                                <label class="control-label" for="newPass">New Password</label>
                                <input type="password" class="form-control" id="newPass" placeholder="New Password(Min. 6 characters)" pattern=".{6,}" name="newPass" required>
                            </div>
                            <div class="form-group formPad">
                                <label class="control-label" for="confirmPass">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirmPass" placeholder="Re-type New Password" pattern=".{6,}" name="confirmPass" required >
                            </div>
                            <div class="formPad signBtn">
                               <button type="submit" name="submit" class="btn btn-success btn-block">Change</button>
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