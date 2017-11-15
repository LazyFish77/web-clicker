<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/web-clicker/Shared/Models/Answer.php");
require_once("BaseController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/web-clicker/API/Services/AnswerService.php");

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

        $a = new Answer();
        $a->Deserialize($result[0]);

        return $a;
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