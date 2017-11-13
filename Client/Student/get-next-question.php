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
        <link rel="stylesheet" href="question.css">
        <title>Get Question</title>
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
            require_once("../../Server/constants.php");
            require_once(SITE_ROOT . "/Server/database.php");
            $db = new Database();
            $question = $db->get_active_question();
            $db->disconnect();
            if ($question) {
                print('<form id="questionform" action="process-answer.php" method="post">');
                    print('<h1>Question</h1>');
                    print('<pre>' . $question->prompt . '</pre>');
                    print('<section id="options"');
                    if ($question->type === MULTI_CHOICE) {
                        $i = 97; // ASCII code for "a", so each input element has a unique name
                        foreach ($question->options as $option) {
                            print('<label><input type="checkbox" name="' . chr($i++) .'" />' . $option . '</label><br />');
                        }
                    } else if ($question->type === SHORT_ANSWER) {
                        print('<label>Type your answer:<input type="text" name="answer" /></label>');
                    }
                    print('</section>');
                    print('<input type="submit" value="Submit Answer" />');
                print('</form>');
            } else {
                echo "<div id='noquestion'>There is no question to view
                    <a id='returnlink' href='../Student/next-question.html'> click to return</a> </div>";
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
