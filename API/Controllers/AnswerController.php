<?php
require_once(realpath(dirname(__FILE__)) . "/../../Shared/Models/Answer.php");
require_once(realpath(dirname(__FILE__)) . "/BaseController.php");
require_once(realpath(dirname(__FILE__)) . "/../Services/AnswerService.php");

/**
 * Controller for making decisions about Answers
 */
class AnswerController extends BaseController {
    
    // Answer Service encapsulates the raw SQL statements we'll need to make
    private $answerService = null;

    function __construct(IDatabase $context) {
        parent::__construct();
        $this->answerService = new AnswerService($context);
    }

    /**
     * Adds an Answer to the database.
     * @param model - An instance of the Answer class
     * @return Answer object on success, null on failure
     */
    public function AddAnswer(Answer $model) {
        if(!$model->IsValid()) {
            return null;
        }

        $this->answerService->Insert($model);

        return $model;
    }

    /**
     * Gets a specific answer from the database via its primary keys of question_id & student_id
     * @param question_id - the ID number of the question
     * @param student_id - the username of the student
     * @return Answer object on success
     */
    public function GetAnswer($question_id, $student_id) {
        $result = $this->answerService->Select($question_id, $student_id);

        if(count($result) == 0) {
            return null;
        }

        $a = new Answer();
        $a->Deserialize($result[0]);
        return $a;
    }

    public function GetAllAnswers() {
        $result = $this->answerService->SelectAll();
        return $result;
    }

    public function GetAllAnswersFromStudent($studentId, $filters) {
        if(count($filters) === 0){
            $result = $this->answerService->GetAllAnswersFromStudent($studentId);
        } else {
            $result = $this->answerService->GetAllAnswersFromStudentWithFilters($studentId,$filters);
            
        }
        return $result;
    }

    public function GetAllAnswersFromQuestion($questionId) {
        $result = $this->answerService->GetAllAnswersFromQuestion($questionId);
        return $result;
    }

    /**
     * @Override
     * Cleans up any resources held onto by the controller
     */
    public function Dispose() {
        if($this->answerService !== null) {
            $this->answerService->Dispose();
        }
    }

}
?>