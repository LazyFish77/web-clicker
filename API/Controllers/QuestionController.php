<?php
require_once("../Shared/Models/Question.php");
require_once("BaseController.php");

/**
 * Controller for handling operations which deal with questions
 */
class QuestionController extends BaseController {
    
    function __construct(Database $context) {
        parent::__construct($context);
    }

    /**
     * Given a Question Model, inserts said model into our database
     */
    public function AddQuestion(Question $question): Question {
        if(!$question->IsValid()) {
            // TODO: add actual code to handle invalid models
            return null;
        }

        // Find the current highest ID number in use and add 1 to it
        // Naturally, assign it to the model
        $highestId = $this->db->Select("MAX(id)", "questions");
        $question->id = $highestId[0]['MAX(id)'] + 1;

        // Do the actual insert
        $this->db->Insert("questions", $question->Serialize());

        // Return the model as it is reflected in our database
        // Note... we could also do another select, looking for the ID we just inserted
        // That would be better in my opinion, however, induces more work
        return $question;
    }

    /**
     * Returns a single question from the database, by its ID
     */
    public function GetQuestion($id): Question {

        $results = $this->db->Select("*", "questions", "id = ".$id);

        $q = new Question();
        $q->Deserialize($results[0]);
        
        return $q;
    }
}
?>