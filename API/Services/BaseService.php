<?php
require_once("../Shared/Models/IDisposable.php");

abstract class BaseService implements IDisposable {
    
    protected $db = null;

    function __construct(Database $context) {
        $this->db = $context;
        if(!$this->db->IsConnected()) {
            $this->db->Connect();
        }
    }

    public function Dispose() {
        if($this->db !== null) {
            $this->db->Disconnect();
        }
    }

}
?>