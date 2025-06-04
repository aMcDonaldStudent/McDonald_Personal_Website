<?php //This file is obsolete but is left in because I  don't want to mess with security.php
session_start();

require_once(__DIR__.'\..\util\security.php');

//confirm user is authorized for the page
Security::checkAuthority('user');

//user clicked the logout button
if (isset($_POST['logout'])) {
    Security::logout();
}
if (isset($_POST['home'])) {
    header("Location: ../user.php");
} //unsure if these are necessary actually but they don't hurt (it probably works with just link)
?>
<html>
<head>
    <title>Alex McDonald Final Practical</title>
</head>
<body>
    <h1>Alex McDonald Final Practical</h1>
    <h2>Products</h2>
    <ul>
        <li><h2><a href="user.php" name="home">Home</a></h2></li>
    </ul>
    <form method='POST'>
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>