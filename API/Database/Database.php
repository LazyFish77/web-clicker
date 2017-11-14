<?PHP
require_once("../API/Config.php");
require_once("IDatabase.php");

class Database implements IDatabase {

    private $dbh = null;

    function __construct() {
    }

    public function Connect() {
        if($this->dbh !== null) {
            return;
        }

        try {
            $this->dbh = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST,
                            DB_USER,
                            DB_PASS,
                            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
        } catch (PDOException $e) {
            echo "This application exited with failure<br />" .
                    "because there was an error when trying to<br />" .
                    "connect to its database.<br />";
            exit();
        }
    }

    public function Disconnect() {
        if(isset($dbh)) {
            if($this->dbh->inTransaction()) {
                $this->dbh->commit();
            }
            $dbh = null;
        }
    }

    public function IsConnected() {
        return $this->dbh !== null;
    }

    public function ExecuteNonQuery($query, $params = null) {
        try {
            $stmt = $this->dbh->prepare($query);
            if ($params !== null) {
                return $stmt->execute(array_values($params));
            } else {
                return $stmt->execute();
            }
        } catch (PDOexception $e) {
            // TODO: Actual error management
            die($e->getMessage());
        }
    }

    public function ExecuteQuery($query, $params = null) {
        try {
            $stmt = $this->dbh->prepare($query);
            if ($params !== null) {
                $stmt->execute(array_values($params));
            } else {
                $stmt->execute();
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOexception $e) {
            // TODO: Actual error management
            die($e->getMessage());
        }
    }

    public function BeginTransaction() {
        if (!$this->dbh->inTransaction()) {
            $this->dbh->beginTransaction();
        }
    }

    public function CommitTransaction() {
        if ($this->dbh->inTransaction()) {
            $this->dbh->commit();
        }
    }

    public function RollbackTransaction() {
        if ($this->dbh->inTransaction()) {
            $this->dbh->rollback();
        }
    }

}
?>