<?php
    require_once("ISerializable.php");
    require_once("IValidatable.php");

    class User implements ISerializable, IValidatable {

        // constants for our password rules
        const PASS_MIN_LEN = 6;

        public $username = null;
        public $password = null;
        public $num_pw_changes = null;
        public $email = null;
        public $type = null;
        public $last_login = null;
        public $last_logout = null;

        function __construct() {
        }

        /**
         * Takes an associate array from the database an populates the model's values
         */
        public function Deserialize($input) {
            if (isset($input['username'])) {
                $this->username = $input['username'];
            }
            if (isset($input['password'])) {
                $this->password = $input['password'];
            }
            if (isset($input['num_pw_changes'])) {
                $this->num_pw_changes = $input['num_pw_changes'];
            }
            if (isset($input['email'])) {
                $this->email = $input['email'];
            }
            if (isset($input['type'])) {
                $this->type = $input['type'];
            }
            if (isset($input['last_login'])) {
                $this->last_login = $input['last_login'];
            }
            if (isset($input['last_logout'])) {
                $this->last_logout = $input['last_logout'];
            }
        }

        /**
         * Turns the model into an associative array for the database
         */
        public function Serialize() {
            return array(
                'username' => $this->username,
                'password' => $this->password,
                'num_pw_changes' => $this->num_pw_changes,
                'email' => $this->email,
                'type' => $this->type,
                'last_login' => $this->last_login,
                'last_logout' => $this->last_logout
            );
        }

        /**
         * Logic for determining if this Question Model is in a 'valid' state
         * TODO: Add actual validation.
         */
        public function IsValid() {
            // We can throw in password validation attributes here....
            if(!isset($this->password) || strlen($this->password) < self::PASS_MIN_LEN) {
                return false;
            }

            return true;
        }
    }
?>