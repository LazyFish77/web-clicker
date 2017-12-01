<?php
require_once(realpath(dirname(__FILE__)) . "/BaseService.php");

/**
 * Service for dealing with the Questions table
 */
class QuestionService extends BaseService {

    function __construct(IDatabase $context) {
        parent::__construct($context);
    }

    /**
     * Sets a question's state to Active in the database
     */
    public function Activate(Question $question) {
        $query = "UPDATE questions SET status = ? WHERE id = ?";
        $params = array(
            "status" => QUESTION_ACTIVE,
            "id" => $question->id
        );
        return $this->db->ExecuteNonQuery($query, $params) > 0;
    }

    /**
     * Sets a question's state to Inactive in the database
     */
    public function Deactivate(Question $question) {
        $query = "UPDATE questions SET status = ? WHERE id = ?";
        $params = array(
            "status" => QUESTION_INACTIVE,
            "id" => $question->id
        );
        return $this->db->ExecuteNonQuery($query, $params) > 0;
    }

    /**
     * Selects all questions in the database which are set to Active
     */
    public function SelectActiveQuestions() {
        $query = "SELECT * FROM questions WHERE status = ?";
        $params = array(
            "status" => QUESTION_ACTIVE
        );
        return $this->db->ExecuteQuery($query, $params);
    }

    /**
     * Inserts a new question into the database
     */
    public function Insert(Question $question) {
        $query = "INSERT INTO questions
                  (id, status, question_type, question, options, answer, points, description, grader, section, keywords, start_timestamp, end_timestamp)
                  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        return $this->db->ExecuteNonQuery($query, $question->Serialize()) > 0;
    }

    /**
     * Deletes an existing question from the database
     */
    public function Delete($id) {
        $query = "DELETE FROM questions WHERE id = ?";
        $params = array(
            "id" => $id
        );
        return $this->db->ExecuteNonQuery($query, $params) > 0;
    }

    /**
     * Updates an existing question in the database
     */
    public function Update(Question $question) {
        $query = "UPDATE questions SET question_type=?, question=?, options=?, answer=?, points=?, description=?, grader=?, section=?, keywords=?, start_timestamp=?, end_timestamp=? WHERE id=?";
        $params = array(            
            "question_type" => $question->question_type,
            "question" => $question->question,
            "options" => $question->options,
            "answer" => $question->answer,
            "points" => $question->points,
            "description" => $question->description,
            "grader" => $question->grader,
            "section" => $question->section,
            "keywords" => $question->keywords,
            "start_timestamp" => $question->start_timestamp,
            "end_timestamp" => $question->end_timestamp,
            "id" => $question->id
        );
        return $this->db->ExecuteNonQuery($query, $params) > 0;
    }

    /**
     * Selects a specific question from the database by its ID
     */
    public function Select($questionId) {
        $query = "SELECT * FROM questions WHERE id = ?";
        $params = array(
            "id" => $questionId
        );
        return $this->db->ExecuteQuery($query, $params);
    }

    /**
     * Selects all questions from the database
     */
    public function SelectAll() {
        $query = "SELECT * FROM questions";
        return $this->db->ExecuteQuery($query);
    }

    /**
     * Finds the highest ID number and adds 1 to it
     */
    public function GetNextId() {
        $query = "SELECT MAX(id) FROM questions";
        $result = $this->db->ExecuteQuery($query);
        return $result[0]['MAX(id)'] + 1;
    }

}

?>