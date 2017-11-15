<?php

interface IDatabase {
    public function Connect();
    public function Disconnect();
    public function IsConnected();
    public function ExecuteNonQuery($query, $params = null);
    public function ExecuteQuery($query, $params = null);
    public function BeginTransaction();
    public function CommitTransaction();
    public function RollbackTransaction();
}

?>
