<?PHP
// ini_set('display_errors', 1);
require_once(realpath(dirname(__FILE__)) . "/../../API/Database/Database.php");
require_once(realpath(dirname(__FILE__)) . "/../../API/Controllers/QuestionController.php");
require_once(realpath(dirname(__FILE__)) . "/../../Shared/Models/Question.php");

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['questionid'])) {

        $dbContext = new Database();
        $questionCtrl = new QuestionController($dbContext);

        $question = new Question();
        $question->id = $_POST['questionid'];

        try {
            $result = $questionCtrl->ActivateQuestion($question);
            // $result = $questionCtrl->DeactivateQuestion($question);
        } catch (Exception $e) {
            // TODO, remove before production
            echo $e->getMessage();
        } finally {
            $questionCtrl->Dispose();
        }
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Activates selected question for students to view">
        <meta name="keywords" content="activate, question">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. WEB_ROOT . "/Client/Styles/default-theme.css"; ?>">
        <script src="countdown.js"></script>
        <title>Web Clicker</title>
    </head>
    <body>
        <?php require_once("../General/instructor-nav.php") ?>
    <?php 
        if(isset($result) && $result > 0) {
             echo "<h1 class='createquestionresponse'><span id='success'>Your question has been activated! Question id is: $question->id </span></h1>";
             echo "<a class='createquestionresponse' href='../Instructor/activate-question-results.php'>Click to close question</a>";
             echo "<div id='countdowncontainer'><label>Timer:</label> <label id='countdown'></label></div>";
            //  $db = new Database();
            //  $questionController = new QuestionController($db);
            //  $question = $questionController->GetQuestion($_POST["questionid"]);
            //  print_r($question);
        } else {
             echo "<h1 class='createquestionresponse'><span id='fail'>Your question failed to activate! Question id is: $question->id </span></h1>";
             echo "<a class='createquestionresponse' href='../Instructor/display-question.php'>Click to return</a>";

        }
    ?>
    <?php require_once('../General/footer.php')?>
    </body>
    <?php 
        // function activateQuestion() {
        //     return rand(0,1) == 1;
        // }
    ?>
</html>