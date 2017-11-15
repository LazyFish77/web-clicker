<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Redirect to next-question.html (user tried to navigate to this page directly)
    header('Location: next-question.php');
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
        <?php
            require_once("../General/student-nav.php");
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
        <?php require_once('../General/footer.php')?>
    </body>
</html>
