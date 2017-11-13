<!DOCTYPE html>
<?php session_start(); ?>
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
    <h1 class="loginheader">Login</h1>
    <form class="container" action="./verify-password.php" method="post">
        <div>
            <label id="instructorlabel"> Instructor</label>
            <input type="radio" name="accounttype" value="Instructor" required/>

            <label>Student</label>
            <input type="radio" name="accounttype" value="Student" required/>
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
        <?php if (!empty($_SESSION['errors'])) { ?>
            <div class="errors">
                <?php echo $_SESSION['errors'];
                      unset($_SESSION['errors']); ?>
            </div>
        <?php } ?>        
    </form>
    <footer id="footer">
        <div>
            <a href="http://jigsaw.w3.org/css-validator/check/referer">
                <img class="footerimage" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!">
            </a>
        </div>
        <div>
            <a href="https://validator.w3.org/check/referer">
                <img class="footerimage" src="http://webdev.cs.uwosh.edu/WebCLICKER/public/images/html5_logo.png" alt="\'Valid\' HTML5">
            </a>
        </div>
        <div>
            <span id="footertext">2017 - Univ. of Tyler Fischer</span>
        </div>
    </footer>
</body>
</html>
