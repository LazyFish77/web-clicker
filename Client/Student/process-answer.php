<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Redirect to next-question.html (user tried to navigate to this page directly)
    header('Location: next-question.html');
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Returns question if the instructor has enabled one;
            otherwise returns message saying could not get question">
        <meta name="keywords" content="show question">
        <meta name="author" content="Tyler Fischer">
        <link rel="stylesheet" href="../General/login-page.css">
        <title>Results</title>
    </head>
    <body>
        <div id="nav">
            <h1 id="navheader">Web Clicker
                <a href="../Student/next-question.html">Next question</a>
                <a href="../Student/view-old-question.html">Review</a>
                <a href="./reset-password.html">Reset password</a>
                <a href="../General/login-page.html">Log out</a>
            </h1>
        </div>
        <?php
        require_once("../../Server/constants.php");
        require_once(SITE_ROOT . "/Server/database.php");
        $db = new Database();
        $question = $db->get_active_question();
        $db->disconnect();
        if ($question->type === MULTI_CHOICE) {
            $answer = [];
            for ($i = 0; $i < 10; $i++) {
                if (isset($_POST[chr($i+97)])) {
                    array_push($answer, $_POST[chr($i+97)]);
                }
            }
        }
        $answer = implode('', $answer); // At this point, $answer is in this format (for example): "acd"
        // TODO: Get the student's ID from the session & load the Student object from the DB
        // (Assign this Student object to a variable like $student)
        // Then, call $student->answer_question($question, $answer)
        ?>
        <div id="score">

        </div>
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
