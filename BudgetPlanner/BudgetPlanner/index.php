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
        <title>Welcome | CTRL Budget</title>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body style="padding-top: 50px;">

        <!-- Navigation-bar -->
        <?php
        include 'includes/header.php';
        ?>
        <!--Navigation-bar end-->


        <div id="content">
            <!--Main banner image-->
            <div id = "banner_image">
                <div class="container">	
                    <center>
                        <div id="banner_content">
                            <h1>We help you control your budget</h1>
                            <br/>
                            <a  href="login.php" class="btn btn-success btn-lg ">Start Today</a>
                        </div>
                    </center>
                </div>
            </div>
            <!--Main banner image end-->

        </div>

        <!--Footer-->
        <?php
        include 'includes/footer.php';
        ?>
        <!--Footer end-->

    </body> 
</html>