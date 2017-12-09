<?php
require_once(realpath(dirname(__FILE__)) . "/../General/Session.php");
require_once(realpath(dirname(__FILE__)) . "/../../API/Database/Database.php");
require_once(realpath(dirname(__FILE__)) . "/../../API/Controllers/UserController.php");
$session = new Session();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if(isset($_POST['username'])) {
        $dbContext = new Database();
        $userCtrl = new UserController($dbContext);

        $newPassword = $userCtrl->ResetStudentPassword($_POST['username']);
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
    <link rel="stylesheet" href="../login-page.css">
</head>

<body>

    <?php
        require_once(realpath(dirname(__FILE__)) . "/../General/" . ($_SESSION['user']->type == 1 ? "instructor" : "student") . "-nav.php");
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

    <h1 class="loginheader2">Reset Student's Password</h1>
    <form class="container" action="#" method="post">
        <div>
            <label class="inputkey">Student's Username:</label>
            <input type="text" name="username"  id="username" required />
        </div>
        <input type="submit" name="Submit" />
        <input type="reset"  value="Clear" />
        <?PHP
            if(isset($newPassword)) {
                ?>
                <div>
                    Temp Password for <?PHP echo $_POST['username']; ?>: <?PHP echo $newPassword; ?>
                </div>
                <?PHP
            }
        ?>
        <?php if (!empty($_SESSION['errors'])) { ?>
            <div class="errors">
                <?php echo $_SESSION['errors'];
                      unset($_SESSION['errors']); ?>
            </div>
        <?php } ?>        
    </form>
    <?php 
        require_once(realpath(dirname(__FILE__)) . "/../General/footer.php");
     ?>
</body>
</html>