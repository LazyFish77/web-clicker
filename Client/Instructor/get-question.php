<?PHP
// ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'] . "/web-clicker/API/Database/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/web-clicker/API/Controllers/QuestionController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/web-clicker/Shared/Models/Question.php");

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
        <link rel="stylesheet" href="http://<?PHP echo $_SERVER['SERVER_NAME']. "/web-clicker/Client/login-page.css"; ?>">
        <title>Get Question</title>
    </head>
    <body>
        <?php require_once("../General/instructor-nav.php") ?>
        <?php 
        //     $questionStatement ="Some random question about stuff";
        //     $status ="good";
        //     $descriptionOfQuestion="Some random description of a question about stuff";
        //     $numberOfPoints="3";
        //     $questionTopic="PHP";
        //     $questionType="textbox";
        //     $topicKeywords = "keyword, php, bad, language";
        //     $averagePointsEarnedByClass= -5;
        //     $questionAnswer ="C";
        //     $sectionNumber =3.3;
        //     $random = rand(1,500);
        // function getValuesFromDatabase(){

        // }
        if(isset($question)) {
        ?>

        <h1 id='loginheader'>Edit Question</h1>
        <form id='tallform' class='container' action='../Instructor/submit-created-question.php' method='POST'>
        <div>
            <label>Question statement: </label>
            <textarea required rows='5' cols='40' name='questionstatement'><?PHP echo $question->question; ?></textarea>
        </div>
                <div>
                    <label> Description of question:</label>
                    <br />
                    <textarea required rows='5' cols='40' name='descriptionofquestion'><?PHP echo $question->description; ?></textarea>
                </div>
                <div>
                    <label>Question type: </label>
                    <select required id='createselection1' name='questiontype' value='$questionType'>
                        <option disabled selected value> --- select an option --- </option>
                        <option value='textbox'>Text box</option>
                        <option value='select'>Select</option>
                        <option value='tf'>True or false</option>
                        <option value='radiobuttons'>Radio buttons</option>
                        <option value='checkbox'>Checkbox</option>
                    </select>
                </div>
                <div>
                    <label>Question answer:</label>
                    <input required id='createinput1' type='text' name='questionanswer' value='$questionAnswer' />
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
                    <label>Section number: </label>
                    <input required id='createinput4' type='text' name='sectionnumber' value='<?PHP echo $question->section; ?>'/>
                </div>
                <div>
                    <label>Id number: <?PHP echo $question->id; ?> </label>
                </div>
                <input required id='newpasswordsubmit' type='submit' />
                <input required id='newpasswordclear' type='reset' />
            </form>
        <?PHP } else { ?>
            Unable to load question
        <?PHP } ?>
    <?php require_once('../General/footer.php')?>
</html>