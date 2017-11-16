<?php
require_once(realpath(dirname(__FILE__)) . "/../../Shared/Models/Answer.php");
require_once(realpath(dirname(__FILE__)) . "/BaseController.php");
require_once(realpath(dirname(__FILE__)) . "/../Services/UserService.php");

/**
 * Controller for handling all operations pertaining to users
 */
class UserController extends BaseController {
    
    const INSTRUCTOR = 1;
    const STUDENT = 0;

    const HASH_ALGORITHM = "sha256"; // Note, so far this constant is only used in the scope of this controller

    // UserService contains all the SQL command's we need to use
    private $userService = null;

    function __construct(IDatabase $context) {
        parent::__construct();
        $this->userService = new UserService($context);
    }

    /**
     * Registers a new user in the database
     * @param model An instance of a User object
     * @return User object on success, null on failure
     */
    public function Register(User $model) {
        
        // First we verify that the model is in a valid state
        if(!$model->IsValid()) {
            return null;
        }

        // Now make sure the username isn't already taken
        $checkUsername = $this->userService->SelectByUsername($model->username);
        if(count($checkUsername) > 0) {
            return null;
        }

        // Now make sure the email isn't already taken
        $checkEmail = $this->userService->SelectByEmail($model->email);
        if(count($checkEmail) > 0) {
            return null;
        }

        // Hash the user's cleartext password and insert into the DB
        $model->password = hash(self::HASH_ALGORITHM, $model->password);

        echo $this->userService->Insert($model);

        return $model;
    }

    /**
     * This method will validate a user against the database
     * @param model An instance of a User object
     * @return User object on success (validated), null on failure
     */
    public function ValidateUser(User $model) {
        
        // First, attempt to fetch a preexisting record from the database
        $userRecord = null;
        if(isset($model->username)) {
            $userRecord = $this->userService->SelectByUsername($model->username);
        } else if(isset($model->email)) {
            $userRecord = $this->userService->SelectByEmail($model->email);
        } else {
            return null;
        }

        // A user has been found, deserialize into a User object for comparison
        $user = new User();
        $user->Deserialize($userRecord[0]);

        $hash = hash(self::HASH_ALGORITHM, $model->password);

        // Check passwords... if they get this far, then they're probably who they say they are
        if($user->password === $hash) {
            return $user;
        } else {
            return null;
        }
    }

    /**
     * @Override
     * Cleans up any resources used by this Controller
     */
    public function Dispose() {
        if($this->userService !== null) {
            $this->userService->Dispose();
        }
    }

}
?>