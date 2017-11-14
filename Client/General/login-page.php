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
    </form>
    <?php 
        require_once("../../Server/constants.php");
        //using the constant was giving me 404 errors, not sure why.
        require_once("../General/footer.php");
     ?>
</body>
</html>
