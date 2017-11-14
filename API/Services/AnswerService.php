<?php
require_once("BaseService.php");

/**
 * Service for dealing with the Answers table
 */
class AnswerService extends BaseService {

    function __construct(IDatabase $context) {
        parent::__construct($context);
    }

    /**
     * SQL for inserting an Answer into the DB
     */
    public function Insert(Answer $answer) {
        $query = "INSERT INTO answers (question_id, student_id, answer, points_earned)
                  VALUES (?,?,?,?)";
        return $this->db->ExecuteNonQuery($query, $answer->Serialize());
    }

    /**
     * SQL for Selecting a single Answer record from the DB
     */
    public function Select($questionId, $studentId) {
        $query = "SELECT * FROM answers WHERE question_id = ? AND student_id = ?";
        $params = array(
            "question_id" => $questionId,
            "student_id" => $studentId
        );
        return $this->db->ExecuteQuery($query, $params);
    }
}

?>