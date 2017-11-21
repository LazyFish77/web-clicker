<?PHP
require_once($_SERVER['DOCUMENT_ROOT'] . "/web-clicker/API/Database/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/web-clicker/API/Controllers/UserController.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/web-clicker/Shared/Models/User.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/web-clicker/Shared/Models/IDisposable.php");

class Session implements IDisposable {

    private $user = null;
    private $dbContext = null;
    private $userCtrl = null;

    function __construct() {
        if(!isset($_SESSION)){
            session_start();
        }

        if(!isset($_SESSION['user']) && $_SERVER['REQUEST_URI'] != WEB_ROOT . "/Client/login.php") {
            $this->Redirect("http://".$_SERVER['SERVER_NAME'] . WEB_ROOT . "/Client/login.php");
        }

        $this->dbContext = new Database();
        $this->userCtrl = new UserController($this->dbContext);

    }

    public function Redirect($url, $message = null) {
        if ($message) {
            $_SESSION["message"] = $message;
        }
        header("Location: $url");
        die();
    }

    public function LogIn($username, $password) {

        $user = new User();
        $user->username = $username;
        $user->password = $password;

        $validUser = $this->userCtrl->ValidateUser($user);

        if($validUser !== null) {
            $_SESSION['user'] = $validUser;
            switch($validUser->type) {
                case UserController::INSTRUCTOR:
                    $this->Redirect("http://" . $_SERVER['SERVER_NAME'] . WEB_ROOT. "/Client/Instructor/scores.php");

                case UserController::STUDENT:
                    $this->Redirect("http://" . $_SERVER['SERVER_NAME'] . WEB_ROOT . "/Client/Student/next-question.php");
            }
        } else {
            $this->Redirect("http://".$_SERVER['SERVER_NAME'] . WEB_ROOT . "/Client/login.php", "Invalid username or password");
        }
    }

    public function LogOut() {
        session_destroy();
        $this->Redirect("http://".$_SERVER['SERVER_NAME'] . WEB_ROOT . "/Client/login.php");
    }

    public function SetMessage($msg) {
        $_SESSION["message"] = $msg;
    }

    public function ClearMessage() {
        if(isset($_SESSION["message"])) {
            unset($_SESSION["message"]);
        }
    }

    public function GetMessage() {
        if(isset($_SESSION["message"])) {
            return $_SESSION["message"];
        }
        return null;
    }

    public function GetUser() {
        return $_SESSION['user'];
    }

    /**
     * @Override
     */
    public function Dispose() {
        if($this->userCtrl !== null) {
            $this->userCtrl->Dispose();
        }
    }
}
?>