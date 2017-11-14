<?php
require_once("../Shared/Models/IDisposable.php");

abstract class BaseController implements IDisposable {
    
    function __construct() {
    }

    public function Dispose() {
    }

}
?>