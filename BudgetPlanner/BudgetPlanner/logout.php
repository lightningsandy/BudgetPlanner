<?php
//connection established
require 'includes/common.php';

//check if user is logged in; else redirected to login page
if (!isset($_SESSION['email'])) {
    echo ("<script>location.href='login.php'</script>");
}

//destroy session
session_destroy();
echo ("<script>location.href='index.php'</script>");
?>