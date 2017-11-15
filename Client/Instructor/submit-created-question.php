<?PHP
require_once($_SERVER['DOCUMENT_ROOT'] . "/web-clicker/API/Database/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/web-clicker/API/Controllers/QuestionController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/web-clicker/Shared/Models/Question.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dbContext = new Database();
    $questionCtrl = new QuestionController($dbContext);

    $question = new Question();
    $question->status = QUESTION_INACTIVE;

    $question->question_type = null;
    if($_POST['questiontype'] === 'textbox') {
        $question->question_type = QuestionController::TYPE_SHORT_ANSWER;
    } else if ($_POST['questiontype'] === '') {
        $question->question_type = QuestionController::TYPE_MULTI_CHOICE;
    }

    $question->question = $_POST['questionstatement'];
    $question->options = null;
    $question->points = $_POST['numberofpoints'];
    $question->description = $_POST['descriptionofquestion'];
    $question->grader = ""; // TODO, add grader form field
    $question->section = $_POST['sectionnumber'];
    $question->keywords = $_POST['topickeywords'];
    $question->start_timestamp = date('Y-m-d H:i:s');
    $question->end_timestamp = date('Y-m-d H:i:s');

    try {
        $result = $questionCtrl->AddQuestion($question);
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
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
        <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. "/web-clicker/Client/login-page.css"; ?>">
        <title>get Question</title>
    </head>
    <body>
        <?php require_once("../General/instructor-nav.php") ?>
        <?php 
            if(isset($result) && $result !== null) {
                // $randomNumber = rand(1,5000);
                // print_r($_POST);                
                echo "<h1 class='createquestionresponse'><span id='success'>Your question has been submitted! Question id is: $result->id</span></h1>";
                echo "<a class='createquestionresponse' href='create-question.php'>Click to return</a>";
            } else {
                // print_r($_POST);
                echo "<h1 class='createquestionresponse'><span id='fail'>Your question failed to submit</span></h1>";
                echo "<a class='createquestionresponse' href='create-question.php'>Click to return</a>";
            }
            // function addQuestionToDatabase(){
            //     return rand(0,1) === 1;
            // }
        ?>
        <?php require_once('../General/footer.php')?>
    </body>
</html>