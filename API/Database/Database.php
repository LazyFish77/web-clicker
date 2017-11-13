<?PHP
require_once("../API/Config.php");
class Database {

    private $dbh = null;
    function __construct() {

    }

    public function Connect() {
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
            $dbh = null;
        }
    }

    /**
     * Inserts a new record into the database.
     * @param table - The table to insert into
     * @param values - An associative array containing column name => column value pairs
     */
    public function Insert($table, $values) {
        try {
            $query = "INSERT INTO ".$table." (".$this->GetColumnNames($values).") VALUES (".$this->GetColumnValues($values).")";
            $stmt = $this->dbh->prepare($query);
            return $stmt->execute(array_values($values));
        } catch (PDOException $e) {
            // TODO: Actual error management
            exit("Error: Exception with inserting new record ".$e->getMessage());
        }
    }

    /**
     * Selects a record from the database.... TODO: This is a very basic select statement
     * it should be modified to handle more advanced SELECT cases
     */
    public function Select($what, $from, $where = null) {
        try {
            $query = "SELECT ".$what." FROM ".$from;
            if($where !== null) {
                $query .= " WHERE ".$where;
            }
            $stmt = $this->dbh->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // TODO: Actual error management
            exit("Error: Exception with selecting records ".$e->getMessage());
        }
    }

    /**
     * Takes an associate array and returns a comma seperated string of its keys
     */
    private function GetColumnNames($valueArray) {
        return implode(",", array_keys($valueArray));
    }

    /**
     * Returns a string of comma seperated '?' for use in preparing SQL statements
     */
    private function GetColumnValues($valueArray) {
        return implode(",", array_pad(array(), count($valueArray), '?'));
    }
}
?>