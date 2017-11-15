<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Post question to database; informs user on success">
        <meta name="keywords" content="post, questions">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="../General/login-page.css">
        <title>get Question</title>
    </head>
    <body>
        <?php require_once("../General/instructor-nav.php") ?>
        <?php 
            $questionStatement ="Some random question about stuff";
            $status ="good";
            $descriptionOfQuestion="Some random description of a question about stuff";
            $numberOfPoints="3";
            $questionTopic="PHP";
            $questionType="textbox";
            $topicKeywords = "keyword, php, bad, language";
            $averagePointsEarnedByClass= -5;
            $questionAnswer ="C";
            $sectionNumber =3.3;
            $random = rand(1,500);
        function getValuesFromDatabase(){

        }
        echo "
        <h1 id='loginheader'>Edit Question</h1>
        <form id='tallform' class='container' action='../Instructor/submit-created-question.php' method='POST'>
        <div>
            <label>Question statement: </label>
            <textarea required rows='5' cols='40' name='questionstatement'>$questionStatement</textarea>
        </div>
                <div>
                    <label> Description of question:</label>
                    <br />
                    <textarea required rows='5' cols='40' name='descriptionofquestion'>$descriptionOfQuestion</textarea>
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
                    <input required type='number' name='numberofpoints' value='$numberOfPoints'/>
                </div>
                <div>
                    <label>Keywords:</label>
                    <input required id='createinput3' type='text' name='topickeywords' value='$topicKeywords' />
                </div>
                <div>
                    <label>Section number: </label>
                    <input required id='createinput4' type='number' name='sectionnumber' value='$sectionNumber'/>
                </div>
                <div>
                    <label>Id number: $random </label>
                </div>
                <input required id='newpasswordsubmit' type='submit' />
                <input required id='newpasswordclear' type='reset' />
            </form>
            ";
        ?>
    <?php require_once('../General/footer.php')?>
</html>