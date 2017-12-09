<!DOCTYPE html>
<html>

<head>
    <meta name="description" content="Allows Instructor view student scores">
    <meta name="keywords" content="view, scores">
    <meta name="author" content="Tyler Fischer">
    <meta charset="UTF-8">
    <title>Web Clicker</title>
    <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. WEB_ROOT . "/Client/Styles/default-theme.css"; ?>">
</head>

<body>
    <?php require_once("../General/instructor-nav.php") ?>
    <h1 class="loginheader">Add Question</h1>
    <form class="container" action="../Instructor/submit-created-question.php" method="POST">
    </form>
    <?php require_once('../General/footer.php')?>
</body>

</html>