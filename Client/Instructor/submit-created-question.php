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
            <h1 id="navheader">Web Clicker
                <a href="../Instructor/create-question.html">Questions</a>
                <a href="../Instructor/activate-question.html">Activiate question</a>
                <a href="../Instructor/scores.php">Scores</a>
                <a href="../General/login-page.html">Log out</a>
            </h1>    
        </div> 
        <?php 
            if(addQuestionToDatabase()) {
                $randomNumber = rand(1,5000);
                print_r($_POST);                
                echo "<h1 class='createquestionresponse'><span id='success'>Your question has been submitted! Question id is: $randomNumber</span></h1>";
                echo "<a class='createquestionresponse' href='../instructor/create-question.html'>Click to return</a>";
            } else {
                print_r($_POST);
                echo "<h1 class='createquestionresponse'><span id='fail'>Your question failed to submit</span></h1>";
                echo "<a class='createquestionresponse' href='../instructor/create-question.html'>Click to return</a>";
            }
            function addQuestionToDatabase(){
                return rand(0,1) === 1;
            }
        ?>
        <footer id="footer">
            <div>
                <a href="http://jigsaw.w3.org/css-validator/check/referer">
                    <img class="footerimage" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!">
                </a>
            </div>
            <div>
                <a href="https://validator.w3.org/check/referer">
                    <img class="footerimage" src="http://webdev.cs.uwosh.edu/WebCLICKER/public/images/html5_logo.png" alt="\'Valid\' HTML5">
                </a>
            </div>
            <div>
                <span id="footertext">2017 - Univ. of Tyler Fischer</span>
            </div>
        </footer>
    </body>
</html>