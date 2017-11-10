<?php
require_once("../constants.php");
require_once("../database.php");
class Question {
    public $id, $status, $type, $prompt, $points, $description;
    public $grader, $section, $keywords, $start_timestamp, $end_timestamp;
    public $class_average, $num_correct_answers;

    public function __construct($pdo_statement) {
        // $pdo_statement is a PDOStatement object which corresponds to
        // a single row from the 'questions' database table
        $this->id = $pdo_statement['id'];
        $this->status = $pdo_statement['status'];
        $this->type = $pdo_statement['question_type'];
        $this->prompt = $pdo_statement['question'];
        $this->points = $pdo_statement['points'];
        $this->description = $pdo_statement['description'];
        $this->grader = $pdo_statement['grader'];
        $this->section = $pdo_statement['section'];
        // Note: $this->keywords is an array of strings, however in the database
        // the keywords are stored as space-delimited strings. Don't get this confused!
        $this->keywords = explode(" ", $pdo_statement['keywords']);
        $this->start_timestamp = $pdo_statement['start_timestamp'];
    }

    public function activate($db=FALSE) {
        // $db is a Database object (optional)
        if (!$db) {
            $disconnect_when_done = TRUE;
            $db = new Database();
        }
        $this->status = ACTIVE;
        $this->start_timestamp = date("Y-m-d H:i:s");
        try {
            $query = "UPDATE questions WHERE id=? SET status=?, start_timestamp=?";
            $ps = $db->get()->prepare($query);
            $ps->execute([$this->id, $this->status, $this->start_timestamp]);
            return TRUE;
        } catch (PDOException $e) {
            print("An error occurred while activating a question.");
            return FALSE;
        }
        if (isset($disconnect_when_done)) {
            $db->disconnect();
        }
    }

    public function deactivate($db=FALSE) {
        // $db is a Database object (optional)
        if (!$db) {
            $disconnect_when_done = TRUE;
            $db = new Database();
        }
        $this->status = INACTIVE;
        $this->end_timestamp = date("Y-m-d H:i:s");
        try {
            $query = "UPDATE questions WHERE id=? SET status=?, end_timestamp=?";
            $ps = $db->get()->prepare($query);
            $ps->execute([$this->id, $this->status, $this->end_timestamp]);
            return TRUE;
        } catch (PDOException $e) {
            print("An error occurred while deactivating a question.");
            return FALSE;
        }
        if (isset($disconnect_when_done)) {
            $db->disconnect();
        }
    }

    public function save($db=FALSE) {
        $ret = FALSE;
        if (!$db) {
            $disconnect_when_done = TRUE;
            $db = new Database();
        }
        try {
            $query = "UPDATE questions WHERE id=? SET status=?, question_type=?" .
                        "question=?, points=?, description=?, grader=?, section=?,
                        section=?, keywords=?, start_timestamp=?, end_timestamp=?";
            $ps = $db->get()->prepare($query);
            $ps->execute([
                $this->id,
                $this->status,
                $this->type,
                $this->prompt,
                $this->points,
                $this->description,
                $this->grader,
                $this->section,
                $this->keywords,
                $this->start_timestamp,
                $this->end_timestamp,
                $this->class_average,
                $this->num_correct_answers
            ]);
            $ret = TRUE;
        } catch (PDOException $e) {
            print("An error occurred while attempting to save a question.");
        }
        if (isset($disconnect_when_done)) {
            $db->disconnect();
        }
        return $ret;
    }

    public function grade($answer) {
        // Runs this question's PHP grader code on the $answer to return a
        // point value
        $code = str_replace(ANSWER_MARKER, $answer, $this->grader);
        return eval($code);
    }

    public function delete($db=FALSE) {
        // Deletes this question from the database
        $ret = FALSE;
        if (!$db) {
            $disconnect_when_done = TRUE;
            $db = new Database();
        }
        try {
            $query = "DELETE FROM questions WHERE id=?";
            $ps = $db->get()->prepare($query);
            $ps->execute([$this->id]);
            $ret = TRUE;
        } catch (PDOException $e) {
            print("An error occurred while attempting to delete a question.");
        }
        if (isset($disconnect_when_done)) {
            $db->disconnect();
        }
        return $ret;
    }
}
?>
