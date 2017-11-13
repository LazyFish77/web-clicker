<?php
require_once("../Shared/Models/IDisposable.php");

abstract class BaseController implements IDisposable {
    
    protected $db = null;

    function __construct(Database $context) {
        $this->db = $context;
        $this->db->Connect();
    }

    public function Dispose() {
        if($this->db !== null) {
            $this->db->Disconnect();
        }
    }

}
?>