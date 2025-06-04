<?php
session_start();

require_once(__DIR__.'\..\util\security.php');

//confirm user is authorized for the page
Security::checkAuthority('tech');

//user clicked the logout button
if (isset($_POST['logout'])) {
    Security::logout();
}
if (isset($_POST['subPage'])) {
    header("Location: ../tech_incident_management.php");
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
    <h2>Manage Incidents</h2>
    <ul>
        <li><h2><a href="tech_incident_management.php" name="subPage">Manage Incidents</a></h2></li>
        <li><h2><a href="tech_db_conn_status.php" name="subPage2">View DB Status</a></h2></li>
    </ul>
    <form method='POST'>
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>