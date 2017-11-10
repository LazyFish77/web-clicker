<?php
require_once("constants.php");
require_once("models/user.php");
require_once("models/question.php");
class Database {
    private $connection = NULL;

    public function __construct() {
        try {
            $this->connection = new PDO(DB_DSN, DB_USER, DB_PWD,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            exit("Failed to connect to the database.");
        }
    }

    public function disconnect() {
        if ($this->connection !== NULL) {
            $this->connection = NULL;
        }
    }

    public function get() {
        return $this->connection;
    }

    public function get_user($username) {
        // Returns a single User object
        if (isset($username) && $username !== NULL && strlen($username) > 0) {
            try {
                $query = "SELECT * FROM users WHERE username=?";
                $ps = $this->connection->prepare($query);
                $ps->execute([$username]);
                return new User($ps->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
                print("An error occurred while retrieving a user from the database.");
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function get_question($id) {
        // Returns a single Question object
        if (isset($id) && $id !== NULL && is_numeric($id)) {
            try {
                $query = "SELECT * FROM questions WHERE id=?";
                $ps = $this->connection->prepare($query);
                $ps->execute([$id]);
                return new Question($ps->fetch(PDO::FETCH_ASSOC));
            } catch (PDOException $e) {
                print("An error occurred while retrieving a question from the database.");
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function get_active_question() {
        // Returns a single Question object
        try {
            $query = "SELECT * FROM questions WHERE status=?";
            $ps = $this->connection->prepare($query);
            $ps->execute([ACTIVE]);
            return new Question($ps->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            print("An error occurred while retrieving the active question from the database.");
            return FALSE;
        }
    }

    public function get_all_questions() {
        // Returns an array of Question objects
        try {
            $query = "SELECT * FROM questions";
            $ps = $this->connection->prepare($query);
            $ps->execute();
            $questions = $ps->fetchAll(PDO::FETCH_ASSOC);
            $ret = [];
            foreach ($questions as $question) {
                array_push($ret, new Question($question));
            }
            return ret;
        } catch (PDOException $e) {
            print("An error occurred while retrieving questions from the database.");
            return FALSE;
        }
    }

    public function get_num_students_not_answered($question_id) {
        // Returns the number of students who have not answered the question
        // corresponding to the given $question_id
        if (isset($question_id) && $question_id !== NULL) {
            try {
                $query = "SELECT COUNT(*) FROM answers WHERE question_id=?";
                $ps = $this->connection->prepare($query);
                $ps->execute([$question_id]);
                $result = $ps->fetch(PDO::FETCH_ASSOC);
                $num_answers = $result['COUNT(*)'];

                $query = "SELECT COUNT(*) FROM users WHERE type=?";
                $ps = $this->connection->prepare($query);
                $ps->execute([STUDENT]);
                $result = $ps->fetch(PDO::FETCH_ASSOC);
                $num_students = $result['COUNT(*)'];

                return $num_students - $num_answers;
            } catch (PDOException $e) {
                print("An error occurred while trying to get the number of students" .
                      " who haven't answered a question.");
                return 0;
            }
        }
        return 0;
    }

    public function create_question($question) {
        // $question is an associative array with key-value pairs corresponding
        // to the fields in the 'questions' table of the database, NOT counting
        // the 2 defaultable fields, class_average and num_correct_answers
        // To save/delete a question, see the Question class
        if (isset($question) && $question !== NULL) {
            if (count($question) !== 11) {
                // We need exactly 1 item in the array per table column
                print("An error occurred while trying to create a new question.");
                return;
            }
            try {
                $query = "INSERT INTO questions VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $ps = $this->connection->prepare($query);
                $ps->execute([
                    $question['id'],
                    $question['status'],
                    $question['question_type'],
                    $question['question'],
                    $question['points'],
                    $question['description'],
                    $question['grader'],
                    $question['section'],
                    $question['keywords'],
                    $question['start_timestamp'],
                    $question['end_timestamp'],
                    0.0, 0
                ]);
            } catch (PDOException $e) {
                print("An error occurred while trying to create a new question.");
            }
        }
    }
}
?>
