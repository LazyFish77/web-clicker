<?php
require_once("../Shared/Models/IDisposable.php");

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