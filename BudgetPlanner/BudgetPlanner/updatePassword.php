<?php
//connection established
require 'includes/common.php';

//Store form values into variables
$oldPassword = md5(mysqli_real_escape_string($con,$_POST['oldPass']));
$newPassword = md5(mysqli_real_escape_string($con, $_POST["newPass"]));
$confirmNewPassword = md5(mysqli_real_escape_string($con, $_POST["confirmPass"]));

//store session id into variable
$user_id = $_SESSION['id'];

//back end validation to check if new password and confirm new passowrd are equal
if($newPassword != $confirmNewPassword){
    echo "<script>alert('The passwords don’t match')</script>";
    echo ("<script>location.href='changePassword.php'</script>");

}
else{
   //Query to update the password
$update_password_query = "UPDATE users SET password = '$newPassword' WHERE users_id= $user_id AND password= '$oldPassword' ";
$update_password_result = mysqli_query($con, $update_password_query) or die(mysqli_error($con));
if($update_password_result){

    //on success, user is redirected to index page
    echo "<script>alert('Password updated')</script>";
    echo ("<script>location.href='index.php'</script>");
}
else{

    //on failure, user is redirected to change password page again with "wrong password" alert
    echo "<script>alert('You have entered wrong passwords ')</script>";
    echo ("<script>location.href='changePassword.php'</script>");
}
    
}
?>