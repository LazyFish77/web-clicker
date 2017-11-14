<?php
ini_set('display_errors', 1);
require_once("../API/Controllers/QuestionController.php");
require_once("../API/Controllers/AnswerController.php");
require_once("../API/Database/Database.php");
require_once("../Shared/Models/Question.php");
try {
    // Init database object
    $dbContext = new Database();
    
    // Init controllers
    $questionCtrl = new QuestionController($dbContext);
    $answerCtrl = new AnswerController($dbContext);

    // Test adding and selecting a question
    $question = new Question();
    // $question->id = 2;
    $question->status = 0;
    $question->question_type = 0;
    $question->question = "My Question";
    $question->options = "hey!";
    $question->points = 1;
    $question->description = "Foobar";
    $question->grader = "grader";
    $question->section = "1.1.1";
    $question->keywords = "Hello World";
    $question->start_timestamp = date('Y-m-d H:i:s');
    $question->end_timestamp = date('Y-m-d H:i:s');

    $result = $questionCtrl->AddQuestion($question);
    $q = $questionCtrl->GetQuestion($result->id);
    echo "<pre>";
    print_r($q);
    echo "</pre>";

    // $q2 = $questionCtrl->GetAllQuestions();
    // echo "<pre>";
    // print_r($q2);
    // echo "</pre>";

    // Test adding and selecting an answer
    $answer = new Answer();
    $answer->student_id = "test";
    $answer->question_id = 2;
    $answer->answer = "foobar";
    $answer->points_earned = 0;

    $answerCtrl->AddAnswer($answer);
    $a = $answerCtrl->GetAnswer(2, "test");
    echo "<pre>";
    print_r($a);
    echo "</pre>";

    // Dispose of resources
    $questionCtrl->Dispose();
    $answerCtrl->Dispose();

} catch(Exception $e) {
    echo $e->getMessage();
}
?>