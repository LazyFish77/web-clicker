<?php
require_once(SITE_ROOT . "/Server/database.php");
class User {
    public $username, $password, $num_pw_changes, $email, $type;
    public $last_login, $last_logout;

    public function __construct($pdo_statement) {
        // $pdo_statement is a PDOStatement object which corresponds to
        // a single row from the 'users' database table
        $this->username = $pdo_statement['username'];
        $this->password = $pdo_statement['password'];
        $this->num_pw_changes = intval($pdo_statement['num_pw_changes']);
        $this->email = $pdo_statement['email'];
        $this->type = intval($pdo_statement['type']);
        $time = $pdo_statement['last_login'];
        if (isset($time) && $time !== NULL) {
            $this->last_login = date_create_from_format('Y-m-d H:i:s',
                                        $time, new DateTimeZone(TIMEZONE));
        }
        $time = $pdo_statement['last_logout'];
        if (isset($time) && $time !== NULL) {
            $this->last_logout = date_create_from_format('Y-m-d H:i:s',
                                        $time, new DateTimeZone(TIMEZONE));
        }
    }

    public function log_in($db=FALSE) {
        // Updates the last_login of this user in the database
        // $db is a Database object (optional)
        $ret = FALSE;
        if (!$db) {
            $disconnect_when_done = TRUE;
            $db = new Database();
        }
        $now = new DateTime("now", new DateTimeZone(TIMEZONE));
        $timestamp = $now->format("Y-m-d H:i:s");
        try {
            $query = "UPDATE users SET last_login=? WHERE username=?";
            $ps = $db->get()->prepare($query);
            $ps->execute([$timestamp, $this->username]);
            $ret = TRUE;
        } catch (PDOException $e) {
            print($e);
            print("An error occurred while trying to log in.");
        }
        if (isset($disconnect_when_done)) {
            $db->disconnect();
        }
        return $ret;
    }

    public function log_out($db=FALSE) {
        // Updates the last_logout of this user in the database
        // $db is a Database object (optional)
        $ret = FALSE;
        if (!$db) {
            $disconnect_when_done = TRUE;
            $db = new Database();
        }
        $now = new DateTime("now", new DateTimeZone(TIMEZONE));
        $timestamp = $now->format("Y-m-d H:i:s");
        try {
            $query = "UPDATE users SET last_logout=? WHERE username=?";
            $ps = $db->get()->prepare($query);
            $ps->execute([$timestamp, $this->username]);
            $ret = TRUE;
        } catch (PDOException $e) {
            print("An error occurred while trying to log in.");
        }
        if (isset($disconnect_when_done)) {
            $db->disconnect();
        }
        return $ret;
    }

    public function verify_password($password) {
        // $password is a non-hashed string
        // Returns a boolean indicating whether the given password is correct
        if (isset($password) && $password !== NULL && strlen($password) > 0) {
            $hashed_pass = hash(HASH_ALGORITHM, $password);
            return $this->password === $hashed_pass;
        } else {
            return FALSE;
        }
    }

    public function change_password($new_password, $db=FALSE) {
        // $new_password is a non-hashed string, $db is a Database object (optional)
        $ret = FALSE;
        if (isset($new_password) && $new_password !== NULL && strlen($new_password) > 0) {
            if (!$db) {
                $disconnect_when_done = TRUE;
                $db = new Database();
            }
            $hashed_pass = hash(HASH_ALGORITHM, $new_password);
            $this->password = $hashed_pass;
            $this->num_pw_changes++;
            try {
                $query = "UPDATE users SET password=?, num_pw_changes=? WHERE username=?";
                $ps = $db->get()->prepare($query);
                $ps->execute([$this->password, $this->num_pw_changes, $this->username]);
                $ret = TRUE;
            } catch (PDOException $e) {
                exit("An error occurred while attempting to change a password.");
            }
            if (isset($disconnect_when_done)) {
                $db->disconnect();
            }
        }
        return $ret;
    }

    public function answer_question($question, $answer, $db=FALSE) {
        // $question is a Question object, $answer is a string, $db is a Database
        // object (optional)
        $ret = FALSE;
        if (isset($question) && $question !== NULL && isset($answer) && $answer !== NULL) {
            $points_earned = $question->grade($answer);
            if (!$db) {
                $disconnect_when_done = TRUE;
                $db = new Database();
            }
            try {
                $insertion = "INSERT INTO answers VALUES (?, ?, ?, ?)";
                $ps = $db->get()->prepare($query);
                $ps->execute([$question->id, $this->username, $answer, $points_earned]);
                $ret = TRUE;
            } catch (PDOException $e) {
                print("An error occurred while attempting to answer the question.");
            }
            if (isset($disconnect_when_done)) {
                $db->disconnect();
            }
        }
        return $ret;
    }
}
?>
