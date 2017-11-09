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
        <div id="nav">
            <h1 id="navheader">Web Clicker
                <a href="../Instructor/create-question.html">Questions</a>
                <a href="../Instructor/activate-question.html">Activiate question</a>
                <a href="../Instructor/scores.php">Scores</a>
                <a href="../General/login-page.html">Log out</a>
            </h1>    
        </div> 
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
             echo "<a class='createquestionresponse' href='../instructor/activate-question-results.php'>Click to close question</a>";
             echo "<div id='countdowncontainer'><label>Timer:</label> <label id='countdown'></label></div>";
        } else {
             echo "<h1 class='createquestionresponse'><span id='fail'>Your question failed to activate! Question id is: $questionId </span></h1>";
             echo "<a class='createquestionresponse' href='../instructor/activate-question.html'>Click to return</a>";

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
    <?php 
        function activateQuestion() {
            return rand(0,1) == 1;
        }
    ?>
</html>