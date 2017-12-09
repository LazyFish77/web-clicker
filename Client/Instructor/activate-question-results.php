<?php 
    require_once(realpath(dirname(__FILE__)) . "/../General/Session.php");
    require_once(realpath(dirname(__FILE__)) . "/../../API/Config.php");
    $session = new Session();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Shows results from student answers">
        <meta name="keywords" content="activate, question, results">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. WEB_ROOT . "/Client/Styles/default-theme.css"; ?>">
        <title>Web Clicker</title>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </head>
    <body>        
        <?php require_once("../General/instructor-nav.php") ?>
        <!-- <div id="chartContainer"></div> -->
        
<?php 
    require_once("../../API/Controllers/QuestionController.php");
    require_once("../../API/Controllers/AnswerController.php");
    require_once("../../API/Database/Database.php");
    $db = new Database();
    $questionController = new QuestionController($db);
    $answerController = new AnswerController($db);
    $question = $questionController->GetActiveQuestions()[0];
    $getStudentResponses = $answerController->GetAllAnswersFromQuestion($question->id);
    $getStudentResponses = json_encode($getStudentResponses);
    $question = json_encode($question);
    $questionController->DeactivateAllQuestions();
?>
    <div id="studentstats">
        <div>
            <?php echo"$getStudentResponses"?>
        </div>
        <div>
            <?php echo"$question"?>            
        </div>
    </div>
    <div id="studentresponsechart"></div>
        <?php require_once('../General/footer.php')?>
    </body>
    <script src="./chart.js"></script>
</html>