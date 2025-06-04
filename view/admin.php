<?php
session_start();

require_once(__DIR__.'\..\util\security.php');

//confirm user is authorized for the page
Security::checkAuthority('admin');

//user clicked the logout button
if (isset($_POST['logout'])) {
    Security::logout();
}
if (isset($_POST['subPage'])) {
    header("Location: ../admin_view_accounts.php");
} //unsure if these are necessary actually but they don't hurt (it probably works with just link)
if (isset($_POST['subPage2'])) {
    header("Location: ../admin_view_accounts.php");
} 
?>
<html>
<head>
    <title>Alex McDonald Final Practical</title>
</head>
<body>
    <h1>Alex McDonald Final Practical</h1>
    <h2>Administrator Options</h2>
    <ul>
        <li><h2><a href="admin_view_accounts.php" name="subPage">Manage Users</a></h2></li>
        <li><h2><a href="admin_image_management.php" name="subPage2">Manage Images</a></h2></li>
    </ul>
    <form method='POST'>
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>