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
        <title>Results</title>
    </head>
    <body>
        <?php
        require_once("../General/student-nav.php");
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
        <?php require_once('../General/footer.php')?>
    </body>
</html>
