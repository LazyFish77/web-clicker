<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Takes user login info and returns homepage on successful login">
        <meta name="keywords" content="webclicker homepage">
        <meta name="author" content="Tyler Fischer">
        <title>Web Clicker</title>
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
            include_once('./footer.php')
        ?>
    </body>
</html>
