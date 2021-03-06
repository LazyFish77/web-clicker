<?php 
    require_once(realpath(dirname(__FILE__)) . "/../General/Session.php");
    $session = new Session();
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="description" content="Allows students to view the question the instructor has provided.">
    <meta name="keywords" content="next question">
    <meta name="author" content="Tyler Fischer">
    <meta charset="UTF-8">
    <title>Web Clicker</title>
    <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. WEB_ROOT . "/Client/Styles/default-theme.css"; ?>">
</head>

<body>
    <?php require_once("../General/student-nav.php");?>
    <h1 class="loginheader2"> Show question</h1>
    <form class="container" action="../Student/get-next-question.php" method="POST">
        <p id="showquestionp">
            If your instructor has activated a question you may view the question.
        </p>
        <input id="showquestion" type="submit" name="showquestion" value="Show question" />
    </form>
    <?php require_once(realpath(dirname(__FILE__)) . '/../General/footer.php'); ?>
</body>

</html>