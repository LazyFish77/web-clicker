<?php
require_once("../Shared/Models/Answer.php");
require_once("BaseController.php");
require_once("../API/Services/UserService.php");

class UserController extends BaseController {
    
    const HASH_ALGORITHM = "sha256";

    private $userService = null;

    function __construct(IDatabase $context) {
        parent::__construct();
        $this->userService = new UserService($context);
    }

    public function Register(User $model) {
        if(!$model->IsValid()) {
            echo "model invalid";
            return null;
        }

        $checkUsername = $this->userService->SelectByUsername($model->username);
        if(count($checkUsername) > 0) {
            echo "username exists";
            return null;
        }

        $checkEmail = $this->userService->SelectByEmail($model->email);
        if(count($checkEmail) > 0) {
            echo "email exists";
            return null;
        }

        $model->password = hash(self::HASH_ALGORITHM, $model->password);

        $this->userService->Insert($model);

        return $model;
    }

    public function ValidateUser(User $model) {
        $userRecord = null;
        if(isset($model->username)) {
            $userRecord = $this->userService->SelectByUsername($model->username);
        } else if(isset($model->email)) {
            $userRecord = $this->userService->SelectByEmail($model->email);
        } else {
            return null;
        }

        $user = new User();
        $user->Deserialize($userRecord[0]);

        $hash = hash(self::HASH_ALGORITHM, $model->password);

        if($user->password === $hash) {
            return $user;
        } else {
            return null;
        }
    }

    public function Dispose() {
        if($this->userService !== null) {
            $this->userService->Dispose();
        }
    }

}
?>