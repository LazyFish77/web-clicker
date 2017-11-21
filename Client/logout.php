<?PHP
require_once(realpath(dirname(__FILE__)) . "/General/Session.php");
$session = new Session();
$session->LogOut();
?>