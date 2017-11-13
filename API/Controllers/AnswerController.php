<?php
require_once("../Shared/Models/Answer.php");
require_once("BaseController.php");
/**
 * Controller for handling operations which deal with questions
 */
class AnswerController extends BaseController {
    
    function __construct(Database $context) {
        parent::__construct($context);
    }

    public function AddAnswer(Answer $model): Answer {
        if(!$model->IsValid()) {
            return null;
        }

        $this->db->Insert("answers", $model->Serialize());

        return $model;
    }

    public function GetAnswer($question_id, $student_id): Answer {

        $result = $this->db->Select("*", "answers", "question_id = ".$question_id." AND student_id = '".$student_id."'");

        $a = new Answer();
        $a->Deserialize($result[0]);

        return $a;
    }

}
?>