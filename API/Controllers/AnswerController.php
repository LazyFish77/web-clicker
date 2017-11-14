<?php
require_once("../Shared/Models/Answer.php");
require_once("BaseController.php");
require_once("../API/Services/AnswerService.php");
/**
 * Controller for handling operations which deal with questions
 */
class AnswerController extends BaseController {
    
    private $answerService = null;

    function __construct(IDatabase $context) {
        parent::__construct($context);
        $this->answerService = new AnswerService($context);
    }

    public function AddAnswer(Answer $model): Answer {
        if(!$model->IsValid()) {
            return null;
        }

        $this->answerService->Insert($model);

        return $model;
    }

    public function GetAnswer($question_id, $student_id): Answer {

        $result = $this->answerService->Select($question_id, $student_id);

        $a = new Answer();
        $a->Deserialize($result[0]);

        return $a;
    }

}
?>