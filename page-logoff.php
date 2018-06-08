<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: page-login.php"); // Redirecting To Home Page
}
?>