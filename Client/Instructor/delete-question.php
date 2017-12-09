<?PHP
require_once(realpath(dirname(__FILE__)) . "/../../API/Database/Database.php");
require_once(realpath(dirname(__FILE__)) . "/../../API/Controllers/QuestionController.php");
require_once(realpath(dirname(__FILE__)) . "/../../Shared/Models/Question.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dbContext = new Database();
    $questionCtrl = new QuestionController($dbContext);
    // $question = new Question();
    // $question->id = $_POST['id'];

    try {        
        $result = $questionCtrl->DeleteQuestion($_POST['id']);
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
        <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. WEB_ROOT . "/Client/Styles/default-theme.css"; ?>">
        <title>get Question</title>
    </head>
    <body>
        <?php require_once("../General/instructor-nav.php") ?>
        <?php 
            if(isset($result)) {              
                echo "<h1 class='createquestionresponse'><span id='success'>Question id: $result has been deleted! </span></h1>";
                echo "<a class='createquestionresponse' href='create-question.php'>Click to return</a>";
            } else {
                echo "<h1 class='createquestionresponse'><span id='fail'>Your question failed to delete</span></h1>";
                echo "<a class='createquestionresponse' href='create-question.php'>Click to return</a>";
            }
        ?>
        <?php require_once('../General/footer.php')?>
    </body>
</html>