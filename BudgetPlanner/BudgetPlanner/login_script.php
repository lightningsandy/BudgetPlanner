<?php
//connection established
require 'includes/common.php'; 

//Store form values into variables
$email = $_POST['e-mail'];
$password = $_POST['password'];

//backend validation
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
if(!preg_match($regex_email, $email)) {
    echo "<script>alert('email not correct')</script>";
    echo ("<script>location.href='login.php'</script>"); 
}
if (strlen($password) < 6) {
    echo "<script>alert('password not correct')</script>";
    echo ("<script>location.href='login.php'</script>");
}
//Encrypt password for security
$email = mysqli_real_escape_string($con,$email);
$password = mysqli_real_escape_string($con,$password);
$password = md5($password);

//Query to check if username and password is correct
$select_query = "SELECT users_id, email FROM users WHERE email = '$email' AND password = '$password'";
$select_query_result = mysqli_query($con, $select_query) or die(mysqli_error($con));
$total_rows_fetched = mysqli_num_rows($select_query_result);

//redirected to login page again if password is wrong
if($total_rows_fetched == 0){
    echo "<script>alert('user not found')</script>";
    echo ("<script>location.href='login.php'</script>");
}

//user id and email sessions is created and redirected to home page
else{
$row = mysqli_fetch_array($select_query_result);
$_SESSION['email'] = $row[1];
$_SESSION['id'] = $row[0];
header('location: home.php');
}
?> 