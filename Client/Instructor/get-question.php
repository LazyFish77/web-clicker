<?PHP
ini_set('display_errors', 1); // DEBUG
require_once(realpath(dirname(__FILE__)) . "/../../API/Database/Database.php");
require_once(realpath(dirname(__FILE__)) . "/../../API/Controllers/QuestionController.php");
require_once(realpath(dirname(__FILE__)) . "/../../Shared/Models/Question.php");

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['id'])) {
        $dbContext = new Database();
        $questionCtrl = new QuestionController($dbContext);

        $question = $questionCtrl->GetQuestion($_POST['id']);

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
        <title>Get Question</title>
    </head>
    <body>
        <?php require_once("../General/instructor-nav.php") ?>
        <?php 
            if(isset($question)) {
        ?>

        <div class="flexbox">
            <div>
                <h1 class="loginheader">Edit Question Id: <?PHP echo $question->id; ?></h1>
                <form id='tallform' class='container' action='../Instructor/submit-created-question.php' method='POST'>
                    <div>
                        <label>Section number: </label>
                        <input required id='createinput4' type='text' name='sectionnumber' step="0.01" value='<?PHP echo $question->section; ?>'/>             
                    </div>
                    <div>
                        <label class="question">Question statement: </label>
                        <label class="question"> Description of question:</label>
                        <textarea required rows='5' cols='40' name='questionstatement'><?PHP echo $question->question; ?></textarea>              
                        <textarea required rows='5' cols='40' name='descriptionofquestion'><?PHP echo $question->description; ?></textarea>
                    </div>
                    <div>
                        <label>Question type: </label>
                        <select required id='createselection1' name='questiontype' value="<?PHP echo $question->question_type; ?>">
                            <option disabled value> --- select an option --- </option>
                            <option <?PHP if($question->question_type == QuestionController::TYPE_SHORT_ANSWER) echo "selected"; ?> value='<?PHP echo QuestionController::TYPE_SHORT_ANSWER; ?>'>Text box</option>
                            <option <?PHP if($question->question_type == QuestionController::TYPE_RADIO) echo "selected"; ?>  value='<?PHP echo QuestionController::TYPE_RADIO; ?>'>Radio buttons</option>
                            <option <?PHP if($question->question_type == QuestionController::TYPE_CHECKBOX) echo "selected"; ?>  value='<?PHP echo QuestionController::TYPE_CHECKBOX; ?>'>Checkbox</option>
                        </select>
                    </div>
                    <div>
                        <label>Question answer:</label>
                        <input required id='createinput1' type='text' name='questionanswer' value='<?PHP echo $question->answer; ?>' />
                    </div>
                    <div>
                        <label>Number of points:</label>
                        <input required type='number' name='numberofpoints' value='<?PHP echo $question->points; ?>'/>
                    </div>
                    <div>
                        <label>Keywords:</label>
                        <input required id='createinput3' type='text' name='topickeywords' value='<?PHP echo $question->keywords; ?>' />
                    </div>
                    <div>
                        <label class="question">Options (if applicable, separate options with '||'): </label>
                        <label class="question">Automatic Grader: </label>
                        <textarea rows="5" cols="40" name="options"><?PHP echo $question->options; ?></textarea>            
                        <textarea required rows="5" cols="40" name="autograder"><?PHP echo $question->grader; ?></textarea>
                    </div>
                    <input type="hidden" name="id" value="<?PHP echo $question->id; ?>" />
                    <input type="hidden" name="update" value="update" />
                    <input required id='newpasswordsubmit' type='submit' />
                    <input required id='newpasswordclear' type='reset' />
                </form>
            </div>
        </div>
        <?PHP } else {
            echo "Unable to load question";
        } ?>
    <?php require_once('../General/footer.php')?>
</html>