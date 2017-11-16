<?php
require_once(realpath(dirname(__FILE__)) . "/../../Shared/Models/IDisposable.php");

/**
 * Base controller class for holding common properties/functions
 * Was once in use... currently doesn't do much
 */
abstract class BaseController implements IDisposable {
    
    function __construct() {
    }

    public function Dispose() {
    }

}
?>