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
            $userName = $_POST["username"];
            $passWord = $_POST["password"];
            $accountType = $_POST["accounttype"];
            $email = $userName."@uwosh.edu";
            if(verifyUserBelongsToDatabase($userName, $passWord)) {
                
                if($accountType === "Student") {
                    readfile('../Student/next-question.html');
                } else {
                    readfile('../Instructor/create-question.html');
                }
            } else {
                echo"failed to log in";
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
    <?php 
        function verifyUserBelongsToDatabase($name, $password) {
            //this code checks the db 
            return true;
        }
    ?>
</html>