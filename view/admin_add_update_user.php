<?php
    session_start();
    require_once(__DIR__.'\..\util\security.php'); 
    require_once(__DIR__ . '\..\controller\user.php');
    require_once(__DIR__ . '\..\controller\user_controller.php');

    //$categories = CategoryController::getAllCategories();
    //HERE ARE ALL THE ERRORS CREATED FOR LATER
    
    
    //$cFirstName = '';
    
    //need to make/fake the vars here it seems
    //nevermind not necessary

    $userId_error = '';
    $password_error= '';
    $firstName_error = '';
    $lastName_error = '';
    $hireDate_error = '';
    $eMail_error = '';
    $extension_error = '';
    $userLevelNo_error = '';
    

    if (isset($_POST['UserId']))
        $userId = $_POST['UserId'];
    if (isset($_POST['Password']))
        $password = $_POST['Password'];
    if (isset($_POST['FirstName']))
        $firstName = $_POST['FirstName'];
    if (isset($_POST['LastName']))
        $lastName = $_POST['LastName'];
    if (isset($_POST['HireDate']))
        $hireDate = $_POST['HireDate'];
    //this is here so it can save like the others, no actual validation
    //is needed for line 2
    if (isset($_POST['EMail']))
        $eMail = $_POST['EMail'];
    if (isset($_POST['Extension']))
        $extension = $_POST['Extension'];
    if (isset($_POST['UserLevelNo']))
        $userLevelNo = $_POST['UserLevelNo'];
    

    //default person for add - empty strings and first role
    //in list
    $user = new User('', '', '', '', '', '', '', '');
    $user->setUserNo(-1);
    //I somehow messed up it naturally keeping data between submits and this line
    //saved that because i learned you can do this with all the variables inside
    //the "if" to keep them.
    $pageTitle = "Add a New User";

    //Retrieve the personNo from the query string and 
    //and use it to create a person object for that pNo
    if (isset($_GET['cNo'])) {
        $user = 
            UserController::getUserByNo($_GET['cNo']);
        $pageTitle = "Update an Existing User";
    }

    if (isset($_POST['save'])) {

        //this block saves all the stuff when you hit "save" and it errors
        $user->setUserId($userId);
        $user->setPassword($password);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setHireDate($hireDate);
        $user->setEMail($eMail);
        $user->setExtension($extension);
        $user->setUserLevelNo($userLevelNo);
        
        
        //This block is the special validations:
        //I am running this first so it will simply say "required if the field is empty
        if (strlen($userId) < 4)
            $userId_error = "Must be at least 4 characters.";
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d])[A-Za-z\d\W]{4,20}$/',$password))
        //this regex code is honestly a war crime but idk how else to do this
            $password_error = "Password must be 4-20 chars including at least one upper, one lower, one digit, and a special character in the set";
        //if (strlen($password) < 4 || strlen($password) > 20){
            //$password_error = "Password must be 4-20 chars including at least one upper, one lower, one digit, and a special character in the set";
        //} else if
        if (strlen($firstName) < 2)
            $firstName_error = "Must be at least 2 characters.";
        if (strlen($lastName) < 2)
            $lastName_error = "Must be at least 2 characters.";
        if (!filter_var($eMail, FILTER_VALIDATE_EMAIL))
            $eMail_error = "Not a valid email address.";
        if (!preg_match('/^\d{5}$/', $extension))
            $extension_error = "Invalid extension - 5 digits only";
        
        

         //turning off validation for now just to test that it works
        
    //Huge block of validation to make sure none of these fields are empty

    //This  is another part of validation that wont work until top checks are on
        if (strlen($userId) < 1)
        $userId_error = "Required";
        if (strlen($password) < 1)
        $password_error = "Required";
        if (strlen($firstName) < 1)
        $firstName_error = "Required";
        if (strlen($lastName) < 1)
        $lastName_error = "Required";
        if (strlen($hireDate) < 1)
        $hireDate_error = "Required";
        if (strlen($eMail) < 1)
        $eMail_error = "Required";
        if (strlen($extension) < 1)
        $extension_error = "Required";

        /*
        if (strlen($userLevelNo) < 1)
        $userLevelNo_error = "Required";
        */
        //I don't think  this error is possible ^^
    
    

       
        if (strlen($userId_error) > 0 || strlen($password_error) > 0 || strlen($firstName_error) > 0 
        || strlen($lastName_error) > 0 || strlen($hireDate_error) > 0 || strlen($eMail_error) > 0 
        || strlen($extension_error) > 0 ) {
            //echo "There are validation errors!";
        } else {
            //runs if all conditions satisfied
            $user = new User($_POST['UserId'], $_POST['FirstName'],
            $_POST['LastName'], $_POST['EMail'], $_POST['Password'], $_POST['HireDate'],
            $_POST['Extension'], $_POST['UserLevelNo'], ''); //this is empty value instantly fixed in next line
            $user->setUserNo($_POST['cNo']);
                    
            if ($user->getUserNo() === '-1') {
                //add
                UserController::addUser($user);
                header('Location: ./admin_view_accounts.php');
                //returns us

            } else {
                //update
                UserController::updateUser($user);
                header('Location: ./admin_view_accounts.php');
                //retruns to main page
            }
        }

        //return to people list
        //have to disable it automatically leaving
    }

    if (isset($_POST['cancel'])) {
        //cancel button - just go back to list
        header('Location: ./admin_view_accounts.php');
    }
?>

<html>
<head>
    <title>Alex McDonald Final Practical</title>
</head>
<body>
    <h1>Alex McDonald Final Practical</h1>
    <h2><?php echo $pageTitle; ?></h2>
    <form method='POST'>
        <h3>User ID: <input type="text" name="UserId"
            value="<?php echo $user->getUserId(); ?>">
            <?php if (strlen($userId_error) > 0)
                echo "<span style='color: red;'>{$userId_error}</span>"; ?>
        </h3>
        <h3>Password: <input type="text" name="Password"
            value="<?php echo $user->getPassword(); ?>">
            <?php if (strlen($password_error) > 0)
                echo "<span style='color: red;'>{$password_error}</span>"; ?>
        </h3>
        <h3>First Name: <input type="text" name="FirstName"
            value="<?php echo $user->getFirstName(); ?>">
            <?php if (strlen($firstName_error) > 0)
                echo "<span style='color: red;'>{$firstName_error}</span>"; ?>
        </h3>
        <h3>Last Name: <input type="text" name="LastName"
            value="<?php echo $user->getLastName(); ?>">
            <?php if (strlen($lastName_error) > 0)
                echo "<span style='color: red;'>{$lastName_error}</span>"; ?>
        </h3>
        <h3>Hire Date: <input type="date" name="HireDate"
            value="<?php echo $user->getHireDate(); ?>">
            <?php if (strlen($hireDate_error) > 0)
                echo "<span style='color: red;'>{$hireDate_error}</span>"; ?>
        </h3>
        <h3>E-Mail: <input type="text" name="EMail"
            value="<?php echo $user->getEMail(); ?>">
            <?php if (strlen($eMail_error) > 0)
                echo "<span style='color: red;'>{$eMail_error}</span>"; ?>
        </h3>
        <h3>Extension: <input type="text" name="Extension"
            value="<?php echo $user->getExtension(); ?>">
            <?php if (strlen($extension_error) > 0)
                echo "<span style='color: red;'>{$extension_error}</span>"; ?>
        </h3>
        <h3>Level: <select name="UserLevelNo">
            <option value="1" <?php if ($user->getUserLevelNo() == 1); ?>>
            Administrator</option>
            <option value="2" <?php if ($user->getUserLevelNo() == 2); ?>>
            Technician </option>
        </select>
        </h3>
        <input type="hidden" 
            value="<?php echo $user->getUserNo(); ?>" name="cNo">
        <input type="submit" value="Save" name="save">
        <input type="submit" value="Cancel" name="cancel">
    </form>
</body>
</html>
