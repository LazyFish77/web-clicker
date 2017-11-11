<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Takes user login info and returns homepage on successful login">
        <meta name="keywords" content="verify login">
        <meta name="author" content="Tyler Fischer">
        <title>Lab 5</title>
    </head>
    <body>
        <?php
            require_once("../../Server/constants.php"); // Must always import this before using the database API
            require_once(SITE_ROOT . "/Server/database.php");
            $userName = $_POST["username"];
            $password = $_POST["password"];
            $accountType = $_POST["accounttype"] === "Student" ? STUDENT : INSTRUCTOR;
            $db = new Database();
            $user = $db->get_user($userName);
            $db->disconnect();
            if ($user && $user->verify_password($password) && $user->type === $accountType) {
                $user->log_in();
                if($accountType === STUDENT) {
                    readfile('../Student/next-question.html');
                } else {
                    readfile('../Instructor/create-question.html');
                }
            } else {
                echo"Login failed; your credentials were invalid.";
                return;
            }
        ?>
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
