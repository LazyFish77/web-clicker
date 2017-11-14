<?php
require_once("BaseService.php");

class QuestionService extends BaseService {

    const ACTIVE = 1;
    const INACTIVE = 0;

    const TYPE_MULTI_CHOICE = 0;
    const TYPE_SHORT_ANSWER = 1;

    function __construct(IDatabase $context) {
        parent::__construct($context);
    }

    public function Activate(Question $question) {
        $query = "UPDATE questions SET status = ? WHERE id = ?";
        $params = array(
            "status" => self::ACTIVE,
            "id" => $question->id
        );
        return $this->db->ExecuteNonQuery($query) > 0;
    }

    public function Deactivate(Question $question) {
        $query = "UPDATE questions SET status = ? WHERE id = ?";
        $params = array(
            "status" => self::INACTIVE,
            "id" => $question->id
        );
        return $this->db->ExecuteNonQuery($query, $params) > 0;
    }

    public function Insert(Question $question) {
        $query = "INSERT INTO questions
                  (id, status, question_type, question, options, points, description, grader, section, keywords, start_timestamp, end_timestamp)
                  VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->ExecuteNonQuery($query, $question->Serialize()) > 0;
    }

    public function Delete(Question $question) {
        $query = "DELETE FROM questions WHERE id = ?";
        $params = array(
            "id" => $question->id
        );
        return $this->db->ExecuteNonQuery($query) > 0;
    }

    // TODO: figure out which fields need to be updated
    public function Update(Question $question) {
        //$query = "UPDATE questions SET question = ".$question->question
    }

    public function Select($questionId) {
        $query = "SELECT * FROM questions WHERE id = ?";
        $params = array(
            "id" => $questionId
        );
        return $this->db->ExecuteQuery($query, $params);
    }

    public function SelectAll() {
        $query = "SELECT * FROM questions";
        return $this->db->ExecuteQuery($query);
    }

    public function GetNextId() {
        $query = "SELECT MAX(id) FROM questions";
        $result = $this->db->ExecuteQuery($query);
        return $result[0]['MAX(id)'] + 1;
    }

}

?>