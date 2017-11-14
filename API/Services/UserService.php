<?php
require_once("BaseService.php");

class UserService extends BaseService {

    function __construct(IDatabase $context) {
        parent::__construct($context);
    }

    public function Insert(User $user) {
        $query = "INSERT INTO users (username, password, num_pw_changes, email, type, last_login, last_logout)
                  VALUES (?,?,?,?,?,?,?)";
        return $this->db->ExecuteNonQuery($query, $user->Serialize());
    }

    public function SelectByUsername($username) {
        $query = "SELECT * FROM users WHERE username = ?";
        $params = array(
            "username" => $username
        );
        return $this->db->ExecuteQuery($query, $params);
    }

    public function SelectByEmail($email) {
        $query = "SELECT * FROM users WHERE email = ?";
        $params = array(
            "email" => $email
        );
        return $this->db->ExecuteQuery($query, $params);
    }
}

?>