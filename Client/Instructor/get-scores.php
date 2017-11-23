<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/web-clicker/API/Controllers/AnswerController.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/web-clicker/API/Database/Database.php");
    $db = new Database();
    $db->connect();
    //code for single get
    $answerController = new AnswerController($db);
    // $answers = $answerController->GetAllAnswersFromStudent("bob");
    // $answers = json_encode($answers);
    if($_SERVER['HTTP_SEARCH_BY_STUDENT'] !== "false") {
        $response = $answerController->GetAllAnswersFromStudent($_SERVER['HTTP_SEARCH_BY_STUDENT']);
        $response = json_encode($response);
        echo "$response";

    } else {
        $response = $answerController->GetAllAnswers();
        $response = json_encode($response);
        echo "$response";
    }
    // echo "$val";
    // echo""
    // echo"$answers";

?>