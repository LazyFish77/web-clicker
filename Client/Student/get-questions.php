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
        <?php 
            require_once("../General/student-nav.php");
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
       <?php require_once('../General/footer.php')?>
    </body>
</html>