<?php
    // clear out the 'flag' each turn around
    if(isset($invalidLogin)) {
        unset($invalidLogin);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once("../API/Database/Database.php");
        require_once("../API/Controllers/UserController.php");
        require_once("../Shared/Models/User.php");
        // init resources
        $dbContext = new Database();
        $userCtrl = new UserController($dbContext);

        $user = new User();
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        // $user->type = $_POST['accounttype'];

        $isValid = $userCtrl->ValidateUser($user);

        if($isValid !== null) {
            // echo $_SERVER['SERVER_NAME'] . "  " . $_SERVER['REQUEST_URI'];
            // WARNING!!! This is a quick-and-dirty HTML redirect.
            // We either need to come up with a better way of passing in the absolute URL
            // Or we need to come up with a different solution all together
            switch($isValid->type) {
                case 0: //instructor ??
                    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/webclicker/web-clicker/Client/Instructor/scores.html");
                    die();

                case 1: // student ??
                    header("Location: http://" . $_SERVER['SERVER_NAME'] . "/webclicker/web-clicker/Client/Student/next-question.html");
                    die();
            }
        }
        else {
            $invalidLogin = true;
        }
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
    <link rel="stylesheet" href="./login-page.css">
</head>

<body>
    <?php 
        // TODO: spiffy this part up
        if(isset($invalidLogin)) {
            echo "Invalid login attempt";
        }
    ?>
    <h1 class="loginheader">Login</h1>
    <form class="container" action="./login.php" method="post">
        <div>
            <label id="instructorlabel"> Instructor</label>
            <input type="radio" name="accounttype" value="0" required/>

            <label>Student</label>
            <input type="radio" name="accounttype" value="1" required/>
        </div>
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
    </form>
    <footer id="footer">
        <div>
            <a href="http://jigsaw.w3.org/css-validator/check/referer">
                <img class="footerimage" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!">
            </a>
        </div>
        <div>
            <img class="footerimage" src="http://webdev.cs.uwosh.edu/WebCLICKER/public/images/html5_logo.png" alt="\'Valid\' HTML5">
        </div>
        <div>
            <span id="footertext">2017 - Univ. of Tyler Fischer</span>
        </div>
    </footer>
</body>
</html>
