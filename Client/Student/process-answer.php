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
    $finalAnswer = new Answer();
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
        <meta name="description" content="Displays student's score on the current question">
        <meta name="keywords" content="show results">
        <meta name="author" content="Tyler Fischer, Cory Lewis, Walter Woods">
        <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. WEB_ROOT . "/Client/Styles/default-theme.css"; ?>">
        <link rel="stylesheet" href="question.css">
        <title>Results</title>
    </head>
    <body>
        <?php
            require_once("../General/student-nav.php");
            $guess = "";
            $answer = $question->answer;
            if ($question->question_type == QuestionController::TYPE_CHECKBOX) {
                foreach ($_POST['multiple'] as $ans) {
                    $guess = $guess . $ans;                    
                }
            } else if ($question->question_type == QuestionController::TYPE_RADIO) {
                $guess = $_POST['single'];
            } else if ($question->question_type == QuestionController::TYPE_SHORT_ANSWER) {
                $guess = $_POST['short'];
            }
            $score = eval($question->grader);

            $finalAnswer->question_id = $question->id;
            $finalAnswer->student_id = $_SESSION['user']->username;
            $finalAnswer->answer = $guess;
            $finalAnswer->points_earned = $score;            

            try {        
                $answerCtrl->AddAnswer($finalAnswer);
                $answerCtrl->Dispose();
                $questionCtrl->Dispose();
            } catch (Exception $e) {
                echo $e->getMessage();
                $answerCtrl->Dispose();
                $questionCtrl->Dispose();
            }
        ?>
        <div>
            <form id="questionform">
                <?php
                    echo "<h1>Question $question->id</h1>";
                    echo "<p class=\"score\">Your Answer: $guess</p>";
                    echo "<p class=\"score\">Correct Answer: $answer</p>";
                    echo "<p class=\"score\">Your Score: $score</p>";
                    echo "<pre>$question->question</pre>";
                    echo "<section id=\"options\">";
                    if ($question->question_type == QuestionController::TYPE_CHECKBOX) {
                        $i = 97; // ASCII code for "a", so each input element has a unique name
                        $options = preg_split("/\|\|/", $question->options);
                        echo "<ol>";
                        foreach ($options as $option) {
                            $option = trim($option);
                            echo  "<li><label><input type=\"checkbox\" name=\"multiple[]\" value=\"". chr($i++) . "\"/>" . $option . "</label></li>";
                        }
                        echo "</ol>";
                    } else if ($question->question_type == QuestionController::TYPE_RADIO) {
                        $i = 97; // ASCII code for "a", so each input element has a unique name
                        $options = preg_split("/\|\|/", $question->options);
                        echo "<ol>";
                        foreach ($options as $option) {
                            $option = trim($option);
                            echo  "<li><label><input type=\"radio\" name=\"single\" value=\"". chr($i++) . "\"/>" . $option . "</label></li>";
                        }
                        echo "</ol>";
                    } else if ($question->question_type == QuestionController::TYPE_SHORT_ANSWER) {
                        echo "<label>Type your answer: <input type=\"text\" name=\"short\" /></label>";
                    } 
                    echo "</section>";
                ?>
            </form>
        </div>
        <?php require_once('../General/footer.php')?>
    </body>
</html>
