<?php
//connection established
require 'includes/common.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>About us | CTRL Budget</title>
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

         <!-- aboutus-body -->
        <div class="container-fluid" id="content">
            <div class="row">
                <div class="container centerContent">
                    <div class="col-lg-6 col-md-6">
                        <h2 class="aboutPageHeading">Wow are we?</h2>
                        <p>We are a group of young technocrats who came up with an idea of solving budget and time issues which we usually
                            face in our daily lives. We are here to provide a budget controller according to your aspects
                        </p>
                        <p>Budget control is the biggest financial issue in the present world. One should look after their budget control
                            to get ride off from their financial crisis.
                        </p>
                        <h2 class="aboutPageHeading">Contact Us</h2>
                        <p><strong>Email:</strong> trainings@internshala.com</p>
                        <p><strong>Mobile:</strong> +91-8448444853</p>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h2 class="aboutPageHeading">Why choose us?</h2>
                        <p>We provide with a predominant way to control and manage your budget estimations with ease of accessing for 
                        multiple users.</p>
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