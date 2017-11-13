<?php
require_once("../Shared/Models/Question.php");
require_once("../API/Database/Database.php");

class QuestionController {
    
    function __construct() {
    }

    public function AddQuestion(Question $question) {
        $context = new Database();
        $context->Connect();

        $context->Insert("questions", $question->Serialize());

        $context->Disconnect();
    }
}
?>