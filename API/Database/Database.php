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
     * Takes an associate array and returns a comma seperated string of its keys
     */
    private function GetColumnNames($valueArray) {
        $keys = array_keys($valueArray);
        return implode(",", $keys);
    }

    /**
     * Is meant to return the correct # of ?....
     * TODO: this function is crap. There surely is a better way of
     * accomplishing this.
     */
    private function GetColumnValues($valueArray) {
        $values = array_values($valueArray);
        foreach($values as $key => $value){
            $values[$key] = "?";
        }
        return implode(",", $values);
    }
}
?>