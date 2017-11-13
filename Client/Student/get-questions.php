<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Returns a query of questions">
        <meta name="keywords" content="view questions">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="../General/login-page.css">
        <title>get Question</title>
    </head>
    <body>
        <div id="nav">
            <h1 id="navheader">Web Clicker
                <a href="../Student/next-question.html">Next question</a>
                <a href="../Student/view-old-question.html">Review</a>
                <a href="./reset-password.html">Reset password</a>
                <a href="../General/login-page.php">Log out</a>
            </h1>    
        </div> 
        <?php 
            $status ="good";
            $questionStatement ="Some random question about stuff";
            $descriptionOfQuestion;
            $numberOfPoints="3";
            $questionTopic="PHP";
            $questionType;
            $topicKeywords = "keyword, php, bad, language";
            $averagePointsEarnedByClass= -5;
            $questionAnswer ="C";
            $sectionNumber;
            function getQuestionFromDatabase() {
            }
            for($i=1; $i < 3; $i++) {
                echo"<div id='questionbeingviewed'>";   
                echo"<h1 id='questionresponse'>The question was: $questionStatement</h1>";
                echo"<label class='questionresponselabel'>This is sample question $i</label>";
                echo"<label class='questionresponselabel'>Question topic: $questionTopic</label>";
                echo"<label class='questionresponselabel'>Topic keywords: $topicKeywords</label>";
                echo"<label class='questionresponselabel'>Average points earned by class: $averagePointsEarnedByClass</label>";
                echo"<label class='questionresponselabel'>TotalPoints: $numberOfPoints</label>";
                echo"<label class='questionresponselabel'>answer: $questionAnswer</label>";
                echo "</div>";
            }
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
    </body>
</html>