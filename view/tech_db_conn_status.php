<?php
session_start();
require_once(__DIR__ . '\..\model\database.php');
require_once(__DIR__.'\..\util\security.php');

Security::checkAuthority('tech');

//user clicked the logout button
if (isset($_POST['logout'])) {
    Security::logout();
}

//set error reporting to errors only
error_reporting(E_ERROR);

//create an instance of the Database class
$db = new Database();
?>

<html>
<head>
    <title>Alex McDonald Final Practical</title>
</head>
<body>
    <h1>Alex McDonald Final Practical</h1>
    <h1>Database Connection Status</h1>
    <?php if (strlen($db->getDbError())) : ?>
        <h2><?php echo $db->getDbError(); ?></h2>
        
        <h1> Connection failed!</h1>
        
    <?php else : ?>
    <ul>
        <li><?php echo "Database Name: " . $db->getDbName(); ?></li>
        <li><?php echo "Database User: " . $db->getDbUser(); ?></li>
        <li><?php echo "Database User Password: " . $db->getDbUserPw(); ?></li>
    </ul>
        <h1>Connection Successful!</h2>
    <?php endif; ?>
    <h2><a href='..\view\tech.php'>Home</a></h2>
    <form method='POST'>
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html> <!-- need to  meticulously go  through and standardize  logout  and home buttons -->