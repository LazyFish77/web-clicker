<?php
    require_once(realpath(dirname(__FILE__)) . "/../../API/Config.php");
    require_once(realpath(dirname(__FILE__)) . "/../../API/Database/Database.php");
    require_once(realpath(dirname(__FILE__)) . "/../../API/Controllers/QuestionController.php");
    $dbContext = new Database();
    $questionCtrl = new QuestionController($dbContext);
    $questions = $questionCtrl->GetActiveQuestions();
    $question = $questions[0];

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        // Redirect to next-question.html (user tried to navigate to this page directly)
        header('Location: next-question.php');
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Returns question if the instructor has enabled one;
            otherwise returns message saying could not get question">
        <meta name="keywords" content="show question">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. WEB_ROOT . "/Client/Styles/default-theme.css"; ?>">
        <title>Results</title>
    </head>
    <body>
        <?php
            require_once("../General/student-nav.php");
            $guess = "";
            $answer = $question->answer;
            if ($question->question_type == QuestionController::TYPE_CHECKBOX) {
                for ($i = 0; $i < 10; $i++) {
                    if (isset($_POST[chr($i+97)])) {
                        $guess = $guess . $_POST[chr($i+97)];
                    }
                }
            } else if ($question->question_type == QuestionController::TYPE_RADIO) {
                $guess = isset($_POST['a']) ? 'a' : 'b';
            } else if ($question->question_type == QuestionController::TYPE_SHORT_ANSWER) {
                $guess = $_POST['answer'];
            }
        
        ?>
        <div id="score">

        </div>
        <?php require_once('../General/footer.php')?>
    </body>
</html>
