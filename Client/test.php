<?php
ini_set('display_errors', 1);
require_once("../API/Controllers/QuestionController.php");
require_once("../Shared/Models/Question.php");
try {

    $question = new Question();
    $question->id = 2;
    $question->status = 0;
    $question->question_type = 0;
    $question->question = "My Question";
    $question->options = "hey!";
    $question->points = 1;
    $question->description = "Foobar";
    $question->grader = "grader";
    $question->section = "1.1.1";
    $question->keywords = "Hello World";
    $question->start_timestamp = date('Y-m-d H:i:s');;
    $question->end_timestamp = date('Y-m-d H:i:s');;

    $controller = new QuestionController();
    $controller->AddQuestion($question);
} catch(Exception $e) {
    echo $e->getMessage();
}
?>