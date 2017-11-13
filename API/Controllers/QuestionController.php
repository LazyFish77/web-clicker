<?php
require_once("../Shared/Models/Question.php");
require_once("../API/Database/Database.php");

/**
 * Controller for handling operations which deal with questions
 */
class QuestionController {
    
    /**
     * NOTE: connecting and disconnecting on every controller call
     * may be undesired. A different location for the Database object may
     * need to be found.
     */
    function __construct() {
    }

    /**
     * Given a Question Model, inserts said model into our database
     */
    public function AddQuestion(Question $question): Question {
        if(!$question->IsValid()) {
            // TODO: add actual code to handle invalid models
            return null;
        }
        
        $context = new Database();
        $context->Connect();

        // Find the current highest ID number in use and add 1 to it
        // Naturally, assign it to the model
        $highestId = $context->Select("MAX(id)", "questions");
        $nextId = $highestId[0]['MAX(id)'] + 1;
        
        $question->id = $nextId;

        // Do the actual insert
        $context->Insert("questions", $question->Serialize());

        $context->Disconnect();

        // Return the model as it is reflected in our database
        // Note... we could also do another select, looking for the ID we just inserted
        // That would be better in my opinion, however, induces more work
        return $question;
    }

    /**
     * Returns a single question from the database, by its ID
     */
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