<?php
ini_set('display_errors', 1); // DEBUG
require_once(realpath(dirname(__FILE__)). "/General/Session.php");
$session = new Session();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $session->LogIn($_POST['username'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="description" content="Allows students to login into web clicker application">
    <meta name="keywords" content="Login">
    <meta name="author" content="Tyler Fischer">
    <meta charset="UTF-8">
    <title>Web Clicker</title>
    <link rel="stylesheet" href="login-page.css">
</head>

<body>

    <?php
        //echo "<pre>";
        //echo realpath( dirname( __FILE__ ));
        //print_r($_SERVER);
        //echo "</pre>";
        if(isset($_SESSION['message'])) {
            // TODO: make this pretty
            echo $_SESSION['message'];
        }
    ?>
    <h1 class="loginheader">Login</h1>
    <form class="container" action="login.php" method="post">
        <div>
            <label class="inputkey">User Name:</label>
            <input type="text" name="username" required />
        </div>
        <div>
            <label class="inputkey"> Password:</label>
            <input id="passwordinput" type="password" name="password" />
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
        require_once(realpath(dirname(__FILE__)) . "/General/footer.php");
     ?>
</body>
</html>