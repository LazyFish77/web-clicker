<?php
    require_once(realpath(dirname(__FILE__)) . "/../General/Session.php");
    require_once(realpath(dirname(__FILE__)) . "/../../API/Config.php");
    require_once(realpath(dirname(__FILE__)) . "/../../API/Database/Database.php");
    require_once(realpath(dirname(__FILE__)) . "/../../API/Controllers/QuestionController.php");
    require_once(realpath(dirname(__FILE__)) . "/../../API/Controllers/AnswerController.php");
    require_once(realpath(dirname(__FILE__)) . "/../../Shared/Models/Answer.php");
    $session = new Session();
    $dbContext = new Database();
    $questionCtrl = new QuestionController($dbContext);
    $answerCtrl = new AnswerController($dbContext);
    $answers = $answerCtrl->GetAllAnswersFromStudent($_SESSION['user']->username, $_GET);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Returns a query of questions">
        <meta name="keywords" content="view questions">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. WEB_ROOT . "/Client/Styles/default-theme.css"; ?>">
        <title>Get Question</title>
    </head>
    <body>        
        <?php 
            require_once("../General/student-nav.php");
            echo "<div id=\"wrapper\">";
            if(count($answers) === 0) {
                echo"<div id='questionbeingviewed'>";
                echo"<h1 id='questionresponse'>No Question match your search</h1>";   
                echo"<div id='notfound'>";
                echo"<a 'href='../Student/view-old-question.php'>Return to search</a>";
                echo"</div>";
                echo "</div>";
            } else {
                    print_r($answers);
                foreach($answers as $answer) {
                    $question = $questionCtrl->GetQuestion($answer['question_id']);
                    echo"<div id='questionbeingviewed'>";
                    echo"<h1 id='questionresponse'>Question Id: " . $answer['question_id'] . "</h1>";   
                    echo"<label class='questionresponselabel'>Question description: $question->description</label>";                
                    echo"<label class='questionresponselabel'>Your answer: " . $answer['answer'] . "</label>";
                    echo"<label class='questionresponselabel'>Actual answer: $question->answer</label>";
                    echo"<label class='questionresponselabel'>Points earned: " . $answer['points_earned'] . "</label>";
                    echo"<label class='questionresponselabel'>Possible points: $question->points</label>";               
                    echo"<label class='questionresponselabel'>Topic keywords: $question->keywords</label>";                
                    echo "</div>";
                }
            }
            echo "</div>";
        ?>        
       <?php require_once(realpath(dirname(__FILE__)) . '/../General/footer.php'); ?>
    </body>
</html>