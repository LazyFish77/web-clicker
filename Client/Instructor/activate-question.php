<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Activates selected question for students to view">
        <meta name="keywords" content="activate, question">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="../General/login-page.css">
        <script src="countdown.js"></script>
        <title>get Question</title>
    </head>
    <body>
        <?php require_once("../General/instructor-nav.php") ?>
    <?php 
    $questionId = $_POST['questionid'];
    $questionName = $_POST['questionname'];
    if (!$questionId) {
        $questionId = "not set";
    }
    if(!$questionName){
        $questionName = "not set";
    }

        if(activateQuestion()) {
             echo "<h1 class='createquestionresponse'><span id='success'>Your question has been activated! Question id is: $questionId </span></h1>";
             echo "<a class='createquestionresponse' href='../Instructor/activate-question-results.php'>Click to close question</a>";
             echo "<div id='countdowncontainer'><label>Timer:</label> <label id='countdown'></label></div>";
        } else {
             echo "<h1 class='createquestionresponse'><span id='fail'>Your question failed to activate! Question id is: $questionId </span></h1>";
             echo "<a class='createquestionresponse' href='../Instructor/activate-question.html'>Click to return</a>";

        }
    ?>
    <?php require_once('../General/footer.php')?>
    </body>
    <?php 
        function activateQuestion() {
            return rand(0,1) == 1;
        }
    ?>
</html>