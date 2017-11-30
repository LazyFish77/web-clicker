<?PHP
require_once(realpath(dirname(__FILE__)) . "/../../API/Database/Database.php");
require_once(realpath(dirname(__FILE__)) . "/../../API/Controllers/QuestionController.php");
require_once(realpath(dirname(__FILE__)) . "/../../Shared/Models/Question.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    date_default_timezone_set("America/Chicago");
    $dbContext = new Database();
    $questionCtrl = new QuestionController($dbContext);

    $question = new Question();
    $question->status = QUESTION_INACTIVE;
    $question->question_type = $_POST['questiontype'];
    $question->question = $_POST['questionstatement'];
    $question->options = $_POST['options'];
    $question->points = $_POST['numberofpoints'];
    $question->description = $_POST['descriptionofquestion'];
    $question->grader = $_POST['autograder'];
    $question->section = $_POST['sectionnumber'];
    $question->keywords = $_POST['topickeywords'];
    $question->start_timestamp = date('Y-m-d H:i:s');
    $question->end_timestamp = date('Y-m-d H:i:s');

    try {
        $result = $questionCtrl->AddQuestion($question);
        $questionCtrl->Dispose();
    } catch (Exception $e) {
        echo $e->getMessage();
        $questionCtrl->Dispose();
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Post question to database; informs user on success">
        <meta name="keywords" content="post, questions">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. WEB_ROOT . "/Client/login-page.css"; ?>">
        <title>Web Clicker</title>
    </head>
    <body>
        <?php require_once("../General/instructor-nav.php") ?>
        <?php 
            if(isset($result) && $result !== null) {                
                echo "<h1 class='createquestionresponse'><span id='success'>Your question has been submitted! Question id is: $result->id</span></h1>";
                echo "<a class='createquestionresponse' href='create-question.php'>Click to return</a>";
            } else {
                echo "<h1 class='createquestionresponse'><span id='fail'>Your question failed to submit</span></h1>";
                echo "<a class='createquestionresponse' href='create-question.php'>Click to return</a>";
            }
        ?>
        <?php require_once('../General/footer.php')?>
    </body>
</html>