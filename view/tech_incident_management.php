<?php //security and logout added
session_start();
require_once(__DIR__.'\file_utilities.php');
require_once(__DIR__.'\..\util\security.php');
// forward?
//get logs directory in current working directory
$dir = getcwd() . "/logs/";
//confirm user is authorized for the page
Security::checkAuthority('tech');

//user clicked the logout button
if (isset($_POST['logout'])) {
    Security::logout();
}

//Trying to create default values to show create and then flick these on and off




//One bug I never did solve that irks me is that when the dropdown resets after loading the program
//does not remember which exact entry you were on so you are liable to accidentally
//saving the edits to whatever the dropdown has defaulted to.
//This is a non-issue with the demonstration when it works with just 1 file but
//important to keep in mind nonetheless. You have to manually change the drop-down back
//to make sure it is saving to the correct file.

//OTHERWISE KNOWN BUG: (attempting to create a new file after viewing one has the box in view mode)
//THis bug errors at the top but is harmless and then it auto puts you into create/edit mode after
//so it's really just a sequential error only.

 //In the example this is by default pretty much a create box
//I don't know if defaulting it to create might have problems later but I should test that.
$displayMode = 'create';
$currentBox = '';
$fName = '';
//natural clear thingy (might be obsolete)

//could only find this weird check to make this work
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['view'])) {
        $fName = $_POST['fileToView'];
        $currentBox = FileUtilities::GetFileContents($dir . $fName);
        $displayMode = 'view';
    }
    if (isset($_POST['load'])) {
        $fName = $_POST['fileToView'];
        $currentBox = FileUtilities::GetFileContents($dir . $fName);
        $displayMode = 'edit';
    }
    if (isset($_POST['save'])) {
        if (isset($_POST['displayMode']) && $_POST['displayMode'] === 'edit') {
            $fName = $_POST['fileToView'];
            $currentBox = $_POST['editFile'];
            FileUtilities::WriteFile($dir . $fName, $currentBox);
            $currentBox = '';
            $displayMode = 'create';
        }
    }
    if (isset($_POST['create'])) {
        $fName = $_POST['newFileName'];
        $currentBox = $_POST['createFile'];
        FileUtilities::WriteFile($dir . $fName, $currentBox);
        $currentBox = '';
        $displayMode = 'create';
    }
}
?>
<html>
<head>
    <title>Alex McDonald Final Practical</title>
</head>
<body>
    <h1>Alex McDonald Final Practical</h1>
    <h3>Text File Operations:</h3>
    <form method="POST">
    <h3>View Log File: <select name="fileToView">
        <!--this is actually just the dropdown which can probably work for all? -->
        <?php foreach(FileUtilities::GetFileList($dir) as $file) : ?>
            <option value="<?php echo $file; ?>"><?php echo $file; ?>
            </option>
        <?php endforeach; ?></select>
        <input type="submit" value="View File" name="view">
        <input type="submit" value="Edit File" name="load">
        <input type="submit" value="Save Edits" name="save">
        <br>
        <input type="text" value="" name="newFileName">
        <input type="submit" value="Create File" name="create">
    </h3>

    <!-- This is start of an if/else that is supposed to control boxes and should default to create-->
    <?php if ($displayMode === 'view'): ?> 
        <textarea id="viewFile" name="viewFile" rows="5" cols="50"
        disabled><?php echo $currentBox; ?></textarea> 
    <?php elseif ($displayMode === 'edit'): ?>
        <input type="hidden" name="displayMode" value="edit">
        <textarea id="editFile" name="editFile" rows="5" cols="50"
        ><?php echo $currentBox; ?></textarea>
    <?php else: ?>
        <textarea id="createFile" name="createFile" rows="5" cols="50"
        ></textarea>
    <?php endif; ?>
    </form>
    <h2><a href="../view/tech.php">Home</a></h2>
    <form method='POST'>
        <input type="submit" value="Logout" name="logout">
    </form>
</body>
</html>