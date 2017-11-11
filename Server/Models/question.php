<?php
require_once(SITE_ROOT . "/Server/database.php");
class Question {
    public $id, $status, $type, $prompt, $points, $description;
    public $grader, $section, $keywords, $start_timestamp, $end_timestamp;

    public function __construct($pdo_statement) {
        // $pdo_statement is a PDOStatement object which corresponds to
        // a single row from the 'questions' database table
        $this->id = intval($pdo_statement['id']);
        $this->status = intval($pdo_statement['status']);
        $this->type = intval($pdo_statement['question_type']);
        $this->prompt = $pdo_statement['question'];
        $this->points = intval($pdo_statement['points']);
        $this->description = $pdo_statement['description'];
        $this->grader = $pdo_statement['grader'];
        $this->section = $pdo_statement['section'];
        // Note: $this->keywords is an array of strings, however in the database
        // the keywords are stored as space-delimited strings. Don't get this confused!
        $this->keywords = explode(" ", $pdo_statement['keywords']);
        $time = $pdo_statement['start_timestamp'];
        if (isset($time) && $time !== NULL) {
            $this->start_timestamp = date_create_from_format('Y-m-d H:i:s',
                                        $time, new DateTimeZone(TIMEZONE));
        }
        $time = $pdo_statement['end_timestamp'];
        if (isset($time) && $time !== NULL) {
            $this->end_timestamp = date_create_from_format('Y-m-d H:i:s',
                                        $time, new DateTimeZone(TIMEZONE));
        }
    }

    public function activate($db=FALSE) {
        // $db is a Database object (optional)
        $ret = FALSE;
        if (!$db) {
            $disconnect_when_done = TRUE;
            $db = new Database();
        }
        $this->status = ACTIVE;
        $now = new DateTime("now", new DateTimeZone(TIMEZONE));
        $timestamp = $now->format("Y-m-d H:i:s");
        $this->start_timestamp = $now;
        try {
            $query = "UPDATE questions SET status=?, start_timestamp=? WHERE id=?";
            $ps = $db->get()->prepare($query);
            $ps->execute([$this->status, $this->start_timestamp, $this->id]);
            $ret = TRUE;
        } catch (PDOException $e) {
            print("An error occurred while activating a question.");
        }
        if (isset($disconnect_when_done)) {
            $db->disconnect();
        }
        return $ret;
    }

    public function deactivate($db=FALSE) {
        // $db is a Database object (optional)
        $ret = FALSE;
        if (!$db) {
            $disconnect_when_done = TRUE;
            $db = new Database();
        }
        $this->status = INACTIVE;
        $now = new DateTime("now", new DateTimeZone(TIMEZONE));
        $timestamp = $now->format("Y-m-d H:i:s");
        $this->end_timestamp = $now;
        try {
            $query = "UPDATE questions SET status=?, end_timestamp=? WHERE id=?";
            $ps = $db->get()->prepare($query);
            $ps->execute([$this->status, $this->end_timestamp, $this->id]);
            $ret = TRUE;
        } catch (PDOException $e) {
            print("An error occurred while deactivating a question.");
        }
        if (isset($disconnect_when_done)) {
            $db->disconnect();
        }
        return $ret;
    }

    public function save($db=FALSE) {
        // $db is a Database object (optional)
        $ret = FALSE;
        if (!$db) {
            $disconnect_when_done = TRUE;
            $db = new Database();
        }
        if (isset($this->start_timestamp) && $this->start_timestamp !== NULL) {
            $start_ts = $this->start_timestamp->format("Y-m-d H:i:s");
        } else {
            $start_ts = NULL;
        }
        if (isset($this->end_timestamp) && $this->end_timestamp !== NULL) {
            $end_ts = $this->end_timestamp->format("Y-m-d H:i:s");
        } else {
            $end_ts = NULL;
        }
        try {
            $query = "UPDATE questions SET status=?, question_type=?" .
                        "question=?, points=?, description=?, grader=?, section=?,
                        section=?, keywords=?, start_timestamp=?, end_timestamp=? " .
                        "WHERE id=?";
            $ps = $db->get()->prepare($query);
            $ps->execute([
                $this->status,
                $this->type,
                $this->prompt,
                $this->points,
                $this->description,
                $this->grader,
                $this->section,
                implode(" ", $this->keywords),
                $start_ts,
                $end_ts,
                $this->id
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
