<?PHP
// ini_set('display_errors', 1); // DEBUG
require_once(realpath(dirname(__FILE__)) . "/../General/Session.php");
// $session = new Session();

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Shows results from student answers">
        <meta name="keywords" content="activate, question, results">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. "/web-clicker/Client/login-page.css"; ?>">
        <title>Get Question</title>
        <script src="./student-charts.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </head>
    <body>        
        <?php require_once(realpath(dirname(__FILE__)) . "/../General/instructor-nav.php") ?>
        <input id="student" type="text" />
        <button onclick="searchByStudent()">search by student</button>
        <button onclick="showAllStudents()">show all student scores</button>
        <div id="chartbox">
        </div>
        <?php require_once(realpath(dirname(__FILE__)) . '/../General/footer.php')?>
    </body>
</html>