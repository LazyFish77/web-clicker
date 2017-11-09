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
        <div id="nav">
            <h1 id="navheader">
                <label>Web Clicker</label>
                <a href="../Instructor/create-question.html">Questions</a>
                <a href="../Instructor/activate-question.html">Activiate question</a>
                <a href="../Instructor/scores.php">Scores</a>
                <a href="../General/login-page.html">Log out</a>
            </h1>
        </div>
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
    <footer id="footer">
        <div>
            <a href="http://jigsaw.w3.org/css-validator/check/referer">
                <img class="footerimage" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!">
            </a>
        </div>
        <div>
            <img class="footerimage" src="http://webdev.cs.uwosh.edu/WebCLICKER/public/images/html5_logo.png" alt="\'Valid\' HTML5">
        </div>
        <div>
            <span id="footertext">2017 - Univ. of Tyler Fischer</span>
        </div>
    </footer>
</html>