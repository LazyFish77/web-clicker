<!DOCTYPE html>
<html>

<head>
    <meta name="description" content="Allows Instructor to create/modify/delete questions">
    <meta name="keywords" content="Create, modify, delete, questions">
    <meta name="author" content="Tyler Fischer">
    <meta charset="UTF-8">
    <title>Web Clicker</title>
    <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. WEB_ROOT . "/Client/login-page.css"; ?>">
</head>

<body>
    <?php require_once("../General/instructor-nav.php") ?>
    <div id="flexbox">
        <div>
            <h1 class="loginheader">Activate Question</h1>
            <form id="mediumform" class="container" action="activate-question.php" method="POST">
                <div>
                    <label>Question id: </label>
                    <input id="activateinput1" type="number" name="questionid" />
                </div>
                <input type="submit" />
                <input type="reset" />
            </form>
        </div>
    </div>
    <?php require_once('../General/footer.php')?>
</body>

</html>