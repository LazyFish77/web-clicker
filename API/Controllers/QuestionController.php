<?php
require_once("../Shared/Models/Question.php");
require_once("BaseController.php");
require_once("../API/Services/QuestionService.php");
/**
 * Controller for handling operations which deal with questions
 */
class QuestionController extends BaseController {
    
    private $questionService = null;

    function __construct(Database $context) {
        parent::__construct();
        $this->questionService = new QuestionService($context);
    }

    /**
     * Given a Question Model, inserts said model into our database
     */
    public function AddQuestion(Question $question): Question {
        if(!$question->IsValid()) {
            return null;
        }

        $question->id = $this->questionService->GetNextId();

        $this->questionService->Insert($question);

        return $question;
    }

    /**
     * Returns a single question from the database, by its ID
     */
    public function GetQuestion($id): Question {

        $results = $this->questionService->Select($id);

        $q = new Question();
        $q->Deserialize($results[0]);
        
        return $q;
    }

    public function ActivateQuestion(Question $model) {
        return $this->questionService->Activate($model);
    }

    public function DeactivateQuestion(Question $model) {
        return $this->questionService->Deactivate($model);
    }

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

    public function DeactivateAllQuestions() {
        $active = $this->questionService->SelectActiveQuestions();

        foreach($active as $value) {
            $q = new Question();
            $q->Deserialize($value);
            $this->questionService->Deactivate($q);
        }
    }

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

    public function Dispose() {
        if($this->questionService !== null) {
            $this->questionService->Dispose();
        }
    }
}
?>