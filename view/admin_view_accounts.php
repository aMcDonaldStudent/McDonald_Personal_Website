<?php
session_start();

require_once(__DIR__.'\..\util\security.php');
require_once(__DIR__ . '\..\controller\user.php');
require_once(__DIR__ . '\..\controller\user_controller.php');

if (isset($_POST['update'])) {
    //update button pressed for a user
    if (isset($_POST['cNoUpd'])) {
        header('Location: ./admin_add_update_user.php?cNo=' . $_POST['cNoUpd']);
    }

    unset($_POST['update']);
    unset($_POST['cNoUpd']);
}

if (isset($_POST['delete'])) {
    //delete button pressed for a user
    if (isset($_POST['cNoDel'])) {
        UserController::deleteUser($_POST['cNoDel']);
    }

    unset($_POST['delete']);
    unset($_POST['cNoDel']);
}


//confirm user is authorized for the page
Security::checkAuthority('admin');

//user clicked the logout button
if (isset($_POST['logout'])) {
    Security::logout();
}
if (isset($_POST['home'])) {
    header("Location: ../admin.php");
} //unsure if these are necessary actually but they don't hurt (it probably works with just link)
?>
<html>
<head>
    <title>Alex McDonald Final Practical</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>
    <h1>Alex McDonald Final Practical</h1>
    <h1>User Accounts Table</h1>
    <h2><a href="./admin_add_update_user.php">Add User</a></h2>
    <table>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Hire Date</th>
            <th>E-Mail  Address</th>
            <th>Extension</th>
            <th>Level</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach (UserController::getAllUsers() as $user) : ?>
        <tr> <!--I didn't want to overcomplicate and use both databases so I  took measures to
        make it look as it should without interacting with both-->
            <td><?php echo $user->getUserId(); ?></td>
            <td><?php echo $user->getFirstName(); ?></td>
            <td><?php echo $user->getLastName(); ?></td>
            <td><?php echo $user->getHireDate(); ?></td>
            <td><?php echo $user->getEMail(); ?></td>
            <td><?php echo $user->getExtension(); ?></td>
            <td><?php $userLevelFix = $user->getUserLevelNo(); 
            echo ($userLevelFix == 1) ? 'Administrator' : (($userLevelFix == 2) ? 'Technician' 
            : 'big error');?></td>
            <td><form method="POST">
                <input type="hidden" name="cNoUpd"
                    value="<?php echo $user->getUserNo(); ?>"/>
                <input type="submit" value="Update" name="update" />
            </form></td>
            <td><form method="POST">
                <input type="hidden" name="cNoDel"
                    value="<?php echo $user->getUserNo(); ?>"/>
                <input type="submit" value="Delete" name="delete" />
            </form></td>
        </tr>
        <?php endforeach; ?>
        
    </table>

    
    <h2><a href="admin.php" name="home">Home</a></h2>
    
    <form method='POST'>
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>