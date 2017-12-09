<?php
require_once(realpath(dirname(__FILE__)) . "/BaseService.php");

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

    public function SelectAll() {
        $query = "SELECT * FROM answers";
        return $this->db->ExecuteQuery($query);
    }

    public function GetAllAnswersFromStudent($studentId) {
        $query ="SELECT * FROM answers WHERE student_id = ?";
        $params = array("student_id" => $studentId);
        return $this->db->ExecuteQuery($query, $params);
    }
    
    public function GetAllAnswersFromStudentWithFilters($studentId,$filters) {
        $params = array("student_id" => $studentId);
        $query ="SELECT * FROM answers inner join answers on";
        $whereClause = "WHERE answers.student_id = ?";
        while ($filterValue = current($filters)) {
           if (isset($filterValue)) {
               $columnName = key($filters);
               if($columnName === "points" || $columnName === "question_type") {
                   $whereClause = " ".$whereClause." AND"." questions.".$columnName." = ?"; 
               } else {
                   $whereClause = " ".$whereClause." AND"." answers.".$columnName." = ?"; 
               }
               $params[key($filters)] = $filterValue;
            }
            next($filters);
        }
        $query = $query.$whereClause;
        echo"$query";
        print_r($params);
        return $this->db->ExecuteQuery($query, $params);
    }

    public function GetAllAnswersFromQuestion($questionId) {
        $query ="SELECT * FROM answers WHERE question_id = ?";
        $params = array("question_id" => $questionId);
        return $this->db->ExecuteQuery($query, $params);
    }
}

?>