<?PHP
require_once("../API/Config.php");
require_once("IDatabase.php");

/**
 * This class contains all the functionality required for communication between
 * our app, and the MySQL backend.
 */
class Database implements IDatabase {

    // Our database handle
    private $dbh = null;

    function __construct() {
    }

    /**
     * Attempts to make a connection
     */
    public function Connect() {
        // If we're already connected, just return
        if($this->dbh !== null) {
            return;
        }

        try {
            $this->dbh = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST,
                            DB_USER,
                            DB_PASS,
                            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
        } catch (PDOException $e) {
            // TODO: Actual error management
            echo "This application exited with failure<br />" .
                    "because there was an error when trying to<br />" .
                    "connect to its database.<br />";
            exit();
        }
    }

    /**
     * Disconnects the current database session.
     * If a transaction is in progress... it will attempt to commit it before closing
     */
    public function Disconnect() {
        if(isset($this->dbh) && this->dbh !== null) {
            if($this->dbh->inTransaction()) {
                $this->dbh->commit();
            }
            $this->dbh = null;
        }
    }

    /**
     * Determines if a database connection has already been established
     * @return true if connected, false if not
     */
    public function IsConnected() {
        return $this->dbh !== null;
    }

    /**
     * Executes a NonQuery type of SQL statement, i.e. DELETE, UPDATE, INSERT
     * @param query a string containing the SQL syntax
     * @param params (optional) an associative array containing column name => column value pairs
     * @return int number of rows affected on success, death on error
     */
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

    /**
     * Executes a Query type of SQL statement, i.e. SELECT
     * @param query a string containing the SQL syntax
     * @param params (optional) an associative array containing column name => column value pairs
     * @return array assocative array containing each record found
     */
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

    /**
     * Allows for the implementation of Transactions.
     * Starts the transaction sequence
     */
    public function BeginTransaction() {
        if (!$this->dbh->inTransaction()) {
            $this->dbh->beginTransaction();
        }
    }

    /**
     * Allows for the implementation of Transactions
     * Commits and ends the current transaction
     */
    public function CommitTransaction() {
        if ($this->dbh->inTransaction()) {
            $this->dbh->commit();
        }
    }

    /**
     * Allows for the implementation of Transactions
     * Rolls back and ends the current transaction
     */
    public function RollbackTransaction() {
        if ($this->dbh->inTransaction()) {
            $this->dbh->rollback();
        }
    }

}
?>