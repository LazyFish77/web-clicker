<?php
require_once(realpath(dirname(__FILE__)) . "/../Services/QuestionService.php");
require_once(realpath(dirname(__FILE__)) . "/../../Shared/Models/Question.php");
require_once(realpath(dirname(__FILE__)) . "/BaseController.php");

/**
 * Controller for handling operations which deal with questions
 */
class QuestionController extends BaseController {
    
    const TYPE_CHECKBOX = 0; // Question type multiple choice
    const TYPE_SHORT_ANSWER = 1; // Question type short answer
    const TYPE_RADIO = 2;

    // Questionr Service encapsulates the raw SQL statements we'll need to make
    private $questionService = null;

    function __construct(Database $context) {
        parent::__construct();
        $this->questionService = new QuestionService($context);
    }

    /**
     * Adds a new question to the database. Auto-finds the next available ID
     * @param question An instance of a Question class
     * @return Question object on success, null on failure
     */
    public function AddQuestion(Question $question) {
        if(!$question->IsValid()) {
            echo "invalid model";
            return null;
        }

        $question->id = $this->questionService->GetNextId();
        echo "ID: " . $question->id;
        $this->questionService->Insert($question);

        return $question;
    }

    /**
     * Fetches a single question from the database by it's ID
     * @param id The Id number for the question being searched for
     * @return Question object on success
     */
    public function GetQuestion($id) {

        $results = $this->questionService->Select($id);

        $q = new Question();
        $q->Deserialize($results[0]);
        
        return $q;
    }

    /**
     * Sets a question into an activated state
     * @param model An instance of a Question object
     * @return int number of rows affected (should return 1 normally)
     */
    public function ActivateQuestion(Question $model) {
        return $this->questionService->Activate($model);
    }

    /**
     * Sets a question into a deactivated state
     * @param model An instance of a Question object
     * @return int number of rows affected (should return 1 normally)
     */
    public function DeactivateQuestion(Question $model) {
        return $this->questionService->Deactivate($model);
    }

    /**
     * Gets a list of all questions currently set to an active state in the database
     * @return array of Question objects
     */
    public function GetActiveQuestions() {
        $results = $this->questionService->SelectActiveQuestions();

        $payload = array();
        foreach($results as $value) {
            $q = new Question();
            $q->Deserialize($value);
            array_push($payload, $q);
        }

        return $payload;
    }

    /**
     * Sets all activated questions into a deactivated state
     * Note: This can probably be improved via a new/better SQL command in QuestionService
     * @return void
     */
    public function DeactivateAllQuestions() {
        $active = $this->questionService->SelectActiveQuestions();

        foreach($active as $value) {
            $q = new Question();
            $q->Deserialize($value);
            $this->questionService->Deactivate($q);
        }
    }

    /**
     * Fetches all questions from the database
     * @return array of Question objects
     */
    public function GetAllQuestions() {
        $results = $this->questionService->SelectAll();

        $payload = array();
        foreach($results as $value) {
            $q = new Question();
            $q->Deserialize($value);
            array_push($payload, $q);
        }

        return $payload;
    }

    /**
     * @Override
     * Cleans up any resources used by this controller
     */
    public function Dispose() {
        if($this->questionService !== null) {
            $this->questionService->Dispose();
        }
    }
}
?>