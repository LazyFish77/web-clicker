<?php
ini_set('display_errors', 1); // DEBUG
require_once(realpath(dirname(__FILE__)) . "/Session.php");
require_once(realpath(dirname(__FILE__)) . "/../../API/Database/Database.php");
require_once(realpath(dirname(__FILE__)) . "/../../API/Controllers/UserController.php");
$session = new Session();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $session->LogIn($_POST['username'], $_POST['password']);
    if($_POST['newpassword'] !== $_POST['confirmpassword']) {
        $session->SetMessage("new passwords do not match");
    }
    
    $dbContext = new Database();
    $userCtrl = new UserController($dbContext);

    $result = $userCtrl->ChangePassword($session->GetUser(), $_POST['currentpassword'], $_POST['newpassword']);
    if($result !== null) {
        $session->SetMessage("Password change was successful");
    } else {
        $session->SetMessage("Password change failed");
    }
} else {
    $session->ClearMessage();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="description" content="Password change">
    <meta name="keywords" content="password change">
    <meta name="author" content="Tyler Fischer">
    <meta charset="UTF-8">
    <title>Web Clicker</title>
    <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. WEB_ROOT . "/Client/Styles/default-theme.css"; ?>">
</head>

<body>

    <?php
        require_once(realpath(dirname(__FILE__)) . "/" . ($_SESSION['user']->type == 1 ? "instructor" : "student") . "-nav.php");
        if(isset($_SESSION["message"])) {
    ?>
        <div class="errors">
    <?PHP
            echo $session->GetMessage();
    ?>
        </div>
    <?PHP
        }        
    ?>

    <h1 class="loginheader2">Change Password</h1>
    <form class="container" action="change-password.php" method="post">
        <div>
            <label class="inputkey">Current Password:</label>
            <input type="password" name="currentpassword"  id="currentpassword" required />
        </div>
        <div>
            <label class="inputkey">New Password:</label>
            <input id="newpassword" type="password" name="newpassword" required />
        </div>
        <div>
            <label class="inputkey">Confirm Password:</label>
            <input id="confirmpassword" type="password" name="confirmpassword" required />
        </div>
        <input type="submit" name="Submit" />
        <input type="reset"  value="Clear" />        
        <?php if (!empty($_SESSION['errors'])) { ?>
            <div class="errors">
                <?php echo $_SESSION['errors'];
                      unset($_SESSION['errors']); ?>
            </div>
        <?php } ?>        
    </form>
    <?php 
        require_once(realpath(dirname(__FILE__)) . "/footer.php");
     ?>
</body>
</html>