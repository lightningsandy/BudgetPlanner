<?php
//connection established
require 'includes/common.php';

//Store form values into variables
$name = $_POST['name'];
$email = $_POST['e-mail'];
$password = $_POST['password'];
$phone = $_POST['contact'];

//back-end validation:
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
if(!preg_match($regex_email, $email)) {
    echo "<script>alert('Email entered is invalid')</script>";
    echo ("<script>location.href='signup.php'</script>");

}
if (strlen($password) < 6) {
    echo "<script>alert('Password must be minimum 6 digits')</script>";
    echo ("<script>location.href='signup.php'</script>");
}
$regex_phone = "/^[7-9]{1}[0-9]{9}$/i";
if(!preg_match($regex_phone, $phone)){
    echo "<script>alert('Not a valid phone number')</script>";
    echo ("<script>location.href='signup.php'</script>");
}
$name = mysqli_real_escape_string($con,$_POST['name']);
$email = mysqli_real_escape_string($con,$_POST['e-mail']);
$password = mysqli_real_escape_string($con,$_POST['password']);

//Query to check if email already exist
$select_query = "SELECT email FROM users WHERE email = '$email'";
$select_query_result = mysqli_query($con, $select_query) or die(mysqli_error($con));
$total_rows_fetched = mysqli_num_rows($select_query_result);
if($total_rows_fetched > 0){
    echo "<script>alert('Email address is already registered')</script>";
    echo ("<script>location.href='signup.php'</script>");
}
else{

//encrypt the password for Security 
$password = md5($password);

//store the user data in users table
$user_registration_query = "insert into users(name, email, phone_number, password) 
values ('$name', '$email', '$phone', '$password')";
$user_registration_submit = mysqli_query($con, $user_registration_query) or die(mysqli_error($con));
echo "<script>alert('User successfully registered')</script>";

//create id and email sessions
$_SESSION['id'] = mysqli_insert_id($con);
$_SESSION['email'] = $email;

//redirect user to home page
echo ("<script>location.href='home.php'</script>");
}
?>