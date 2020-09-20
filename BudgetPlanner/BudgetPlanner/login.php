<?php
//connection established
require 'includes/common.php';

//check if user is logged in; else redirected to login page
if (isset($_SESSION['id'])) {
    header('location: home.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login | CTRL Budget</title>
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
                        <h2 class="alignCenter signup">Login</h2>
                        <hr>

                        <!-- form starting -->
                        <form  action="login_script.php" method="POST">
                            <div class="form-group formPad">
                                <label for="e-mail">Email:</label>
                                <input type="email" class="form-control" id="e-mail" placeholder="Email"  name="e-mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Email entered is invalid" required autofocus>
                            </div>
                            <div class="form-group formPad">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" pattern=".{6,}" title="Must contain six or more character" required>
                            </div>
                            <div class="formPad">
                                <button type="submit" name="submit" class="btn btn-success btn-block">Login</button>
                             </div>
                        </form>
                        <!-- form ending -->

                        <hr class="lowerBreak">
                        <div class="redirectSignup">
                            <p class="alignCenter signup">Don't have an account? <a href="signup.php">Click here to signup</a></p>
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