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

    public function GetQuestion($id) {
        $context = new Database();
        $context->Connect();

        $results = $context->Select("*", "questions", "id = ".$id);
        
        $context->Disconnect();

        $q = new Question();
        $q->Deserialize($results[0]);
        
        return $q;
    }
}
?>