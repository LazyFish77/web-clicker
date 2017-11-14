<!DOCTYPE html>
<html>

<head>
    <meta name="description" content="Allows students to reset their passwords">
    <meta name="keywords" content="Password reset">
    <meta name="author" content="Tyler Fischer">
    <meta charset="UTF-8">
    <title>Web Clicker</title>
    <link rel="stylesheet" href="../General/login-page.css">
</head>

<body>
    <?php require_once("../General/student-nav.php");?>
    <h1 class="loginheader">Password reset</h1>
    <form class="container">
        <div>
            <label class="inputkey"> Old password:</label>
            <input id="oldpassword" type="password" />

        </div>
        <div>
            <label class="inputkey">New password: </label>
            <input id="newpassword" type="password" name="newpassword" />
        </div>
        <div>
            <label class="inputkey">Retype password:</label>
            <input type="password" name="retypenewpassword" />
        </div>
        <input id="newpasswordsubmit" type="button" value="submit button" />
        <input id="newpasswordclear" type="reset" value="reset" />
    </form>
    <?php require_once('../General/footer.php')?>
</body>

</html>