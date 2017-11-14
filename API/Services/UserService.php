<?php
require_once("BaseService.php");

/**
 * Service for dealing with the User table
 */
class UserService extends BaseService {

    function __construct(IDatabase $context) {
        parent::__construct($context);
    }

    /**
     * Inserts a new user into the database
     */
    public function Insert(User $user) {
        $query = "INSERT INTO users (username, password, num_pw_changes, email, type, last_login, last_logout)
                  VALUES (?,?,?,?,?,?,?)";
        return $this->db->ExecuteNonQuery($query, $user->Serialize());
    }

    /**
     * Selects a User record via their username
     */
    public function SelectByUsername($username) {
        $query = "SELECT * FROM users WHERE username = ?";
        $params = array(
            "username" => $username
        );
        return $this->db->ExecuteQuery($query, $params);
    }

    /**
     * Selects a User record via their email
     */
    public function SelectByEmail($email) {
        $query = "SELECT * FROM users WHERE email = ?";
        $params = array(
            "email" => $email
        );
        return $this->db->ExecuteQuery($query, $params);
    }
}

?>