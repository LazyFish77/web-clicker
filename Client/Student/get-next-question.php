<?php
    require_once(realpath(dirname(__FILE__)) . "/../../API/Config.php");
    require_once(realpath(dirname(__FILE__)) . "/../../API/Database/Database.php");
    require_once(realpath(dirname(__FILE__)) . "/../../API/Controllers/QuestionController.php");
    $dbContext = new Database();
    $questionCtrl = new QuestionController($dbContext);

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
        <link rel="stylesheet" href="question.css">
        <title>Get Question</title>
    </head>
    <body>
        <div>
        <?php
            require_once("../General/student-nav.php");             
            $questions = $questionCtrl->GetActiveQuestions();
            $questionCtrl->Dispose();
            $question = $questions[0];

            if ($question) {
                echo "<form id=\"questionform\" action=\"./process-answer.php\" method=\"post\">";
                    echo "<h1>Question $question->id</h1>";
                    echo "<pre>$question->question</pre>";
                    echo "<section id=\"options\">";
                    if ($question->question_type == QuestionController::TYPE_CHECKBOX) {
                        $i = 97; // ASCII code for "a", so each input element has a unique name
                        $options = preg_split("/\|\|/", $question->options);
                        echo "<ol>";
                        foreach ($options as $option) {
                            $option = trim($option);
                            echo  "<li><label><input type=\"checkbox\" name=\"". chr($i) . "\" value=\"". chr($i) . "\"/>" . $option . "</label></li>";
                        }
                        echo "</ol>";
                    } else if ($question->question_type == QuestionController::TYPE_RADIO) {
                        echo "<ol>";
                            echo "<li><label><input type=\"radio\" name=\"a\" value=\"a\" />True</label></li>";
                            echo "<li><label><input type=\"radio\" name=\"b\" value=\"b\" />False</label></li>";
                        echo "</ol>";
                    } else if ($question->question_type == QuestionController::TYPE_SHORT_ANSWER) {
                        echo "<label>Type your answer: <input type=\"text\" name=\"answer\" /></label>";
                    } 
                    echo "</section>";
                    echo "<input type=\"submit\" value=\"Submit Answer\" />";
                echo "</form>";
            } else {
                echo "<div id='noquestion'>There is no question to view
                    <a id='returnlink' href='../Student/next-question.php'> click to return</a> </div>";
            }
        ?>
        </div>
        <div>
            <?php require_once('../General/footer.php')?>
        </div>
    </body>
</html>
